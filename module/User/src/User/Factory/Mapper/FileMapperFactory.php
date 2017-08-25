<?php
namespace User\Factory\Mapper;

use User\Mapper\FileMapper;
use User\Entity\FileEntity;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FileMapperFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return FileMapper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$adapter = $serviceLocator->get('NoteDbAdapter');
		$entity = $serviceLocator->get('NoteFileEntity');
		$fileMapper = new FileMapper();
		$fileMapper->setAdapter($adapter);
		$fileMapper->setTable('files');
		$fileMapper->setEntityPrototype($entity);
		return $fileMapper;
	}
}