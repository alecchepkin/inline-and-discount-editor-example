<?php

// Предыдущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.expected', array(
	'value' => $attribute->expected ?
		$attribute->expected :
		$attribute->default
));

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'class' => 'none',
	'attribute' => $attribute,
	'value' => $attribute->default
));

// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.empty');