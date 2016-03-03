<?php

print CHtml::openTag('script', array('type'=>'text/javascript'));
print '/*<![CDATA[*/';
print 'var ' . $scheme->id. ' = ' . CJSON::encode($scheme) . ';';
print '/*]]>*/';
print CHtml::closeTag('script');

