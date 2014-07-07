// JavaScript Document
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=223633884496335&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function () {

	if($('#slider').length>0) {
		$('#slider').nivoSlider();
	}
	if($('.datepicker').length>0) {
		$('.datepicker').datepicker({format:'yyyy-mm-dd'});
	}

	var conf = {
		amenities_anchor: '.amenities-anchor'
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
		}
	}

	$.extend(config.doc, func);
	config.doc.amenities();

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