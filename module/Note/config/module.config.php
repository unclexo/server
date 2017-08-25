<?php 

return array(
	'router' => array(
		'routes' => array(
			'note' => array(
				'type' => 'Zend\Mvc\Router\Http\Segment',
				'options' => array(
					'route' => '/api/v1/note[/:id]',
					'constraints' => array(
						'id' => '[a-zA-Z0-9_-]+',
					),
					'defaults' => array(
						'controller' => 'NoteNoteIndexController',
					),
				),
			),			
		),
	),
);