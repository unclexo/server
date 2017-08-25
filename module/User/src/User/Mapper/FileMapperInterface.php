<?php
namespace User\Mapper;

interface FileMapperInterface 
{
	/**
	 * Get file by ID
	 *
	 * @param int $id
	 * @return FileEntityInterface
	 */
	public function getById($id);

	/**
	 * Get file by name
	 *
	 * @param string $name
	 * @return FileEntityInterface
	 */
	public function getByName($name);

	/**
	 * Get all files
	 *
	 * @return FileEntityInterface
	 */
	public function getAll();

	/**
	 * Insert file
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function insert($data);	

	/**
	 * Update file
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function update($data, $where);

	/**
	 * Delete file
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function delete($where);			
}

