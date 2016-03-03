<?php
if ($group->btnEditGroup) {
	print CHtml::openTag('div', array('class' => 'row row-btnEditGroup'));
	print CHtml::openTag('div', array('class' => 'cell'));
	print CHtml::link('Редактировать', '#', array('class' => 'edit'));
	print CHtml::closeTag('div');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	if ($group->comparative) {
		print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	}
	print CHtml::closeTag('div');
}
