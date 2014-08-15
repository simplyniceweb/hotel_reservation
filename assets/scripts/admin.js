(function () {
	var conf = {
		delete_: '.delete',
	}

	var func = {
		delete_: function() {
			return this.delegate(conf.delete_, "click", function(){
				if (confirm("Are you sure you want to delete this?")) {
					
				}
			})
		}
	}

	$.extend(config.doc, simplynice_func);
	config.doc.delete_();

})(jQuery, window, document);