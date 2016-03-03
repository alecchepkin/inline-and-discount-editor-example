<?php

// Текущее значение атрибута
$this->render('layouts.widgets.editor.inline.attribute.type.part.value', array(
	'class' => 'none',
	'attribute' => $attribute,
	'value' => $this->actions->specify
));

// Действия, применимые к атрибуту
$this->render('layouts.widgets.editor.inline.attribute.type.part.empty');
