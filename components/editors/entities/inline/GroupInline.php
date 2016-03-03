<?php

class GroupInline extends GroupEditor
{

	use ElementInline;

	protected $_open = true;

	protected function setOpen($open)
	{
		$this->_open = (boolean) $open;
	}

	protected function getOpen()
	{
		return (boolean) $this->_open;
	}

	public function createAttribute($id, array $config = array())
	{
		return AttributeInline::instance($id, $this, $config);
	}

	public function createGroup($id, array $config = array())
	{
		return GroupInline::instance($id, $this, $config);
	}

}
