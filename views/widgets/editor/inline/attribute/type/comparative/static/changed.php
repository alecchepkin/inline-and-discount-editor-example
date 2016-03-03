<?php

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Предыдущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.expected', array(
	'value' => $attribute->expected
));

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'class' => 'changed',
	'attribute' => $attribute,
	'value' => $attribute->value
));
// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.empty');