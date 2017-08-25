<?php
namespace Note;

class Module
{
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
	 * Load controllers
	 *
	 * @return string
	 */
	public function getControllerConfig()
	{
		return include __DIR__ . '/config/controller.config.php';
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
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				),
			),
		);
	}
}