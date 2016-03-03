<?php

$layout = $attribute->comparative ? // Выбор подключаемого шаблона
	'layouts.widgets.editor.inline.attribute.type.comparative' :
	'layouts.widgets.editor.inline.attribute.type.common';
$this->render($layout, array('attribute' => $attribute));