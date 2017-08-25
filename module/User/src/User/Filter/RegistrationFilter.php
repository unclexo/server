<?php 
namespace User\Filter;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\TableIdentifier;
use Zend\InputFilter\InputFilter;

class RegistrationFilter extends InputFilter
{
	/**
	 * @var AdapterInterface
	 */
	protected $adapter = null;

	/**
	 * @var string|array|TableIdentifier
	 */
	protected $table = null;

	/**
	 * Contructor
	 *
	 * @param Adapter $adapter
	 * @return null
	 */
	public function __construct(AdapterInterface $adapter, $table)
	{
        if (!is_string($table) && !$table instanceof TableIdentifier && !is_array($table)) {
            throw new \Exception('This table object does not have a valid table set!');
        }

		$this->adapter = $adapter;
		$this->table = $table;
		$this->addFilters();
	}

	public function addFilters()
	{
		$this->add(array(
			'name' => 'username',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 3,
						'max' => 40,
					),
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table' => $this->getTable(),
						'field' => 'username',
						'adapter' => $this->getAdapter(), 
					),
					'break_chain_on_failure' => true,
				),
			),
		));

		$this->add(array(
			'name' => 'email',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 8,
						'max' => 40,
					),
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'EmailAddress',
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'Zend\Validator\Db\NoRecordExists',
					'options' => array(
						'table' => $this->getTable(),
						'field' => 'email',
						'adapter' => $this->getAdapter(), 
					),
					'break_chain_on_failure' => true,
				),
			),
		));

		$this->add(array(
			'name' => 'password',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'NotEmpty',
					'break_chain_on_failure' => true,
				),
				array(
					'name' => 'StringLength',
					'options' => array(
						'min' => 8,
						'max' => 60,
					),
					'break_chain_on_failure' => true,
				),
			),
		));				
	}

	/**
	 * Get db adapter
	 *
	 * @return AdapterInterface
	 */
	public function getAdapter()
	{
		return $this->adapter;
	}

	/**
	 * Get table name
	 *
	 * @return string
	 */
	public function getTable()
	{
		return $this->table;
	}			
}