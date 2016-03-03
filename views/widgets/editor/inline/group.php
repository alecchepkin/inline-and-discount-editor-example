<?php

print CHtml::openTag('div', array('class' => 'table-data-client group level-'.$group->level . ' ' .$group->open));

$this->render('layouts.widgets.editor.inline.group.title', array('group' => $group));

print CHtml::openTag('div', array('class' => 'table-data-client-body'));
print CHtml::openTag('div', array('class' => 'table'));

if ($group->attributes) {
	foreach ($group->attributes as $attribute) {
		$this->render('layouts.widgets.editor.inline.attribute', array('attribute' => $attribute));
	}
}

$this->render('layouts.widgets.editor.inline.group.btnAddAttr', array('group' => $group));
$this->render('layouts.widgets.editor.inline.group.btnEditGroup', array('group' => $group));
$this->render('layouts.widgets.editor.inline.group.btnAddGroup', array('group' => $group));


print CHtml::closeTag('div');

foreach ($group->groups as $_group) {
	$this->render('layouts.widgets.editor.inline.group', array('group' => $_group));
}

print CHtml::closeTag('div');
print CHtml::closeTag('div');
