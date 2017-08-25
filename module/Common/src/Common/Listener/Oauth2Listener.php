<?php
namespace Common\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class Oauth2Listener extends AbstractListenerAggregate
{
	/**
	 * Attach a listener to the dispatch event
	 * 	
	 * @param EventManagerInterface $events
	 * @return null
	 */
	public function attach(EventManagerInterface $events)
	{
		$this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 1000);
	}

	/**
	 * A listener to check user access to a specific resource
	 * 	
	 * @param MvcEvent $event
	 * @return null|Response
	 */
	public function onDispatch(MvcEvent $event) 
	{
		if ($event->getRouteMatch()->getMatchedRouteName() == 'login-user' || $event->getRouteMatch()->getMatchedRouteName() == 'create-user') {
			return;
		}

		$app = $event->getApplication();
		$serviceManager = $app->getServiceManager();
		$oauth2Handler = $serviceManager->get("NoteOauth2Handler");

		if (!$oauth2Handler->verifyToken()) {
			$oauth2Server = $serviceManager->get("NoteOauth2Server");
			$viewModel = new JsonModel(array(
				'errorCode' => $oauth2Server->getResponse()->getStatusCode(),
				'errorMessage' => $oauth2Server->getResponse()->getStatusText(),
			));

			$response = $event->getResponse();
			$response->setContent($viewModel->serialize());
			$response->getHeaders()->addHeaderLine('Content-Type', 'application/json');
			$response->setStatusCode($oauth2Server->getResponse()->getStatusCode());
			return $response; 
		}
	}
}