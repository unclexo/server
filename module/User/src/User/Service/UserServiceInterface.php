<?php
namespace User\Service;

interface UserServiceInterface
{
	/**
	 * Get user by ID
	 * 
	 * @param int $id
	 * @return UserEntityInterface
	 */
	public function getUserById($id);

	/**
	 * Get user by email
	 * 
	 * @param string $email
	 * @return UserEntityInterface
	 */
	public function getUserByEmail($email);

	/**
	 * Get user by username
	 * 
	 * @param string $username
	 * @return UserEntityInterface
	 */
	public function getUserByUsername($username);

	/**
	 * Get all users
	 * 
	 * @return UserEntityInterface
	 */
	public function getAllUsers();	

	/**
	 * Create a new user
	 * 
	 * @param array $data
	 * @return mixed|null
	 */
	public function createUser($data);

	/**
	 * Update user's data
	 * 
	 * @param array $data
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function updateUser($data, $where);

	/**
	 * Delete an file 
	 *
	 * @param Where|string|array|\Closure $where
	 * @return boolean
	 */
	public function deleteUser($where);							
}