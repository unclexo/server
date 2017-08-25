<?php
namespace Common\Factory\Oauth2\GrantType;

use OAuth2\GrantType\UserCredentials;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserCredentialsFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return UserCredentials
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$storage = $serviceLocator->get('NoteOauth2StoragePdo');
		return new UserCredentials($storage);
	}
}