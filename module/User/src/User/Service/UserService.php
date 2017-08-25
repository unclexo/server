<?php
namespace User\Service;

use User\Mapper\UserMapperInterface;
use User\Service\UserServiceInterface;
use Zend\ServiceManager\ServiceManager;

class UserService implements UserServiceInterface
{
	/**
	 * @var UserMapperInterface
	 */
	protected $userMapper = null;

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager = null;
	
	/**
	 * Get user by ID
	 * 
	 * @param int $id
	 * @return UserEntityInterface
	 */
	public function getUserById($id)
	{
		return $this->getUserMapper()->getById($id);
	}

	/**
	 * Get user by email
	 * 
	 * @param string $email
	 * @return UserEntityInterface
	 */
	public function getUserByEmail($email)
	{
		return $this->getUserMapper()->getByEmail($email);
	}

	/**
	 * Get user by username
	 * 
	 * @param string $username
	 * @return UserEntityInterface
	 */
	public function getUserByUsername($username)
	{
		return $this->getUserMapper()->getByUsername($username);
	}

	/**
	 * Get all users
	 * 
	 * @return UserEntityInterface
	 */
	public function getAllUsers()
	{
		return $this->getUserMapper()->getAll();
	}

	/**
	 * Insert an user
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function createUser($data)
	{
		return $this->getUserMapper()->insert($data);
	}

	/**
	 * Update an user
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function updateUser($data, $where)
	{
		return $this->getUserMapper()->update($data, $where);
	}

	/**
	 * Delete an user
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteUser($where)
	{
		return $this->getUserMapper()->delete($where);
	}

	/**
	 * Set user mapper
	 *
	 * @param UserMapperInterface $userMapper
	 * @return UserService
	 */
	public function setUserMapper(UserMapperInterface $userMapper)
	{
		$this->userMapper = $userMapper;
		return $this;
	}

	/**
	 * Get user mapper
	 *
	 * @return UserMapperInterface
	 */
	public function getUserMapper()
	{
		if (!$this->userMapper instanceof UserMapperInterface) {
			$this->userMapper = $this->getServiceManager()->get('NoteUserMapper');
		}
		return $this->userMapper;
	}

	/**
	 * Set service manager
	 *
	 * @param ServiceManager $serviceManager
	 * @return UserService
	 */
	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->serviceManager = $serviceManager;
		return $this;
	}

	/**
	 * Get service manager
	 *
	 * @return ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}				
}