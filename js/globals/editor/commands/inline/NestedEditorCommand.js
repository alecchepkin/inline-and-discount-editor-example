define(['Command'], function (Command) {

	var NestedEditorCommand = function () {
		var self = this;
		this.execute = function (attr) {
			var containerAttrEditor = $('<div id="containder-attr-editor">');
			$('body').after(containerAttrEditor);
			$('body > div.content').css({
				'pointer-events': 'none',
				'opacity': 0.5
			});
			$(attr.row).addClass('selectedToEdit');
			var calculateCSSForContainer = function () {
				return {
					position: 'absolute',
					top: $(attr.row).offset().top + $(attr.row).outerHeight(),
					left: $(attr.row).offset().left,
					width: $(attr.row).outerWidth()-4
				}
			};
			containerAttrEditor.css(calculateCSSForContainer());

			$(attr.method).appendTo(containerAttrEditor);
			$('body:not(#containder-attr-editor)')
					.unbind('click')
					.bind('click', attr.undo);
			$(window).resize(function () {
				containerAttrEditor.css(calculateCSSForContainer());
			});
		};

		this.undo = function (attr) {
			console.log('undo');
			var containerAttrEditor = $('#containder-attr-editor');
			$('body > div.content').css({
				'pointer-events': 'auto',
				'opacity': 1
			});
			$(attr.row).removeClass('selectedToEdit');
			attr.method.appendTo($(attr.target));
			containerAttrEditor.remove();
			var value = attr.getValueFromMethod();
			attr.setValue(value);
			attr.updateUI();
		};

		this.getValue = function (context) {
			if ($('input', context).length) {
				return $('input', context).first().val();
			}
			if ($('select', context).length) {
				return $('select option:selected', context).first().text();
			}
		}
	};

	NestedEditorCommand.prototype = new Command();
	NestedEditorCommand.prototype.constructor = NestedEditorCommand;
	return NestedEditorCommand;
});
