<?php 
namespace User\Filter;

use Zend\InputFilter\InputFilter;
use Zend\Validator\File\MimeType;
use Zend\Validator\File\Size;

class ProfileFilter extends InputFilter
{
	/**
	 * Contructor
	 */
	public function __construct()
	{
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'location',
			'required' => false,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 3,
						'max' => 40,
					),
					'break_chain_on_failure' => true,
				),
			),
		));

		$this->add(array(
			'name' => 'gender',
			'required' => false,
			'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'InArray',
					'options' => array(
						'haystack' => array('0', '1'),
					),
					'break_chain_on_failure' => true,
				),
			),
		));

        $this->add(array(
            'name' => 'avatar',
            'required' => false,
        ));					
	}		
}