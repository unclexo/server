<?php
namespace User\Service;

interface FileServiceInterface
{
	/**
	 * Get file by ID
	 * 
	 * @param int $id
	 * @return FileEntityInterface
	 */
	public function getFileById($id);

	/**
	 * Get file by name
	 * 
	 * @param string $name
	 * @return FileEntityInterface
	 */
	public function getFileByName($name);

	/**
	 * Get all files
	 * 
	 * @return FileEntityInterface
	 */
	public function getAllFiles();	

	/**
	 * Create a new file
	 * 
	 * @param array $data
	 * @return mixed|null
	 */
	public function createFile($data);

	/**
	 * Update a file
	 * 
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function updateFile($data, $where);

	/**
	 * Delete a file 
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteFile($where);		
}