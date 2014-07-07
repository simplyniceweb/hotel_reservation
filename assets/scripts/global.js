// JavaScript Document
(function () {
	var conf = {
		room_img_modal: '#imageModal',
		room_img_trigger: '.modal-room-img',
		btn_delete: '.btn-delete',
	}

	var func = {
		append_room_imgs: function() {
			return this.delegate(conf.room_img_trigger, "click", function(){
				var me = $(this), append = $(conf.room_img_modal +" .modal-body"), rid = me.data('roomid');
				append.html(config.doc.global_msg(1));
				$.get( config.base_url+"roomimage/room_images?rid="+rid, function( data ) {
					append.html( data );
				});
			})
		},
		global_msg: function(val) {
			var msg;
			switch(val) {
				case 1:
					msg = "<p><i class='fa fa-spin fa-spinner'></i> Loading room images...</p>";
					break;
				default:
					break;
			}
			return msg;
		},
		global_delete: function() {
			return this.delegate(conf.btn_delete, "click", function(e){
				e.preventDefault();
				e.stopPropagation();
				var me = $(this), loc = me.attr('href');
				if(confirm("Are you sure you want to delete this?")) {
					location.href = loc;
				}
				return false;
			})
		}
	}

	$.extend(config.doc, func);
	config.doc.append_room_imgs();
	config.doc.global_delete();

})(jQuery, window, document);