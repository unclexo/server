<?php 
namespace User\Mapper;

class UserMapper extends AbstractMapper implements UserMapperInterface
{
	/**
	 * Get user by ID
	 *
	 * @param int $id
	 * @return UserEntityInterface
	 */
	public function getById($id) 
	{
		$where = ['id' => (int) $id];
		return parent::select($where)->current();
	}

	/**
	 * Get user by email
	 *
	 * @param string $email
	 * @return UserEntityInterface
	 */
	public function getByEmail($email) 
	{		
		$where = array('email' => (string) $email);
		return parent::select($where)->current();
	}

	/**
	 * Get user by username
	 *
	 * @param string $username
	 * @return UserEntityInterface
	 */
	public function getByUsername($username) 
	{		
		$where = array('username' => (string) $username);
		return parent::select($where)->current();
	}

	/**
	 * Get all users
	 *
	 * @return UserEntityInterface
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