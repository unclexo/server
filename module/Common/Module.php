<?php
namespace Common;

use Zend\Mvc\MvcEvent;

class Module
{
	public function onBootstrap(MvcEvent $event)
	{
		$app = $event->getApplication();
		$serviceManager = $app->getServiceManager();
		$eventManager = $app->getEventManager();
		$eventManager->attach($serviceManager->get("Oauth2Listener"));
		$eventManager->attach($serviceManager->get("ResponseErrorListener"));
	}
		
	/**
	 * Load module configurations
	 *
	 * @return string
	 */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * Load services
	 *
	 * @return string
	 */
	public function getServiceConfig()
	{
		return include __DIR__ . '/config/service.config.php';
	}	
	
	/**
	 * Configure namespaces to be loaded for this module
	 * 
	 * @return array
	 */	
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}	
}