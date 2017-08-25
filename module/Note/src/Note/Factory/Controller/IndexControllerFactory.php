<?php 
namespace Note\Factory\Controller;

use Note\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return IndexController
	 */	
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$serviceManager = $serviceLocator->getServiceLocator();
		$noteService = $serviceManager->get("NoteNoteService");
		$userService = $serviceManager->get("NoteUserService");
		$noteFilter = $serviceManager->get("NoteNoteFilter");
		return new IndexController($noteService, $userService, $noteFilter);
	}
}