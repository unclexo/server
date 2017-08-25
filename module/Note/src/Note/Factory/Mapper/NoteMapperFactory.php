<?php
namespace Note\Factory\Mapper;

use Note\Mapper\NoteMapper;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NoteMapperFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return NoteMapper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$adapter = $serviceLocator->get('NoteDbAdapter');
		$entity = $serviceLocator->get('NoteNoteEntity');
		$noteMapper = new NoteMapper();
		$noteMapper->setAdapter($adapter);
		$noteMapper->setTable('notes');
		$noteMapper->setEntityPrototype($entity);
		return $noteMapper;
	}
}