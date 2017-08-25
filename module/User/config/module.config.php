<?php

return array(
	'router' => array(
		'routes' => array(
			'create-user' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/api/v1/user/create',
					'constraints' => array(
						'id' => '[a-zA-Z0-9_-]+',
					),
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
					),
				),
			),						
			'login-user' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/api/v1/user/login',
					'defaults' => array(
						'controller' => 'NoteUserLoginController',
					),
				),
			),
			'get-user' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/api/v1/user/get/:id',
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
					),
				),
			),
			'update-user' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/api/v1/user/update/:id',
					'constraints' => array(
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'NoteUserIndexController',
					),
				),
			),			
			'revoke-user' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/api/v1/user/revoke/:id/:token',
					'constraints' => [
						'token' => '[a-z-A-Z0-9]+',
					],
					'defaults' => array(
						'controller' => 'NoteUserRevokeController',
					),
				),
			),						
		),
	),
    'upload_config' => array(
        // 'upload_path' => __DIR__ . '/../data/uploads',
        'upload_path' => 'public/uploads',
    ),	
);