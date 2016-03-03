<?php

print CHtml::openTag('div', array(
		'class' => 'widget'
));
print CHtml::openTag('div', array(
		'id' => $scheme->id,
		'class' => 'discount-editor'
));
print CHtml::openTag('div', array('class' => 'colset'));
$this->render('layouts.widgets.editor.discount.types', array(
	'types' => $scheme->types
));
$this->render('layouts.widgets.editor.discount.extra');
print CHtml::closeTag('div'); // colset

$this->render('layouts.widgets.editor.discount.groups', array(
	'groups' => $scheme->groups
));

$this->render('layouts.widgets.editor.discount.json', array('scheme' => $scheme));
print CHtml::closeTag('div');
print CHtml::closeTag('div');
