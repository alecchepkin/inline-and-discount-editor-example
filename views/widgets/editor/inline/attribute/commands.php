<?php

print CHtml::openTag('commands', array(
));
print CHtml::tag('command', $attribute->method->options);
print CHtml::closeTag('commands');
