<?php
namespace User\Factory\Service;

use User\Service\UserService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class UserServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return UserService
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$userService = new UserService();
		$userService->setServiceManager($serviceLocator);
		return $userService;
	}
}