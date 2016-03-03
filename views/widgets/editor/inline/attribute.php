<?php

print CHtml::openTag('div', array(
		'class' => 'attribute row '.$this->getTypeByState($attribute->state),
		'spec' => 'attr-inline-editor',
		'target' => $attribute->targetWithHash,
));

$this->render('layouts.widgets.editor.inline.attribute.type', array('attribute' => $attribute));

$this->render('layouts.widgets.editor.inline.attribute.commands', array(
	'attribute' => $attribute
));
 
 
print CHtml::closeTag('div');

