<?php

print CHtml::openTag('div', array('class' => 'widget'));
print CHtml::openTag('div', array('class' => 'inline-editor'));
foreach ($scheme as $key => $group) {
	$this->render('layouts.widgets.editor.inline.group', array(
		'group' => $group,
	));
}
foreach ($scheme as $key => $group) {
	$this->render('layouts.widgets.editor.inline.hidden', array(
		'group' => $group
	));
}



print CHtml::closeTag('div');
print CHtml::closeTag('div');
