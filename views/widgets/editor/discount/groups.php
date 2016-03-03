<?php

print CHtml::openTag('div', array('class' => 'groups-block inside-table'));
print CHtml::openTag('div', array('class' => 'inside-table-row'));
print CHtml::openTag('div', array('class' => 'middle'));
print CHtml::openTag('div', array('class' => 'table-search'));
print CHtml::openTag('table', array('class' => 'items'));

print CHtml::openTag('thead');
print CHtml::openTag('tr');
print CHtml::tag('th', array(), 'Группы товаров');
print CHtml::tag('th', array(), 'Страна производитель конкурентного оборудования');
print CHtml::tag('th', array(), 'Наша скидка, чтобы быть вровень по рознице с конкурентом, %');
print CHtml::tag('th', array(), 'Скидка, которую дает конкурент, %');
print CHtml::tag('th', array(), 'Насколько мы хотим быть дешевле конкурента,%');
print CHtml::tag('th', array(), 'Какая скидка нам для этого необходима, %');
print CHtml::tag('th', array(), 'Скидка на утверждение,%');
print CHtml::tag('th', array(), 'Итоговая скидка с учетом дополнительной, %');
print CHtml::closeTag('tr'); // table.items
print CHtml::closeTag('thead'); // table.items

print CHtml::openTag('tbody');

foreach ($groups as $group) {
	print CHtml::openTag('tr', array(
		'id' => 'group-'.$group->groupId,
		'data-id' => $group->groupId,
	));
	print CHtml::tag('td', array('class' => 'nameGroup'), $group->nameGroup);
	print CHtml::tag('td', array('class' => 'countryCompetitor'));
	print CHtml::tag('td', array('class' => 'discountOur'));

	print CHtml::openTag('td', array('class' => 'discountGivenByCompetitor'));
	print CHtml::tag('input', array(	
		'value' => '',
		'type' => 'number',
		'min' => '0',
		'max' => '100',
	));
	print CHtml::closeTag('td'); // td.discountGivenByCompetitor

	print CHtml::openTag('td', array('class' => 'discountWeWantAddToGivenCompetitor'));
	print CHtml::tag('input', array(	
		'value' => '',
		'type' => 'number',
		'min' => '0',
		'max' => '100',));
	print CHtml::closeTag('td'); // td.discountWeWantAddToGivenCompetitor

	print CHtml::tag('td', array('class' => 'discountRequired'));

	print CHtml::openTag('td', array('class' => 'discountForApproval'));
	print CHtml::tag('input', array(	
		'value' => '',
		'type' => 'number',
		'min' => '0',
		'max' => '100',));
	print CHtml::closeTag('td'); // td.discountForApproval

	print CHtml::tag('td', array('class' => 'discountTotalWithExtra'));
	print CHtml::closeTag('tr');
}

print CHtml::closeTag('tbody');

print CHtml::closeTag('table'); // table.items
print CHtml::closeTag('div'); // div.table-search
print CHtml::closeTag('div'); // div.middle
print CHtml::closeTag('div'); // div.inside-table-row
print CHtml::closeTag('div'); // div.inside-table