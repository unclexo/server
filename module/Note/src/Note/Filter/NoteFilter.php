<?php 
namespace Note\Filter;

use Zend\InputFilter\InputFilter;

class NoteFilter extends InputFilter
{
	public function __construct()
	{
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'userId',
			'required' => true,
			'filters' => array(
				array('name' => 'Digits'),
			),
		));
		$this->add(array(
			'name' => 'note',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'encoding' => 'UTF-8',
						'min' => 3,
						'max' => 1000,
					),
				),
			),
		));				
	}		
}