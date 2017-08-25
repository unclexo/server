<?php
namespace Common\Oauth2;

interface Oauth2HandlerInterface 
{
	/**
	 * Bootstrap the Oauth2 server and
	 * handle the token request
	 * 
	 * @return \OAuth2\ResponseInterface
	 */
	public function bootstrap();

    /**
     * Verify the request for a resource
     *
     * @return mixed
     */
	public function verifyToken();
}