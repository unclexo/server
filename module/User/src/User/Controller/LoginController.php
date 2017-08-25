<?php
namespace User\Controller;

use Common\Oauth2\Oauth2HandlerInterface;
use User\Service\UserServiceInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Crypt\Password\Bcrypt;

class LoginController extends AbstractRestfulController
{
	/**
	 * @var UserServiceInterface
	 */
	protected $userService = null;

	/**
	 * @var Oauth2HandlerInterface
	 */
	protected $oauth2Handler = null;

	/**
	 * Constructor
	 *
	 * @param UserServiceInterface $userService
	 * @param Oauth2HandlerInterface $oauth2Handler
	 */
	public function __construct(
		UserServiceInterface $userService, 
		Oauth2HandlerInterface $oauth2Handler)
	{
		$this->userService = $userService;
		$this->oauth2Handler = $oauth2Handler;
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */	
	public function get($mixed)
	{
		$this->methodNotAllowed();		
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
	public function getList()
	{
        $this->methodNotAllowed();
	}

    /**
     * Perform login action
     *
     * @return void
     */
	public function create($data)
	{
		$user = $this->userService->getUserByUsername($data['username']);
		$bcrypt = new Bcrypt();
		if (!empty($user) && $bcrypt->verify($data['password'], $user->getPassword())) {

			$response = $this->oauth2Handler->bootstrap();
			if (!$response->isSuccessful()) {
				return new JsonModel(array(
					'result' => false,
					'message' => 'Invalid Authorization',
				));
			}
			return new JsonModel($response->getParameters());
		} else {
			return new JsonModel(array(
				'result' => false,
				'message' => 'Login information was incorrect',
			));
		}
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
	public function update($id, $data) 
	{
		$this->methodNotAllowed();
	}

    /**
     * Method not available for this endpoint
     *
     * @return void
     */
	public function delete($id)
	{
		$this->methodNotAllowed();
	}

    /**
     * A convenient method for not allowed method
     *
     * @return array
     */
	protected function methodNotAllowed()
	{
        $this->response->setStatusCode(405);

        return [
            'content' => 'Method Not Allowed'
        ];		
	}		
}