<?php
namespace Common\Oauth2;

use Zend\ServiceManager\ServiceManager;
use OAuth2\GrantType\GrantTypeInterface;
use OAuth2\Request as Oauth2Request;
use OAuth2\Server as Oauth2Server;

class Oauth2Handler implements Oauth2HandlerInterface
{
	/**
	 * @var Oauth2Server;
	 */
	protected $oauth2Server;

	/**
	 * @var GrantTypeInterface
	 */
	protected $oauth2GrantType;

	/**
	 * Bootstrap the Oauth2 server and
	 * handle the token request
	 * 
	 * @return \OAuth2\ResponseInterface
	 */
	public function bootstrap()
	{
		$server = $this->getOauth2Server();
		$server->addGrantType($this->getOauth2GrantType());
		$response = $server->handleTokenRequest(Oauth2Request::createFromGlobals());
		return $response;
	}

	public function verifyToken()
	{
		$server = $this->getOauth2Server();
		return $server->verifyResourceRequest(Oauth2Request::createFromGlobals());
	}

	/**
	 * Set Oauth2 server
	 *
	 * @param Oauth2Server $oauth2Server
	 * @return Oauth2
	 */
	public function setOauth2Server(Oauth2Server $oauth2Server)
	{
		$this->oauth2Server = $oauth2Server;
		return $this;
	}

	/**
	 * Get Oauth2 server
	 *
	 * @return Oauth2Server
	 */
	public function getOauth2Server()
	{
		if (null === $this->oauth2Server) {
			$this->oauth2Server = $this->getServiceManager()->get('NoteOauth2Server');
		}
		return $this->oauth2Server;
	}

	/**
	 * Set Oauth2 grant type
	 *
	 * @param GrantTypeInterface $oauth2GrantType
	 * @return Oauth2
	 */
	public function setOauth2GrantType(GrantTypeInterface $oauth2GrantType)
	{
		$this->oauth2GrantType = $oauth2GrantType;
		return $this;
	}

	/**
	 * Get Oauth2 grant type
	 *
	 * @return GrantTypeInterface
	 */
	public function getOauth2GrantType()
	{
		if (null === $this->oauth2GrantType) {
			$this->oauth2GrantType = $this->getServiceManager()->get('NoteOauth2UserCredentials');
		}
		return $this->oauth2GrantType;
	}	

	/**
	 * Set service manager
	 *
	 * @param ServiceManager $serviceManager
	 * @return Oauth2
	 */
	public function setServiceManager(ServiceManager $serviceManager)
	{
		$this->serviceManager = $serviceManager;
		return $this;
	}

	/**
	 * Get service manager
	 *
	 * @return ServiceManager
	 */
	public function getServiceManager()
	{
		return $this->serviceManager;
	}	
}