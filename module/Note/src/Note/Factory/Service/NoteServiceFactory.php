<?php
namespace Note\Factory\Service;

use Note\Service\NoteService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NoteServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return NoteService
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$noteService = new NoteService();
		$noteService->setServiceManager($serviceLocator);
		return $noteService;
	}
}