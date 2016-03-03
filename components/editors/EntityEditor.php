<?php

/**
 * 
 */
abstract class EntityEditor extends Component
{

	protected $_id;

	/**
	 *
	 * @var type 
	 */
	protected $_root;
	


	/**
	 * 
	 * @return	
	 */
	abstract  public function generateScheme();

	public static function instance($id, $config)
	{
		$self = new static($id);
		$self->load($config);
		return $self;
	}
	
	protected function __construct($id)
	{
		$this->_id = $id;
	}

	protected function getId()
	{
		return $this->_id;
	}

}
