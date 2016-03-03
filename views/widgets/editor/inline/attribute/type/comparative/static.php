<?php

$layouts = array( // Шаблоны состояний атрибута
	RevisionHelper::CHANGE_CREATE => 'layouts.widgets.editor.inline.attribute.type.comparative.static.added',
	RevisionHelper::CHANGE_NONE => 'layouts.widgets.editor.inline.attribute.type.comparative.static.none',
	RevisionHelper::CHANGE_REMOVE => 'layouts.widgets.editor.inline.attribute.type.comparative.static.removed',
	RevisionHelper::CHANGE_UPDATE => 'layouts.widgets.editor.inline.attribute.type.comparative.static.changed'
);

$this->render(Map::get($layouts, $attribute->state), array(
	'attribute' => $attribute
));