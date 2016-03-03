<?php
$layout = $attribute->editable ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.comparative.editable' :
	'layouts.widgets.editor.inline.attribute.type.comparative.static';

$this->render($layout, array(
	'attribute' => $attribute
));