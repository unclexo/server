<?php 
namespace Common\Oauth2\Storage;

use Zend\Crypt\Password\Bcrypt;
use OAuth2\Storage\Pdo as OAuth2Pdo;

class StoragePdo extends OAuth2Pdo implements StorageInterface
{
	/**
	 * Check password against stored password in db
	 *
	 * @param array $user Stored encrypted password
	 * @param string $password User provided password while logging in
	 * @return bool
	 */
	public function checkPassword($user, $password)
	{
		$bcrypt = new Bcrypt();
		return $bcrypt->verify($password, $user['password']);
	}

	/**
	 * Make encrypted password
	 *
	 * @param string $password
	 * @return string
	 */
    public function hashPassword($password)
    {
		return $password;
    }

    /**
     * Revoke access token based on user ID
     *
     * @param string $user_id User name
     * @param string $access_token
     * @return bool
     */
    public function revokeAccessToken($user_id, $access_token)
    {
    	$stmt = $this->db->prepare(sprintf("DELETE FROM %s WHERE access_token = :access_token AND user_id = :user_id", $this->config['access_token_table']));
    	$stmt->execute(compact('access_token', 'user_id'));
    	return $stmt->rowCount() > 0;
    }	    	
}