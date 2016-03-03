<?php

if ($group->btnAddGroup) {

	print CHtml::openTag('div', array('class' => 'row row-btnAddGroup'));
	print CHtml::openTag('div', array('class' => 'cell'));
	print CHtml::link('Добавить', '#', array('class' => 'add'));
	print CHtml::closeTag('div');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	if ($group->comparative) {
		print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	}
	print CHtml::closeTag('div');
}
?>