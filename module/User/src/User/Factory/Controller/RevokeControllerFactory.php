<?php
namespace User\Factory\Controller;

use User\Controller\RevokeController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RevokeControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return RevokeController
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceManager = $serviceLocator->getServiceLocator();
		$userService = $serviceManager->get('NoteUserService');
		$oauth2StoragePdo = $serviceManager->get('NoteOauth2StoragePdo');
		return new RevokeController($userService, $oauth2StoragePdo);
	}
}