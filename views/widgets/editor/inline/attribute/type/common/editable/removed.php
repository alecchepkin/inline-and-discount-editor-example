<?php

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'class' => 'removed',
	'attribute' => $attribute,
	'value' => $attribute->expected
));

// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.action', array(
	'action' => $this->actions->restore,
	'class'=>'res'
));