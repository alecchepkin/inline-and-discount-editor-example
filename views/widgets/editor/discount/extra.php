<?php

print CHtml::openTag('div', array('class' => 'extra-block filter-search-right'));
print CHtml::openTag('div', array('class' => 'filter-search-unit'));
print CHtml::openTag('label');
print CHtml::tag('div', array('class' => 'filter-search-unit-title'), 'Дополнительная скидка');
print CHtml::openTag('div', array('class' => 'filter-search-unit-select'));
print CHtml::openTag('div', array('class' => 'filter-search-unit-select-wrap'));
print CHtml::tag('input', array(
		'class' => 'extra',
		'value' => 0,
		'type' => 'number',
		'min' => '0',
		'max' => '100',
		//'onkeypress' => 'validate(event)'
));
print CHtml::closeTag('div');
print CHtml::closeTag('div');
print CHtml::closeTag('label');
print CHtml::closeTag('div');
print CHtml::closeTag('div'); // filter-search-left
