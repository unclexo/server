<?php

return array(
	'invokables' => array(
		'NoteFileEntity' => 'User\Entity\FileEntity',
		'NoteUserEntity' => 'User\Entity\UserEntity',
		'NoteProfileFilter' => 'User\Filter\ProfileFilter',
	),	
	'factories' => array(
		// Filter services
		'NoteRegistrationFilter' => 'User\Factory\Filter\RegistrationFilterFactory',

		// Service services
		'NoteUserService' => 'User\Factory\Service\UserServiceFactory',
		'NoteFileService' => 'User\Factory\Service\FileServiceFactory',

		// Mapper services
		'NoteFileMapper' => 'User\Factory\Mapper\FileMapperFactory',
		'NoteUserMapper' => 'User\Factory\Mapper\UserMapperFactory',	
	),
);