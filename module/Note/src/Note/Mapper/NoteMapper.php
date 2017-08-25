<?php 
namespace Note\Mapper;

use Zend\Db\Sql\Select;

class NoteMapper extends AbstractMapper implements NoteMapperInterface 
{
	/**
	 * Get note by ID
	 *
	 * @param int $id
	 * @return NoteEntityInterface
	 */
	public function getById($id)
	{
		$where = array('id' => (int) $id);
		return parent::select($where)->current();
	}

	/**
	 * Get note by user ID
	 *
	 * @param int $userId
	 * @return NoteEntityInterface|ResultSet
	 */
	public function getByUserId($userId)
	{
		$where = array('userId' => (int) $userId);
		$order = array('createdAt' => 'DESC');
		return parent::select($where, $order, null, null);
		
		// return parent::select(function(Select $select) use ($userId) {
		// 	$select->where(array('userId' => (int) $userId));
		// 	$select->order('createdAt ASC');
		// });
	}	

	/**
	 * Get all notes
	 *
	 * @return NoteEntityInterface
	 */
	public function getAll()
	{
		return parent::select();
	}

	/**
	 * Insert note
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
	 * Update note
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
	 * Delete note
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