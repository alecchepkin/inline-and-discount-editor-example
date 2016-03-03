<?php

class DropdownMethod extends MethodEditor
{
	protected $_values = array();
	
	protected $_selected;
	
	
	public function __toString()
	{
		$result = parent::__toString();
		$result['values'] = $this->values; 
		$result['selected'] = $this->selected; 
		return $result;
	}

	protected function getValues()
	{
		return $this->_values;
	}
	
	public function setValues(array $values)
	{
		$this->_values = (array) $values;
	}

	protected function getSelected()
	{
		return $this->_selected ?: 
			$this->owner->entity->getAttribute($this->name);
	}
	
	public function setSelected($selected)
	{
		$this->_selected = (int) $selected;
	}
}