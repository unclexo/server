<?php
namespace Note\Service;

use Note\Mapper\NoteMapperInterface;
use Note\Service\NoteServiceInterface;
use Zend\ServiceManager\ServiceManager;

class NoteService implements NoteServiceInterface
{
	/**
	 * @var NoteMapperInterface
	 */
	protected $noteMapper = null;

	/**
	 * @var ServiceManager
	 */
	protected $serviceManager = null;
	
	/**
	 * Get note by ID
	 * 
	 * @param int $id
	 * @return NoteEntityInterface
	 */
	public function getNoteById($id)
	{
		return $this->getNoteMapper()->getById($id);
	}

	/**
	 * Get note by user ID
	 * 
	 * @param int $userId
	 * @return NoteEntityInterface
	 */
	public function getNoteByUserId($userId)
	{
		return $this->getNoteMapper()->getByUserId($userId);
	}		

	/**
	 * Get all notes
	 * 
	 * @return NoteEntityInterface
	 */
	public function getAllNotes()
	{
		return $this->getNoteMapper()->getAll();
	}

	/**
	 * Insert a note
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function createNote($data)
	{
		return $this->getNoteMapper()->insert($data);
	}

	/**
	 * Update note
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function updateNote($data, $where)
	{
		return $this->getNoteMapper()->update($data, $where);
	}

	/**
	 * Delete a note 
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteNote($where)
	{
		return $this->getNoteMapper()->delete($where);
	}

	/**
	 * Set note mapper
	 *
	 * @param NoteMapperInterface $noteMapper
	 * @return UserService
	 */
	public function setNoteMapper(NoteMapperInterface $noteMapper)
	{
		$this->noteMapper = $noteMapper;
		return $this;
	}

	/**
	 * Get note mapper
	 *
	 * @return NoteMapperInterface
	 */
	public function getNoteMapper()
	{
		if (!$this->noteMapper instanceof NoteMapperInterface) {
			$this->noteMapper = $this->getServiceManager()->get('NoteNoteMapper');
		}
		return $this->noteMapper;
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