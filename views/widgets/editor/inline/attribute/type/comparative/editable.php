<?php

$layouts = array( // Шаблоны состояний атрибута
	RevisionHelper::CHANGE_CREATE => 'layouts.widgets.editor.inline.attribute.type.comparative.editable.added',
	RevisionHelper::CHANGE_NONE => 'layouts.widgets.editor.inline.attribute.type.comparative.editable.none',
	RevisionHelper::CHANGE_REMOVE => 'layouts.widgets.editor.inline.attribute.type.comparative.editable.removed',
	RevisionHelper::CHANGE_UPDATE => 'layouts.widgets.editor.inline.attribute.type.comparative.editable.changed'
);

$this->render(Map::get($layouts, $attribute->state), array(
	'attribute' => $attribute
));