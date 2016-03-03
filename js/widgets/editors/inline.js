$(document).ready(function () {

	$('div.widget div.inline-editor .group.level-1').accordion({
		heightStyle: 'content',
		animate: false,
		collapsible: true
	});
	$('div.widget div.inline-editor .group.level-2').accordion({
		heightStyle: 'content',
		animate: false,
		collapsible: true,
		active: true
	});
	
	$('span.method div.widget div.inline-editor .group').accordion({
		heightStyle: 'content',
		animate: false,
		collapsible: false,
		active: true
	});
		
	$('div.inline-editor').editor();
	
})
