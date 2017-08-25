<?php 
namespace Common\Factory\Oauth2\Storage;

use Common\Oauth2\Storage\StoragePdo;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class StoragePdoFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return StoragePdo
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$adapter = $serviceLocator->get('NoteDbAdapter');
		return new StoragePdo($adapter->getDriver()->getConnection()->getConnectionParameters());
	}
}