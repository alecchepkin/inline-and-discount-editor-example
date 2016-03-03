define(['Command'], function(Command) {
	var UpdateInlineCommand = function() {
		this.execute = function(context) {
			console.log();
			
		};
	};

	UpdateInlineCommand.prototype = new Command();
	UpdateInlineCommand.prototype.constructor = UpdateInlineCommand;
	return UpdateInlineCommand;
});