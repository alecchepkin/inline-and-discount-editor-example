<?php
$layout = $attribute->editable ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.common.editable' :
	'layouts.widgets.editor.inline.attribute.type.common.static';

$this->render($layout, array(
	'attribute' => $attribute
));