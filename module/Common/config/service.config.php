<?php 

return array(
	'invokables' => array(
		'Oauth2Listener' => 'Common\Listener\Oauth2Listener',
		'ResponseErrorListener' => 'Common\Listener\ResponseErrorListener',
	),	
	'factories' => array(
		// Db adapter service
		'NoteDbAdapter' => 'Common\Factory\Db\Adapter\DbAdapterFactory',

		// Oauth2 services
		'NoteOauth2Handler' => 'Common\Factory\Oauth2\Oauth2HandlerFactory',
		'NoteOauth2Server' => 'Common\Factory\Oauth2\ServerFactory',
		'NoteOauth2StoragePdo' => 'Common\Factory\Oauth2\Storage\StoragePdoFactory',
		'NoteOauth2UserCredentials' => 'Common\Factory\Oauth2\GrantType\UserCredentialsFactory',
	),
);