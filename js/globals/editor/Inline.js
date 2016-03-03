define(function () {
	var Inline = function (context, opts) {

		function bindAttributes() {
			$(context).find('a.linkedit').click(hCLink);
			$(context).find('span.method').focusout(hFOText);

		}

		function init() {
			console.log(context);
			bindAttributes();
		}

		function hCLink(e) {
			var method = $(this).parent().find('.method');
			$(method).show();
			console.log("method", $(method));
			console.log("method", method);
			$(method).find('input:first').focus();
			if($(method).find('select:first')){
				$(method).find('select:first').focus();
			}
			$(this).hide();
			e.preventDefault();
		}
		
		function hFOText() {
			$(this).siblings('a').show();
			$(this).hide();
		}

		var options,
				self = this;

		opts = typeof (opts) === 'undefined' ? {} : opts;
		self.options = $.extend({
			url: '/some/url'
		}, opts);

		init();

	};

	return Inline;
});