<?php
namespace Note\Service;

interface NoteServiceInterface
{
	/**
	 * Get note by ID
	 * 
	 * @param int $id
	 * @return NoteEntityInterface
	 */
	public function getNoteById($id);

	/**
	 * Get note by user ID
	 * 
	 * @param int $userId
	 * @return NoteEntityInterface
	 */
	public function getNoteByUserId($userId);

	/**
	 * Get all notes
	 * 
	 * @return NoteEntityInterface
	 */
	public function getAllNotes();	

	/**
	 * Create a new note
	 * 
	 * @param array $data
	 * @return boolean
	 */
	public function createNote($data);

	/**
	 * Update a note
	 * 
	 * @param array $data
	 * @param array $where
	 * @return boolean
	 */
	public function updateNote($data, $where);

	/**
	 * Delete a note 
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteNote($where);		
}