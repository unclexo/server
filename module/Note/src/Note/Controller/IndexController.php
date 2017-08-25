<?php 
namespace Note\Controller;

use Note\Service\NoteServiceInterface;
use User\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\InputFilter\InputFilterInterface;

class IndexController extends AbstractRestfulController
{
	/**
	 * @var NoteServiceInterface
	 */
	protected $noteService = null;

	/**
	 * @var UserServiceInterface
	 */
	protected $userService = null;		

	/**
	 * @var InputFilterInterface
	 */
	protected $noteFilter = null;

	/**
	 * Constructor
	 *
	 * @param NoteServiceInterface $noteService
	 * @param UserServiceInterface $userService
	 * @param InputFilterInterface $noteFilter
	 */
	public function __construct(
		NoteServiceInterface $noteService,
		UserServiceInterface $userService,
		InputFilterInterface $noteFilter
	) {
		$this->noteService = $noteService;
		$this->userService = $userService;
		$this->noteFilter = $noteFilter;
	}

    /**
     * Retrieve notes realted to a username
     *
     * @param string $username
     * @return array
     */	
	public function get($username)
	{
		$user = $this->userService->getUserByUsername($username);
		if (!empty($user)) {
			$notes = $this->noteService->getNoteByUserId($user->getId());
			$noteData['feeds'] = $notes->toArray();
			return new JsonModel($noteData);
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
     * Create a new note
     *
     * @return array
     */
	public function create($data)
	{
		$noteFilter = $this->noteFilter;
		$noteFilter->setData($data);

		if ($noteFilter->isValid()) {
			$values = $noteFilter->getValues();
			$requiredFields = array('userId', 'note');
			$filteredValues = $this->filteredFields($requiredFields, $values);

			if ($noteId = $this->noteService->createNote($filteredValues)) {
				return new JsonModel(array('result' => true));
			} else {
				return new JsonModel(array(
					'result' => false,
					'message' => 'Could not create note',
				));
			}
		} else {
			return new JsonModel(array(
				'result' => false,
				'message' => $noteFilter->getMessages(),
			));
		}
	}

    /**
     * Update a note
     *
     * @return array
     */	
	public function update($id, $data)
	{
		$noteFilter = $this->noteFilter;
		$noteFilter->setData($data);

		if ($noteFilter->isValid()) {
			$values = $noteFilter->getValues();
			$note = array('note' => $values['note']);		

			if ($this->noteService->updateNote($note, array('id' => (int) $id, 'userId' => (int) $values['userId']))) {
				return new JsonModel(array('result' => true));
			} else {
				return new JsonModel(array(
					'result' => false,
					'message' => 'Could not update note',
				));
			}
		} else {
			return new JsonModel(array(
				'result' => false,
				'message' => $noteFilter->getMessages(),
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
}