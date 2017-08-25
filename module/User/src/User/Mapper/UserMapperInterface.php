<?php
namespace User\Mapper;

interface UserMapperInterface 
{
	/**
	 * Get user by ID
	 *
	 * @param int $id
	 * @return UserEntityInterface
	 */
	public function getById($id);

	/**
	 * Get user by email
	 *
	 * @param string $email
	 * @return UserEntityInterface
	 */
	public function getByEmail($email);

	/**
	 * Get user by username
	 *
	 * @param string $username
	 * @return UserEntityInterface
	 */
	public function getByUsername($username);

	/**
	 * Get all users
	 *
	 * @return UserEntityInterface
	 */
	public function getAll();

	/**
	 * Insert data
	 *
	 * @param array $data
	 * @return mixed|null
	 */
	public function insert($data);	

	/**
	 * Update data
	 *
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return bool
	 */
	public function update($data, $where);

	/**
	 * Delete
	 *
	 * @param Where|\Closure|string|array $where
	 * @param bool
	 */
	public function delete($where);			
}

