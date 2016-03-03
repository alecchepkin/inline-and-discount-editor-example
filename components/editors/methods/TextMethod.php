<?php

class TextMethod extends MethodEditor
{
	protected $_value;
	
	
	public function __toString()
	{
		$result = parent::__toString();
		$result['value'] = $this->value; 
		return $result;
	}
	
	protected function getValue()
	{
		return $this->_value ?: 
			$this->_name ? $this->entity->getAttribute($this->_name) :
			$this->owner->value;
	}
	
	protected function setValue($value)
	{
		$this->_value = (string) $value;
	}
	
	
	
}