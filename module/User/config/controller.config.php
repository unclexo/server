<?php

return array(
	'factories' => array(
		'NoteUserIndexController' => 'User\Factory\Controller\IndexControllerFactory',
		'NoteUserLoginController' => 'User\Factory\Controller\LoginControllerFactory',
		'NoteUserRevokeController' => 'User\Factory\Controller\RevokeControllerFactory',
	),
);