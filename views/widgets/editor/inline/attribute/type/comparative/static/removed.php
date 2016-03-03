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
	'class' => 'removed',
	'attribute' => $attribute,
	'value' => $attribute->expected
));

// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.empty');