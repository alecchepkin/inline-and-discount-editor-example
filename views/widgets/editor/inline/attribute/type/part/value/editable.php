<?php

print CHtml::openTag('div', array(
		'class' => 'cell cell-edit',
));

print CHtml::link($value, '#', array(
	'class' => 'value'
));

print CHtml::openTag('span', array(
		'class' => 'edit_container',
		'url' => $attribute->url,
));
print CHtml::closeTag('span');

print CHtml::closeTag('div');

