define(function() {
	var Command = function() {
		this.execute = function() {};
		this.undo = function() {};
	};

	return Command;
});