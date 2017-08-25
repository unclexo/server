<?php
namespace User\Controller;

use User\Service\UserServiceInterface;
use Common\Oauth2\Storage\StorageInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class RevokeController extends AbstractRestfulController
{
	/**
	 * @var UserServiceInterface
	 */
	protected $userService = null;

	/**
	 * @var StorageInterface
	 */
	protected $oauth2StoragePdo = null;		

	/**
	 * Constructor
	 *
	 * @param UserServiceInterface $userService
	 * @param Oauth2HandlerInterface $oauth2Handler
	 */
	public function __construct(
		UserServiceInterface $userService, 
		StorageInterface $oauth2StoragePdo)
	{
		$this->userService = $userService;
		$this->oauth2StoragePdo = $oauth2StoragePdo;
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
     * Method not available for this endpoint
     *
     * @return void
     */
	public function create($data)
	{
		$this->methodNotAllowed();
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
     * Revoke user access token
     *
     * @return bool
     */
	public function delete($id)
	{
		$user = $this->userService->getUserByUsername($id);
		if (!$user) {
			return new JsonModel(array(
				'result' => false,
				'message' => 'Invalid user for revoking token',
			));
		}

		$token = $this->params()->fromRoute('token');

		return new JsonModel(array(
			'result' => $this->oauth2StoragePdo->revokeAccessToken($id, $token)
		));

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