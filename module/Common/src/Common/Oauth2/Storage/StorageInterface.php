<?php 
namespace Common\Oauth2\Storage;

interface StorageInterface 
{
	/**
	 * Check password against stored password in db
	 *
	 * Uses: $user['password']
	 *
	 * @param array $user Stored encrypted password
	 * @param string $password User provided password while logging in
	 * @return bool
	 */
	public function checkPassword($user, $password);

	/**
	 * Make encrypted password
	 *
	 * @param string $password
	 * @return string
	 */
    public function hashPassword($password);
}