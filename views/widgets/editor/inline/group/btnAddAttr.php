<?php

if ($group->btnAddAttr) {
	print CHtml::openTag('div', array('class' => 'row fow-btnAddAttr'));
	print CHtml::openTag('div', array('class' => 'cell'));
	print CHtml::link('Добавить', '#', array('class' => 'add'));
	print CHtml::closeTag('div');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	if ($group->comparative) {
		print CHtml::tag('div', array('class' => 'cell'), '&nbsp;');
	}

//	print CHtml::openTag('div', array('class' => 'templates'));
//	$this->render('layouts.widgets.editor.inline.attribute', array('attribute' => $attribute));
//	print CHtml::closeTag('div');

	print CHtml::closeTag('div');
}
