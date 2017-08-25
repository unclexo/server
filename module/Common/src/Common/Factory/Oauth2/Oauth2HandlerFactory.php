<?php 
namespace Common\Factory\Oauth2;

use Common\Oauth2\Oauth2Handler;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Oauth2HandlerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return Oauth2Handler
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$oauth2Handler = new Oauth2Handler();
		$oauth2Handler->setServiceManager($serviceLocator);
		return $oauth2Handler;
	}
}