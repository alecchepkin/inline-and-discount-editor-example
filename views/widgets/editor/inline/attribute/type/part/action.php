<?php

print CHtml::openTag('div', array('class' => 'action cell'));

print CHtml::link('Удалить', '#',array('class'=>'del'));
print CHtml::link('Восстановить', '#',array('class'=>'res'));

print CHtml::closeTag('div');