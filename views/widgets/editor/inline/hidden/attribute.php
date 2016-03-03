<?php

print CHtml::openTag('div', array(
		'class' => $attribute->name . '-attribute-hidden',
		'id' => $attribute->target,
		'fields' => json_encode($attribute)
));

print CHtml::openTag('span', array('class' => 'method'));

$this->render('layouts.widgets.editor.inline.hidden.method', array(
	'method' => $attribute->method
));

print CHtml::closeTag('span');



print CHtml::closeTag('div');
