<?php

$layout = $attribute->editable ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.part.value.editable' :
	'layouts.widgets.editor.inline.attribute.type.part.value.static';

$this->render($layout, array(
	'class' => $class,
	'value' => $value,
	'attribute' => $attribute
));