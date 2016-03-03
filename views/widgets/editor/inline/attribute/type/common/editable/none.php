<?php

$layout = $attribute->value ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.common.editable.none.change' :
	'layouts.widgets.editor.inline.attribute.type.common.editable.none.specify';

// Лейбл атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.label', array(
	'label' => $attribute->label
));

// Данные атрибута
$this->render($layout, array(
	'attribute' => $attribute
));