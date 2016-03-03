<?php

$output = $label ? $label : null;
print CHtml::tag('div', array('class' => 'label cell'), $output);