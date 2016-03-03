define(['Command'], function (Command) {

	var EditCommand = function () {

		this.execute = function (attr) {
			attr.linkValue.hide();
			// add method
			attr.method.appendTo(attr.container);

			//focus
			$('input, select', attr.container).first().focus()
		};

		this.undo = function (attr) {
			console.log('undo');
			//return;
			if (attr.method.length) {
				try {
					attr.method.appendTo($(attr.target));
					var value = this.getValue(attr.method);

					// set value
					if (value) {
						attr.linkValue.text(value);
					} else {
						attr.linkValue.text('Указать');
					}

					// show link
					attr.linkValue.show();

					attr.setValue(value);

				} catch (err) {
					console.log('Ошибка при откате комманды:', err);
				}
			}

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

	EditCommand.prototype = new Command();
	EditCommand.prototype.constructor = EditCommand;
	return EditCommand;
});
