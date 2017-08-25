<?php 
namespace Common\Factory\Oauth2;

use OAuth2\Server as Oauth2Server;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ServerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return Oauth2Server
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$storage = $serviceLocator->get('NoteOauth2StoragePdo');
		$config = $serviceLocator->get('config');
		$oauth2Config = $config['oauth2_config'];
		return new Oauth2Server($storage, $oauth2Config);
	}
}