<?php
namespace User\Factory\Controller;

use User\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param IndexController
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceManager = $serviceLocator->getServiceLocator();
		$userService = $serviceManager->get('NoteUserService');
		$fileService = $serviceManager->get('NoteFileService');
		$NoteOauth2StoragePdo = $serviceManager->get('NoteOauth2StoragePdo');
		$profileFilter = $serviceManager->get('NoteProfileFilter');
		$registrationFilter = $serviceManager->get('NoteRegistrationFilter');
		$config = $serviceManager->get('config');
		$uploadPath = $config['upload_config']['upload_path'];
		return new IndexController(
			$userService, 
			$fileService,
			$NoteOauth2StoragePdo,
			$profileFilter, 
			$registrationFilter,
			$uploadPath
		);
	}
}