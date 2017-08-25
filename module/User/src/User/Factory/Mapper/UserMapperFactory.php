<?php
namespace User\Factory\Mapper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Mapper\UserMapper;

class UserMapperFactory implements FactoryInterface
{
	/**
	 * Create service
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return UserMapper
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$adapter = $serviceLocator->get('NoteDbAdapter');
		$entity = $serviceLocator->get('NoteUserEntity');
		$userMapper = new UserMapper();
		$userMapper->setAdapter($adapter);
		$userMapper->setTable('users');
		$userMapper->setEntityPrototype($entity);
		return $userMapper;
	}
}