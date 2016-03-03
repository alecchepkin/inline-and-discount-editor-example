<?php

print CHtml::openTag('div', array('class' => $group->id . '-group-hidden'));

foreach ($group->attributes as $attribute) {
	$this->render('layouts.widgets.editor.inline.hidden.attribute', array(
		'attribute' => $attribute
	));
}


foreach ($group->groups as $group) {
	$this->render('layouts.widgets.editor.inline.hidden.group', array(
		'group' => $group
	));
}

print CHtml::closeTag('div');
