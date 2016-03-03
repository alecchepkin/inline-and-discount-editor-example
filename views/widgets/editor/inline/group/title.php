<?php

if ($group->title) {
	print CHtml::openTag('div', array('class' => 'table-data-client-header'));
	print CHtml::tag('h6', array(), $group->title);
	print CHtml::link('', '#');
	print CHtml::closeTag('div');
}

