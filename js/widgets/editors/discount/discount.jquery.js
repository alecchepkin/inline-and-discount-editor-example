$.fn.discountEditor = function () {
	var self = this;
	self.didSelectedCompetitorInType = function (equip_type_id, competitor_id) {
		model.setSelectedType(equip_type_id, competitor_id);
		model.calculate();
		updateUI();
	};

	self.groupInBlockDidChanged = function (groupId, fields) {
		var group = model.groupAtId(groupId);
		group.discountGivenByCompetitor = fields.discountGivenByCompetitor;
		group.discountWeWantAddToGivenCompetitor = fields.discountWeWantAddToGivenCompetitor;
		group.discountForApproval = fields.discountForApproval;
		model.calculate();
		updateUI();
	};

	self.extraInBlockDidChanged = function (extra) {
		console.log('extra in contr', extra);
		model.extra = extra;
		console.log('model.extra', model.extra);
		model.calculate();
		updateUI();
	};

	self.groupAtId = function (groupId) {
		return model.groupAtId(groupId);
	}

	function updateUI() {
		groupsBlock.update();
	}
	function parseScheme() {
		var id = $(self).attr('id');
		return window[id];
	}

	var typesBlock = new TypesBlock(self);
	var extraBlock = new ExtraBlock(self);
	var groupsBlock = new GroupsBlock(self);
	var scheme = parseScheme();
	var model = (new DiscountModel).discountModelWithScheme(scheme);
	model.calculate();
	updateUI();
};


var TypesBlock = function (controller_) {
	var self = this;
	var controller = controller_;
	var selector = '.types-block';
	var block = $(selector, controller);
	$('select', block).change(function () {
		var equip_type_id = $(this).data('type');
		var competitor_id = this.value;
		controller.didSelectedCompetitorInType(equip_type_id, competitor_id);
	});
};

var ExtraBlock = function (controller_) {
	var self = this;
	var controller = controller_;
	var selector = '.extra-block';
	var block = $(selector, controller);

	$('input.extra', block).change(handler);
	$('input.extra', block).keyup(handler);
	$('input.extra', block).focus(function () {
		if (0 == $(this).val()) {
			$(this).val('');
		}
	});
	$('input.extra', block).blur(function () {
		if ('' == $(this).val()) {
			$(this).val(0);
		}
	});
	function handler() {
		console.log($(this).val());
		controller.extraInBlockDidChanged($(this).val());
	}
};

var GroupsBlock = function (controller_) {
	var self = this;
	var controller = controller_;
	var selector = '.groups-block';

	self.update = function () {
		items().each(function (i, el) {
			var groupId = $(el).data('id');
			var fields = controller.groupAtId(groupId);
			$('td.countryCompetitor', el).text(fields.countryCompetitor);
			$('td.discountOur', el).text(fields.discountOur);
			$('td.discountRequired', el).text(fields.discountRequired);
			$('td.discountTotalWithExtra', el).text(fields.discountTotalWithExtra);
		});
	};


	$('td.discountGivenByCompetitor input, td.discountWeWantAddToGivenCompetitor input, td.discountForApproval input', block()).change(handler);
	$('td.discountGivenByCompetitor input, td.discountWeWantAddToGivenCompetitor input, td.discountForApproval input', block()).keyup(handler);

	function block() {
		return $(selector, controller);
	}

	function items() {
		return $('.items tbody tr', block());
	}

	function calculate(parameters) {

	}

	function handler() {
		var $td = $(this).parent();
		var $row = $td.parent();
		var groupId = $row.data('id');

		controller.groupInBlockDidChanged(groupId, {
			discountGivenByCompetitor: $('td.discountGivenByCompetitor input', $row).val(),
			discountWeWantAddToGivenCompetitor: $('td.discountWeWantAddToGivenCompetitor input', $row).val(),
			discountForApproval: $('td.discountForApproval input', $row).val()
		});
	}

};

