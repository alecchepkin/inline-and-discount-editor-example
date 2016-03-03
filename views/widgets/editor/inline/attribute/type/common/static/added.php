<?php

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Предыдущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.expected', array(
	'value' => $attribute->default
));

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'class' => 'added',
	'attribute' => $attribute,
	'value' => $attribute->value
));