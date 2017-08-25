<?php 
namespace User\Controller;

use User\Service\FileServiceInterface;
use User\Service\UserServiceInterface;
use OAuth2\Storage\UserCredentialsInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\InputFilter\InputFilterInterface;
use Zend\Crypt\Password\Bcrypt;

class IndexController extends AbstractRestfulController
{
	/**
	 * @var UserServiceInterface
	 */
	protected $userService = null;

	/**
	 * @var FileServiceInterface
	 */
	protected $fileService = null;

	/**
	 * @var UserCredentialsInterface
	 */
	protected $oauth2StoragePdo = null;

	/**
	 * @var InputFilterInterface
	 */
	protected $profileFilter = null;

	/**
	 * @var InputFilterInterface
	 */
	protected $registrationFilter = null;

	/**
	 * @var string
	 */
	protected $uploadPath = null;

	/**
	 * Constructor
	 *
	 * @param UserServiceInterface $userService
	 * @param FileServiceInterface $fileService
	 * @param UserCredentialsInterface $oauth2StoragePdo
	 * @param InputFilterInterface $fileFilter
	 * @param InputFilterInterface $registrationFilter
	 * @param string $uploadPath
	 */
	public function __construct(
		UserServiceInterface $userService,
		FileServiceInterface $fileService,
		UserCredentialsInterface $oauth2StoragePdo,
		InputFilterInterface $profileFilter,
		InputFilterInterface $registrationFilter,
		$uploadPath
	) {
		if (!empty($uploadPath) && !is_string($uploadPath)) {
			throw new \Exception("Upload path was not defined");
		}

		$this->userService = $userService;
		$this->fileService = $fileService;
		$this->oauth2StoragePdo = $oauth2StoragePdo;
		$this->profileFilter = $profileFilter;
		$this->registrationFilter = $registrationFilter;
		$this->uploadPath = $uploadPath;
	}

    /**
     * Retrieve user data based on username
     *
     * @param string $username
     * @return array
     */
	public function get($username)
	{
		$user = $this->userService->getUserByUsername($username);
		if (!empty($user)) {
			$usreData = $user->toArray();
			$file = $this->fileService->getFileByUserId($user->getId());
			if ($file) {
				$usreData['filename'] = !empty($file->getFilename()) ? $file->getFilename() : null;
			}
			return new JsonModel($usreData);
		}

		return new JsonModel(array(
			'result' => false,
			'message' => 'Could not find any user',
		));
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
	public function getList()
	{
		$this->methodNotAllowed();
	}

    /**
     * Create a new user
     *
     * @return void
     */
	public function create($data)
	{
		$inputFilter = $this->registrationFilter;
		$inputFilter->setData($data);

		if ($inputFilter->isValid()) {

			$values = $inputFilter->getValues();
			$bcrypt = new Bcrypt();
			$values['password'] = $bcrypt->create($values['password']);

			$requiredFields = array('email', 'username', 'password');
			$filteredFieldValues = $this->filteredFields($requiredFields, $values);

			if ($user = $this->userService->createUser($filteredFieldValues)) {
				$data = array('userId' => $user);
				$this->fileService->createFile($data);
				$this->oauth2StoragePdo->setUser($values['username'], $values['password'], null, null);
				return new JsonModel(array('result' => true));
			} else {
				return new JsonModel(array(
					'result' => false,
					'message' => 'Could not create user',
				));
			}
		} else {
			return new JsonModel(array(
				'result' => false,
				'messages' => $inputFilter->getMessages(),
			));
		}
	}

    /**
     * Update user's data
     *
     * @return void
     */
	public function update($id, $data)
	{
		$update = false;
		$inputFilter = $this->profileFilter;
		$inputFilter->setData($data);
		$user = $this->userService->getUserById($id);
		
		if (!$user) {
        	return new JsonModel(array(
        		'result' => false,
        		'message' => 'Could not find user by ID',
        	));
		}

		if ($inputFilter->isValid()) {
			$values = $inputFilter->getValues();
			$avatar = array_key_exists('avatar', $values) ? $values['avatar'] : null;

			$fields = array('location', 'gender');
			$filteredData = array();
			foreach ($fields as $field) {
				if (in_array($field, array_keys($values))) {
					if ($values[$field] != '') {
						$filteredData[$field] = $values[$field];
					}
				}
			}

			if (!empty($filteredData)) {
				$this->userService->updateUser($filteredData, array('id' => (int) $id));
				$update = true;
			}

			if (!empty($avatar) && is_string($avatar)) {
				$avatarStatus = $this->createAvatar($avatar, $id);
				if ($avatarStatus) {
					$update = true;
				} else {
					$update = false;
				}
			}

			if (true === $update) {
				return new JsonModel(array('result' => true));
			}

        	return new JsonModel(array(
        		'result' => false,
        		'message' => 'Error while storing user info',
        	));

		} else {
			return new JsonModel(array(
				'result' => false,
				'message' => $inputFilter->getMessages(),
			));
		}
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
	public function delete($id)
	{
		$this->methodNotAllowed();
	}

    /**
     * A convenient method for not allowed method
     *
     * @return array
     */
	protected function methodNotAllowed()
	{
        $this->response->setStatusCode(405);

        return [
            'content' => 'Method Not Allowed'
        ];
	}

	/**
	 * A convenient method to check database fields over passed array
	 *
	 * @param array $fields A non-associative array containing fields
	 * @param array $data An array to iterate over
	 * @return array
	 */
	protected function filteredFields($fields, $data)
	{
		$filtered = array();
		foreach ($fields as $field) {
			if (in_array($field, array_keys($data))) {
				$filtered[$field] = $data[$field];
			} else {
				throw new \Exception("A required field \"{$field}\" does not exist in the given array!");
			}
		}
		return $filtered;
	}

	/**
	 * Create avatar
	 *
	 * @param string $avatar
	 * @param int $userId
	 * @return bool
	 */
	protected function createAvatar($avatar, $userId)
	{
		if (!is_dir($this->uploadPath) && !is_writable($this->uploadPath)) {
			throw new \Exception('Upload path is not a directory or writable');
		}

        $filename = sprintf('%s%s%s.png', $this->uploadPath, DIRECTORY_SEPARATOR, sha1(uniqid(time(), true)));
        $content = base64_decode($avatar);
        // $image = imagecreatefromstring(file_get_contents($avatar));
        $image = imagecreatefromstring($content);

        if (imagepng($image, $filename) === true) {
			$filename = array(
				'filename' => basename($filename),
			);

			$file = $this->fileService->getFileByUserId($userId);
			if ($file->getFilename()) {
				$oldFile = sprintf('%s%s%s', $this->uploadPath, DIRECTORY_SEPARATOR, $file->getFilename());
				if (file_exists($oldFile)) {
					@unlink($oldFile);
				}
			}

			$this->fileService->updateFile($filename, array('userId' => (int) $userId));
            imagedestroy($image);
        } else {
        	return false;
        }

        return true;
	}							
}