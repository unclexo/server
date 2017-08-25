<?php 
namespace User\Mapper;

class FileMapper extends AbstractMapper implements FileMapperInterface 
{
	/**
	 * Get file by ID
	 *
	 * @param int $id
	 * @return FileEntityInterface
	 */
	public function getById($id)
	{
		$where = array('id' => (int) $id);
		return parent::select($where)->current();
	}

	/**
	 * Get file by name
	 *
	 * @param string $name
	 * @return FileEntityInterface
	 */
	public function getByName($name)
	{
		$where = array('filename' => (string) $name);
		return parent::select($where)->current();
	}	

	/**
	 * Get file by user ID
	 *
	 * @param int $userId
	 * @return FileEntityInterface
	 */
	public function getByUserId($userId)
	{
		$where = array('userId' => (int) $userId);
		return parent::select($where)->current();
	}	

	/**
	 * Get all files
	 *
	 * @return FileEntityInterface
	 */
	public function getAll()
	{
		return parent::select();
	}

	/**
	 * Insert file
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function insert($data)
	{
		$result = parent::insert($data);
		return $result->getGeneratedValue();
	}	

	/**
	 * Update file
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function update($data, $where)
	{
		$result = parent::update($data, $where);
		return $result->getAffectedRows() > 0 ? true : false;
	}

	/**
	 * Delete file
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function delete($where)
	{
		$result = parent::delete($where);
		return $result->getAffectedRows() > 0 ? true : false;
	}	
}