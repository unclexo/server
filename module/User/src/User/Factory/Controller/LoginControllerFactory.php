<?php
namespace User\Factory\Controller;

use User\Controller\LoginController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoginControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return LoginController
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceManager = $serviceLocator->getServiceLocator();
		$userService = $serviceManager->get('NoteUserService');
		$oauth2Handler = $serviceManager->get('NoteOauth2Handler');
		$oauth2StoragePdo = $serviceManager->get('NoteOauth2StoragePdo');
		return new LoginController($userService, $oauth2Handler, $oauth2StoragePdo);
	}
}