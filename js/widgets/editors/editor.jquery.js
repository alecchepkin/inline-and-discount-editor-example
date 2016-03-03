var EditorAttr = function (_row) {
	var self = this,
			owner;
	this.row = _row;
	this.target = $(this.row).attr('target');
	this.linkValue = $('a.value', this.row);
	this.container = $('span.edit_container', this.row);
	this.fields = $.parseJSON($(this.target).attr('fields'));
	this.fields.prevValue = this.fields.value;
	this.method = $(this.target + ' > span.method');

	this.states = {
		'none': 0,
		'added': 1,
		'changed': 2,
		'removed': 3
	};

	this.getModel = function () {
		console.log('getModel');
	}

	this.handler = function (method) {
		$('command', self.row).each(function (i, el) {
			var name = $(this).attr('name');
			require(['editor/commands/inline/' + name], function (Command) {
				if (method == 'execute') {
					(new Command).execute(self);
				} else {
					(new Command).undo(self);
				}
			});
		});
	};

	this.setValue = function (value) {
		this.fields.prevValue = this.fields.value;
		this.fields.value = value;
		this.changeState();
	};

	this.getValue = function () {
		return this.fields.value;
	};

	this.getValueFromMethod = function () {
		switch (this.fields.method.name) {
			case 'DropdownMethod':
				return $('select', this.method).val();
				break;
			case 'AutocompleteMethod':
				return $('input[type=hidden]', this.method).val();
				break;
			default:
				return this.getValue();
		}
	};

	this.synchronizeJsObjAndHTMLHiddenAttr = function () {

	};

	this.setValueLabel = function (value) {
		this.setValue(value);
		this.synchronizeJsObjAndHTMLHiddenAttr();
		if (!this.fields.value && this.fields.expected) {
			value = this.fields.expected;
		} else if (!this.fields.value) {
			value = 'Указать';
		}
		$('div.cell-edit a.value', this.row).text(value);

	};


	this.execute = function () {
		self.handler('execute');
		return false;
	};
	this.undo = function () {
		self.handler('undo');
	};

	this.delete = function () {
		console.log('delete');
		self.setValueLabel('')
		return false;
	};

	this.restore = function () {
		console.log('restore', self.fields.expected);
		self.setValueLabel(self.fields.expected);
		return false;
	};

	this.sendChangesToServer = function () {
		console.log('sendChangesToServer');
		console.log('this.fields.id', this.fields.id);
		console.log('this.fields', this.fields);
		$.ajax({
			type: 'post',
			data: {
				entity: this.fields.entity,
				entity_id: this.fields.entity_id,
				attribute: this.fields.name,
				value: this.getValueFromMethod()
			},
			dataType: 'json',
			url: self.fields.url,
			success: function (data) {
				console.log(data.fields);
				console.log('Данные сохраненны ...');
				self.setFieldsIfChanged(data);
				$('#id').val(data.fields.entity_id);
			},
			error: function () {
				console.log('Не удалось сохранить...');
			}
		});
	};
	this.setFieldsIfChanged = function (data) {
		if (data.fields != undefined) {
			var callback = function (attr) {
				$.each(data.fields, function (field, value) {
					attr.setField(field, value);
					console.log(field, value);
				});
			};
			self.owner.walkWith(callback);
		}
		;
	};

	this.setField = function (field, value) {
		this.fields[field] = value;
	};

	this.updateUI = function () {
		console.log('updateUI');
		console.log('getStateName' + this.getStateName());

		$(this.row).attr('class', 'attribute row ' + this.getStateName());
		this.labelUpdate();
		this.valueUpdate();

	};
	this.labelUpdate = function () {
		var label = 'новый ЛЕЙБЛ';
//		$('div.label', this.row).text(label);
	};

	this.valueUpdate = function () {
		var value = this.fields.value;
//		$('div.cell-edit > a.value', this.row).text(value);
	};

	this.changeState = function () {

		var oldState = this.fields.state;
		var newState = oldState;
		var expected = this.fields.expected,
				value = this.fields.value;
		console.log('expected', expected);
		console.log('value', value);
		if (expected && !value) {
			newState = this.states.removed;
		} else if (!expected && value) {
			newState = this.states.added;
		} else if (expected !== value) {
			newState = this.states.changed;
		} else {
			newState = this.states.none;
		}
		this.fields.state = newState;

		if (oldState != newState ||
				this.prevValue !== value) {
			this.rowChanged();
		}
	};

	this.rowChanged = function (state) {
		this.sendChangesToServer();
		this.updateUI();
	};
	this.getState = function () {
		return this.fields.state;
	};

	this.getKeyState = function (key) {
		var s = this.invertObjectKeys(this.states);
		return s[key];
	};
	this.getStateName = function () {
		return this.getKeyState(this.getState());
	};

	this.invertObjectKeys = function (obj) {
		var new_obj = {};
		for (var prop in obj) {
			if (obj.hasOwnProperty(prop)) {
				new_obj[obj[prop]] = prop;
			}
		}
		return new_obj;
	};

};


/**
 * Comment
 */
var InlineEditorRepository = function () {
	var self = this;
	self.groups = {};

	self.addAttr = function (attr) {
		var group = addGroupWithKey(attr.fields.group_id);
		attr.owner = group;
		group.addAttr(attr);
	}
	addGroupWithKey = function (key) {
		if (!self.groupByKey(key)) {
			self.groups[key] = new InlineEditorGroup(key);
		}
		return self.groups[key];
	}
	self.groupByKey = function (key) {
		if (typeof self.groups[key] !== 'undefined') {
			return self.groups[key];
		}
	}
};
var InlineEditorGroup = function (groupId) {
	var self = this;
	self.groupId = groupId;
	self.attributes = {};

	self.addAttr = function (attr) {
		self.attributes[attr.fields.target] = attr;
	};

	self.attrByKey = function (key) {
		if (typeof self.attributes[key] !== 'undefined') {
			return self.attributes[key];
		}
	}

	self.walkWith = function (callback) {
		$.each(self.attributes, function (i, attr) {
			callback(attr);
		});
	};
};
$.fn.editor = function () {
	var editor = new InlineEditorRepository();
	$('div.attribute.row', this).each(function (i, el) {
		var attr = new EditorAttr(this);
		editor.addAttr(attr);

		$('div.cell-edit a.value', this).click(attr.execute);
		$('span.edit_container', this).focusout(attr.undo);
		$('div.action a.del', this).click(attr.delete);
		$('div.action a.res', this).click(attr.restore);

		// для вложенного редактора
		$('div.inline-editor > div.table-data-client > div.table-data-client-header', attr.method).click(attr.undo);
	});
	$('input[spec="autocomplete"]', this).each(function () {
		$(this).finder({
			hiddenFieldSelector: $(this).attr('target'),
			requestUrl: $(this).attr('request')
		});
	});

	console.log('Editor', editor);
};

