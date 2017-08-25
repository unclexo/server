<?php
namespace Common\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Response;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class ResponseErrorListener extends AbstractListenerAggregate
{
	/**
	 * Attach a listener to the render event
	 * 
	 * @param EventManagerInterface $events
	 * @return void
	 */
	public function attach(EventManagerInterface $events)
	{
		$this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'onRender'), 1000);
	}

	/**
	 * Listener method to be executed when render event is triggered
	 *
	 * @param MvcEvent $event
	 * @return void
	 */
	public function onRender(MvcEvent $event)
	{
		$isOk = $event->getResponse()->isOk();
		$statusCode = $event->getResponse()->getStatusCode();

		if ($isOk || $statusCode == Response::STATUS_CODE_401) {
			return;
		}

		$result = $event->getResult();
		$exception = $result->getVariable('exception');

		$viewModel = new JsonModel(array(
			'errorCode' => !empty($exception) ? $exception->getCode() : $statusCode,
			'errorMessage' => !empty($exception) ? $exception->getMessage() : null,
		));
		$viewModel->setTerminal(true);

		$event->setResult($viewModel);
		$event->setViewModel($viewModel);
		$event->getResponse()->setStatusCode($statusCode);
	}
}