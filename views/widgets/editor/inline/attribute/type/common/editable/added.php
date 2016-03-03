<?php

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'attribute' => $attribute,
	'class' => 'added',
	'value' => $attribute->value
));

// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.action', array(
	'action' => $this->actions->remove,
	'class'=>'del'
));