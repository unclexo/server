<?php 

return array(
	'invokables' => array(
		'NoteNoteEntity' => 'Note\Entity\NoteEntity',
		'NoteNoteFilter' => 'Note\Filter\NoteFilter',
	),
	'factories' => array(
		'NoteNoteMapper' => 'Note\Factory\Mapper\NoteMapperFactory',
		'NoteNoteService' => 'Note\Factory\Service\NoteServiceFactory',
	),
);