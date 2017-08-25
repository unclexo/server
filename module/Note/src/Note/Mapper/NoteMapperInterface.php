<?php
namespace Note\Mapper;

interface NoteMapperInterface 
{
	/**
	 * Get note by ID
	 *
	 * @param int $id
	 * @return NoteEntityInterface
	 */
	public function getById($id);	

	/**
	 * Get all notes
	 *
	 * @return NoteEntityInterface
	 */
	public function getAll();

	/**
	 * Insert note
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function insert($data);	

	/**
	 * Update note
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function update($data, $where);

	/**
	 * Delete note
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function delete($where);			
}

