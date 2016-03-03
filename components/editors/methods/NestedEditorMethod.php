<?php

class NestedEditorMethod extends MethodEditor
{
	const COMMAND = 'NestedEditorCommand';

	protected $_editor;

	
	public function __toString()
	{
		$result = parent::__toString();
		$result['editor'] = $this->editor; 
		return $result;
	}

	protected function getEditor()
	{
		return $this->_editor;
	}

	protected function setEditor(EntityEditor $editor)
	{
		$this->_editor = $editor;
	}

}
