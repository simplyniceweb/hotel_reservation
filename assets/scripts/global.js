// JavaScript Document
(function () {
	$('.ppover').popover();
	var conf = {
		room_img_modal: '#imageModal',
		room_img_trigger: '.modal-room-img',
		btn_delete: '.btn-delete',
		notes_proof_trigger: 'a.notes-proof',
		notes_proof: '#notesProof',
		reservation_details_trigger: 'a.reservation-details',
		reservation_details: '#reservationDetails',
		transaction_status: '.transaction-status',
		last_selected: 0,
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
		},
		notes_proof: function() {
			return this.delegate(conf.notes_proof_trigger, "click", function() {
				$( conf.notes_proof + ' .modal-body' ).empty();
				var me = $(this),
				id = me.data('id'),
				notes = $('.notes-'+id).text(),
				proof = $('.proof-'+id).text(),
				dl_url = config.base_url+'assets/images/payment/'+proof;
				$('<p>'+notes+'</p>').appendTo( conf.notes_proof + ' .modal-body' );
				$('<a href="'+dl_url+'" class="btn btn-success btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a>').appendTo( conf.notes_proof + ' .modal-body' );
			})
		},
		reservation_details: function() {
			return this.delegate(conf.reservation_details_trigger, "click", function(){
				var id = $(this).data('id');
				$( conf.reservation_details + ' .modal-body').html( "<p>Loading...</p>" );
				$.get( config.base_url+"transactions/reservartion_details/"+id, function( data ) {
					$( conf.reservation_details + ' .modal-body').html( data );
				});
			})
		},
		transaction_status_default: function() {
			return this.delegate(conf.transaction_status, "click", function(){
				conf.last_selected = $(conf.transaction_status+" option:selected");
			})
		},
		transaction_toggle_status: function() {
			return this.delegate(conf.transaction_status, "change", function(){
				var me = $(this), status = me.val(), payment_id = me.data('id'), select_status = me.data('status');
				if(select_status == 'disabled') return false;
				if( confirm("Are you sure you want to change the status of this payment?")) {
					$.get( config.base_url+"transactions/transactionToggleStatus/"+status+"/"+payment_id, function( data ) {
						$('tr.row-'+payment_id).slideToggle();
					});
				} else {
					conf.last_selected.attr("selected", true);
				}
				conf.last_selected = 0;
			})
		}
	}

	$.extend(config.doc, func);
	config.doc.append_room_imgs();
	config.doc.global_delete();
	config.doc.notes_proof();
	config.doc.reservation_details();
	config.doc.transaction_status_default();
	config.doc.transaction_toggle_status();

})(jQuery, window, document);