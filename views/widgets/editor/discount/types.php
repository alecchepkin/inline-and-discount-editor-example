<?php

print CHtml::openTag('div', array('class' => 'filter-search-left'));
print CHtml::openTag('div', array('class' => 'types-block'));
foreach ($types as $i => $type) {
	print CHtml::openTag('div', array('class' => 'filter-search-unit'));
	print CHtml::openTag('label');
	print CHtml::tag('div', array('class' => 'filter-search-unit-title'), $type->name);
	print CHtml::openTag('div', array('class' => 'filter-search-unit-select'));
	print CHtml::openTag('div', array('class' => 'filter-search-unit-select-wrap'));
	print CHtml::dropDownList('type'.$i, null, $type->competitors, array('data-type'=>$type->equip_type_id));
	print CHtml::tag('span', array('class' => 'filter-search-unit-select-button'));
	print CHtml::closeTag('div');
	print CHtml::closeTag('div');
	print CHtml::closeTag('label');
	print CHtml::closeTag('div');
}
print CHtml::closeTag('div'); // div.types-block
print CHtml::closeTag('div'); // div.filter-search-left
