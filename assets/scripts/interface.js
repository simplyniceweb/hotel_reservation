// JavaScript Document
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=223633884496335&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function isNumber(evt, data) {
	if (data == 1) {
		var zip = $("#zip_postal").val();
		if ( zip.length > 3 ) {
			return false;
		}
	}

    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

(function () {

	if($('#slider').length>0) {
		$('#slider').nivoSlider();
	}

	if($('.datepicker').length>0) {
		$('.datepicker').datepicker({format:'yyyy-mm-dd'});
	}

	var conf = {
		amenities_anchor: '.amenities-anchor',
		book_room: '#bookRoom',
		book_room_trigger: 'a[data-target=#bookRoom]',
		book_info: '.book-info-',
		customer_info: '.customer_info',
		room_id: 0,
		check_status: '.res_code',
		res_code: '#res_code',
		status_wrapper: '.reservations-wrapper'
	}

	var func = {
		amenities: function() {
			return this.delegate(conf.amenities_anchor, "click", function(e){
				e.preventDefault();
				var obj = $(this), i = obj.children('i'), id = obj.data('id');
				if(i.hasClass('fa-plus-circle')) {
					i.removeClass('fa-plus-circle').addClass('fa-minus-circle');
				} else {
					i.removeClass('fa-minus-circle').addClass('fa-plus-circle');
				}
				$('.amenities-'+id).slideToggle();
			})
		},
		show_booking_form: function(){
			return this.delegate(conf.book_room_trigger, "click", function(){
				var me = $(this),
				id = me.data('id'),
				info = $(conf.book_info+id).data('info');

				$('input[name=room_id]').val(id);
				config.doc.options_(info);
				conf.room_id = id;
			})
		},
		options_:function(info) {
			$('.adult_drop, .child_drop').empty();
			var arr = info.split("-"), i = 0, adult = parseInt(arr[0])+1, child = parseInt(arr[1])+1;
			for(i=1;i<adult;i++) {
				$('.adult_drop').append('<option value='+i+'>'+i+'</option>');
			}
			for(i=0;i<child;i++) {
				$('.child_drop').append('<option value='+i+'>'+i+'</option>');
			}
		},
		book_1: function() {
			return this.delegate(conf.book_room+' .process', "click", function(e){
				e.preventDefault();
				$('.invalid-date').remove();
				$('.customer_info').before( '<div class="invalid-date"><i class="fa fa-spin fa-spinner"></i></div>' );
				var c_in = $("#check_in").val(), c_out = $("#check_out").val(), id = conf.room_id;
				$.get( config.base_url+"reservations/check_date?check_in="+c_in+"&check_out="+c_out+"&room_id="+id, function( data ) {
					$('.invalid-date').remove();
					if (data == 1) {
						if($(conf.customer_info).hasClass('hide')) {
							$(conf.customer_info).removeClass('hide');
						}
						$(conf.book_room).animate({ scrollTop: $(conf.customer_info).offset().top}, 'slow');
						return false;
					}
					$('.customer_info').before( data );
					$(conf.customer_info).addClass( 'hide' );
				});
			})
		},
		check_reservation: function () {
			return this.delegate(conf.check_status, "click", function() {
				var me = $(this), i = me.children('i.fa'), code = $(conf.res_code).val();
				i.addClass('fa-spin');
				$.get( config.base_url+"reservations/check_reservations?code="+code, function( data ) {
					if ( data == 1 ) {
						$(conf.status_wrapper).html( '<p class="text-danger">Invalid code.</p>' );
					} else {
						$(conf.status_wrapper).html( data );
					}
					i.removeClass('fa-spin');
				})
			})
		}
	}

	$.extend(config.doc, func);
	config.doc.amenities();
	config.doc.show_booking_form();
	config.doc.book_1();
	config.doc.check_reservation();

	var simplynice_conf = {
		wrapper: '.simplyniceGallery',
		controller: '.simplynice-control',
		modal: '#roomGallery',
		modal_trigger: 'a[data-target=#roomGallery]',
	}

	var simplynice_func = {
		modal_show: function() {
			return this.delegate(simplynice_conf.modal, "show.bs.modal", function(){
				$(simplynice_conf.controller+' .btn-p').hide();
				$(simplynice_conf.controller+' .btn-n').show();
			})
		},
		modal_activate: function() {
			return this.delegate(simplynice_conf.modal_trigger, "click", function(){
				var me = $(this), rid = me.data('id');
				var res = rid.split("-");
				$.get( config.base_url+"room_galleries?rid="+res[0], function( data ) {
					$( simplynice_conf.wrapper ).html( data );
					$(simplynice_conf.modal+ " .modal-title").text(res[1]+" Gallery");
					config.doc.images_control();
					if($(simplynice_conf.wrapper+' li').length < 2) {
						$(simplynice_conf.controller+' button:last-child').hide();
					}
				});
			})
		},
		images_control: function() {
			$(simplynice_conf.wrapper+' li:first-child').addClass('current').show();
		},
		next_control: function() {
			return this.delegate(simplynice_conf.controller+' button:last-child', "click", function(){
				var me = $(this), current = $(simplynice_conf.wrapper+' li.current');
				if(current.next('li').length > 0) {
					current.removeClass('current').hide();
					current.next('li').addClass('current').show();
					if(current.next('li').next('li').length < 1) {
						me.hide();
					}
					if(!$(simplynice_conf.controller+' button:first-child').is(':visible')) {
						$(simplynice_conf.controller+' button:first-child').show();
					}
				}
			})
		},
		prev_control: function() {
			return this.delegate(simplynice_conf.controller+' button:first-child', "click", function(){
				var me = $(this), current = $(simplynice_conf.wrapper+' li.current');
				if(current.prev('li').length > 0) {
					current.removeClass('current').hide();
					current.prev('li').addClass('current').show();
					if(current.prev('li').prev('li').length < 1) {
						me.hide();
					}
					if(!$(simplynice_conf.controller+' button:last-child').is(':visible')) {
						$(simplynice_conf.controller+' button:last-child').show();
					}
				}
			})
		}
	}

	$.extend(config.doc, simplynice_func);
	config.doc.modal_show();
	config.doc.modal_activate();
	config.doc.images_control();
	config.doc.next_control();
	config.doc.prev_control();

})(jQuery, window, document);