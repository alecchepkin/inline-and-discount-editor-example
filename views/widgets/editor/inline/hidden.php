<?php
print CHtml::openTag('div', array(
	'style' => 'display:none;',
	'id' => 'editor-hidden'
));
$this->render('layouts.widgets.editor.inline.hidden.group', array(
		'group' => $group
	));
print CHtml::closeTag('div');




