<?php
namespace User\Factory\Service;

use User\Service\FileService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileServiceFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return FileService
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$fileService = new FileService();
		$fileService->setServiceManager($serviceLocator);
		return $fileService;
	}
}