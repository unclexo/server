<?php
namespace User\Service;

use User\Mapper\FileMapperInterface;
use User\Service\FileServiceInterface;
use Zend\ServiceManager\ServiceManager;

class FileService implements FileServiceInterface
{
	/**
	 * @var FileMapperInterface
	 */
	protected $fileMapper = null;

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager = null;
	
	/**
	 * Get file by ID
	 * 
	 * @param int $id
	 * @return FileEntityInterface
	 */
	public function getFileById($id)
	{
		return $this->getFileMapper()->getById($id);
	}

	/**
	 * Get file by name
	 * 
	 * @param string $name
	 * @return FileEntityInterface
	 */
	public function getFileByName($name)
	{
		return $this->getFileMapper()->getByName($name);
	}

	/**
	 * Get file by user ID
	 * 
	 * @param int $userId
	 * @return FileEntityInterface
	 */
	public function getFileByUserId($userId)
	{
		return $this->getFileMapper()->getByUserId($userId);
	}

	/**
	 * Get all files
	 * 
	 * @return FileEntityInterface
	 */
	public function getAllFiles()
	{
		return $this->getFileMapper()->getAll();
	}

	/**
	 * Insert a file
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function createFile($data)
	{
		return $this->getFileMapper()->insert($data);
	}

	/**
	 * Update file
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function updateFile($data, $where)
	{
		return $this->getFileMapper()->update($data, $where);
	}

	/**
	 * Delete a file 
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteFile($where)
	{
		return $this->getFileMapper()->delete($where);
	}

	/**
	 * Set file mapper
	 *
	 * @param FileMapperInterface $fileMapper
	 * @return UserService
	 */
	public function setFileMapper(FileMapperInterface $fileMapper)
	{
		$this->fileMapper = $fileMapper;
		return $this;
	}

	/**
	 * Get file mapper
	 *
	 * @return FileMapperInterface
	 */
	public function getFileMapper()
	{
		if (!$this->fileMapper instanceof FileMapperInterface) {
			$this->fileMapper = $this->getServiceManager()->get('NoteFileMapper');
		}
		return $this->fileMapper;
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