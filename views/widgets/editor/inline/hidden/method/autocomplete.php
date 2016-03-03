<?php

print CHtml::textField($method->name, $method->value, array(
	'spec' => 'autocomplete',
	'target' => 'input#' . $method->id.'_hidden',
	'request' => $method->url,
));
print CHtml::hiddenField($method->id.'_hidden', null, array());

