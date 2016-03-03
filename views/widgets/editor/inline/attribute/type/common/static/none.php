<?php

$layout = $attribute->value ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.comparative.static.none.change' :
	'layouts.widgets.editor.inline.attribute.type.comparative.static.none.notSpecified';

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Данные атрибута
$this->render($layout, array(
	'attribute' => $attribute
));