var DiscountModel = function () {
	var self = this;

	this.extra = 0;

	self.types = [];
	self.groups = [];
	self.typeCompetitorDiscounts = {};

	self.setSelectedType = function (equip_type_id, competitor_id) {
		self.types[equip_type_id]['selected'] = competitor_id;
	}
	self.discountModelWithScheme = function (scheme) {

		var discountModel = new DiscountModel;

		// Types
		$.each(scheme.types, function (i, set) {
			var et = (new EquipmentTypeModel).equipmentTypeWithSchemeType(set);
			discountModel.types[et.equip_type_id] = et;
		});

		// Groups
		$.each(scheme.groups, function (i, sg) {
			var discountGroup = (new DiscountGroupModel).discountGroupWithSchemeGroup(sg);
			discountGroup.owner = discountModel;
			discountModel.insertGroup(discountGroup);
		});

		// Competitor Discounts
		$.each(scheme.competitorDiscounts, function (key, typeDiscountCompetitors) {
			discountModel.typeCompetitorDiscounts[key] = [];
			$.each(typeDiscountCompetitors, function (i, sc) {
				var competitorDiscount = (new CompetitorDiscountModel).competitorDiscountWithSchemeCompetitor(sc);
				discountModel.typeCompetitorDiscounts[key][i] = competitorDiscount;
			});
		});
		return discountModel;
	}

	self.keyOfCompetitor = function (competitor) {
		return competitor.equip_type_id + '_' + competitor.competitor_id
	}
	self.keyCompetitorFromType = function (type) {
		var cd = new CompetitorDiscountModel;
		cd.equip_type_id = type.equip_type_id;
		cd.competitor_id = type.selected;
		return self.keyOfCompetitor(cd);
	};

	self.groupAtId = function (id) {
		return self.groups[id];
	};
	self.insertGroup = function (group) {
		self.groups[group.groupId] = group;
	};
	self.insertCompetitorDiscount = function (competitor) {
		var key = self.keyOfCompetitor(competitor);
		if (false === (key in self.typeCompetitorDiscounts)) {
			self.typeCompetitorDiscounts[key] = [];
		}
		self.typeCompetitorDiscounts[key][competitor.competitor_id] = competitor;
	};

	self.calculate = function () {
		$.each(self.competitorDiscounsCurrent(), function (i, competitor) {
			var group = self.groups[competitor.group_id];
			group.countryCompetitor = competitor.country;
			group.discountOur = competitor.value;
			group.calculate();
		});
	};

	self.competitorDiscounsCurrent = function () {
		var array = [];
		$.each(self.types, function (i, type) {
			if (typeof type !== 'undefined') {
				var key = self.keyCompetitorFromType(type);
				var cds = self.typeCompetitorDiscounts[key];
				$.each(cds, function (i, cd) {
					array[array.length] = cd;
				});
			}
		});

		return array;
	};

};

var DiscountGroupModel = function () {
	var self = this;
	self.owner = null;
	self.groupId;
	self.nameGroup;
	self.countryCompetitor;
	self.discountOur;
	self.discountGivenByCompetitor;
	self.discountWeWantAddToGivenCompetitor;
	self.discountRequired;
	self.discountForApproval;
	self.discountTotalWithExtra;

	self.discountGroupWithSchemeGroup = function (sdg) {
		var dg = new DiscountGroupModel;
		dg.groupId = sdg.groupId;
		dg.nameGroup = sdg.nameGroup;
		dg.countryCompetitor = sdg.countryCompetitor;
		dg.discountOur = sdg.discountOur;
		dg.discountGivenByCompetitor = sdg.discountGivenByCompetitor;
		dg.discountWeWantAddToGivenCompetitor = sdg.discountWeWantAddToGivenCompetitor;
		dg.discountRequired = sdg.discountRequired;
		dg.discountForApproval = sdg.discountForApproval;
		dg.discountTotalWithExtra = sdg.discountTotalWithExtra;
		dg.fields = sdg;
		return dg;
	};

	self.calculate = function () {
		console.log('self.owner', self.owner);
		self.discountRequired = calculateRequared();
		self.discountTotalWithExtra = calculateTotalWithExtra();
	};



	function calculateRequared() {
		var part1 = 1 - self.discountOur / 100;
		var part2 = 1 - self.discountGivenByCompetitor / 100;
		var part3 = 1 - self.discountWeWantAddToGivenCompetitor / 100;
		var result = 100 * (1 - part1 * part2 * part3);
		return result.toFixed(2);
	}

	function calculateTotalWithExtra() {
		var part1 = 1 - self.discountForApproval / 100;
		var part2 = 1 - self.owner.extra / 100;
		var result = 100 * (1 - part1 * part2);
		return result.toFixed(2);
	}
};


var CompetitorDiscountModel = function () {
	var self = this;
	self.competitor_discount_id;
	self.competitor_id;
	self.group_id;
	self.value;
	self.country;
	self.name;
	self.equip_type_id;

	self.competitorDiscountWithSchemeCompetitor = function (scd) {
		var cd = new CompetitorDiscountModel();
		cd.competitor_discount_id = scd.competitor_discount_id;
		cd.competitor_id = scd.competitor_id;
		cd.group_id = scd.group_id;
		cd.value = scd.value;
		cd.country = scd.country;
		cd.name = scd.name;
		cd.equip_type_id = scd.equip_type_id;
		return cd;
	};
};
var EquipmentTypeModel = function () {
	var self = this;
	self.equip_type_id;
	self.name;
	self.selected;
	self.competitors = [];

	self.equipmentTypeWithSchemeType = function (st) {
		var et = new EquipmentTypeModel();
		et.equip_type_id = st.equip_type_id;
		et.name = st.name;
		et.equip_type_id = st.equip_type_id;
		et.selected = st.selected;
		et.competitors = st.competitors;
		return et;
	};
};


