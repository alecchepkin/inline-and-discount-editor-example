<?php

print CHtml::openTag('command', array(
	'name' => 'EditCommand',
	'target' => '#' . $attribute->getTarget()
));