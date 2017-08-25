<?php

return array(
	'oauth2_config' => array(
		'access_lifetime' => 86400,
	),
	'view_manager' => array(
		'display_not_found_reason' => true,
		'display_exceptions'       => true,
		'doctype'                  => 'HTML5',
		'not_found_template'       => 'error/404',
		'exception_template'       => 'error/index',
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
);