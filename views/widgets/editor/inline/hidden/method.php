<?php
print CHtml::openTag('span', array('class' => $method->id . 'method-hidden'));

switch ($method->name) {
	case 'AutocompleteMethod':
		$layout = 'layouts.widgets.editor.inline.hidden.method.autocomplete';
		break;
	case 'DropdownMethod':
		$layout = 'layouts.widgets.editor.inline.hidden.method.dropdown';
		break;
	case 'PopupMethod':
		$layout = 'layouts.widgets.editor.inline.hidden.method.popup';
		break;
	case 'TextMethod':
		$layout = 'layouts.widgets.editor.inline.hidden.method.text';
		break;
	case 'NestedEditorMethod':
		$layout = 'layouts.widgets.editor.inline.hidden.method.nestedEditor';
		break;
}

$this->render($layout, array(
	'method' => $method
));

print CHtml::closeTag('span');
