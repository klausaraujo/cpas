/** *************Init JS*********************
	
		TABLE OF CONTENTS
	---------------------------
	1.Ready function
	2.Load function
	3.Full height function
	4.splasher function
	5.Chat App function
	6.Resize function
 ** ***************************************/

"use strict";
/*****Ready function start*****/
$(document).ready(function () {
	splasher();
	$('.preloader-it > .la-anim-1').addClass('la-animate');
});
/*****Ready function end*****/

/*****Load function start*****/
$(window).on("load", function () {
	$(".preloader-it").delay(500).fadeOut("slow");
	/*Progress Bar Animation*/
	var progressAnim = $('.progress-anim');
	if (progressAnim.length > 0) {
		for (var i = 0; i < progressAnim.length; i++) {
			var $this = $(progressAnim[i]);
			$this.waypoint(function () {
				var progressBar = $(".progress-anim .progress-bar");
				for (var i = 0; i < progressBar.length; i++) {
					$this = $(progressBar[i]);
					$this.css("width", $this.attr("aria-valuenow") + "%");
				}
			}, {
				triggerOnce: true,
				offset: 'bottom-in-view'
			});
		}
	}
});
/*****Load function* end*****/

/***** Full height function start *****/
var setHeightWidth = function () {
	var height, width, clickAllowed;

	height = $(window).height();
	width = $(window).width();

	// flag to allow clicking
	clickAllowed = true;

	$('.full-height').css('height', (height));
	$('.page-wrapper').css('min-height', (height));

	/*Right Sidebar Scroll Start*/
	if (width <= 1007) {
		$('#chat_list_scroll').css('height', (height - 267));
		$('.fixed-sidebar-right .chat-content').css('height', (height - 280));
		$('.fixed-sidebar-right .set-height-wrap').css('height', (height - 220));
		clickAllowed = true;
	}
	else {
		$('#chat_list_scroll').css('height', (height - 221));
		$('.fixed-sidebar-right .chat-content').css('height', (height - 230));
		$('.fixed-sidebar-right .set-height-wrap').css('height', (height - 170));
		clickAllowed = false;
	}
	/*Right Sidebar Scroll End*/

	/*Vertical Tab Height Cal Start*/
	var verticalTab = $(".vertical-tab");
	if (verticalTab.length > 0) {
		for (var i = 0; i < verticalTab.length; i++) {
			var $this = $(verticalTab[i]);
			$this.find('ul.nav').css(
				'min-height', ''
			);
			$this.find('.tab-content').css(
				'min-height', ''
			);
			height = $this.find('ul.ver-nav-tab').height();
			$this.find('ul.nav').css(
				'min-height', height + 40
			);
			$this.find('.tab-content').css(
				'min-height', height + 40
			);
		}
	}
	/*Vertical Tab Height Cal End*/
};
/***** Full height function end *****/

/***** splasher function start *****/
var $wrapper = $(".wrapper");
var splasher = function () {

	/*Counter Animation*/
	var counterAnim = $('.counter-anim');
	if (counterAnim.length > 0) {
		counterAnim.counterUp({
			delay: 10,
			time: 1000
		});
	}

	/*Tooltip*/
	if ($('[data-toggle="tooltip"]').length > 0)
		$('[data-toggle="tooltip"]').tooltip();

	/*Popover*/
	if ($('[data-toggle="popover"]').length > 0)
		$('[data-toggle="popover"]').popover()


	/*Sidebar Collapse Animation*/
	var sidebarNavCollapse = $('.fixed-sidebar-left .side-nav  li .collapse');
	var sidebarNavAnchor = '.fixed-sidebar-left .side-nav  li a';
	$(document).on("click", sidebarNavAnchor, function (e) {
		if ($(this).attr('aria-expanded') === "false")
			$(this).blur();
		$(sidebarNavCollapse).not($(this).parent().parent()).collapse('hide');
	});

	/*Panel Remove*/
	$(document).on('click', '.close-panel', function (e) {
		var effect = $(this).data('effect');
		$(this).closest('.panel')[effect]();
		return false;
	});

	/*Accordion js*/
	$(document).on('show.bs.collapse', '.panel-collapse', function (e) {
		$(this).siblings('.panel-heading').addClass('activestate');
	});

	$(document).on('hide.bs.collapse', '.panel-collapse', function (e) {
		$(this).siblings('.panel-heading').removeClass('activestate');
	});

	/*Sidebar Navigation*/
	$(document).on('click', '#toggle_nav_btn,#open_right_sidebar,#setting_panel_btn', function (e) {
		$(".dropdown.open > .dropdown-toggle").dropdown("toggle");
		return false;
	});
	$(document).on('click', '#toggle_nav_btn', function (e) {
		$wrapper.removeClass('open-right-sidebar open-setting-panel').toggleClass('slide-nav-toggle');
		return false;
	});

	$(document).on('click', '#open_right_sidebar', function (e) {
		$wrapper.toggleClass('open-right-sidebar').removeClass('open-setting-panel');
		return false;

	});

	$(document).on('click', '.product-carousel .owl-nav', function (e) {
		return false;
	});

	$(document).on('click', 'body', function (e) {
		if ($(e.target).closest('.fixed-sidebar-right,.setting-panel').length > 0) {
			return;
		}
		$('body > .wrapper').removeClass('open-right-sidebar open-setting-panel');
		return;
	});

	$(document).on('show.bs.dropdown', '.nav.navbar-right.top-nav .dropdown', function (e) {
		$wrapper.removeClass('open-right-sidebar open-setting-panel');
		return;
	});

	$(document).on('click', '#setting_panel_btn', function (e) {
		$wrapper.toggleClass('open-setting-panel').removeClass('open-right-sidebar');
		return false;
	});
	$(document).on('click', '#toggle_mobile_nav', function (e) {
		$wrapper.toggleClass('mobile-nav-open').removeClass('open-right-sidebar');
		return;
	});


	$(document).on("mouseenter mouseleave", ".wrapper > .fixed-sidebar-left", function (e) {
		if (e.type == "mouseenter") {
			$wrapper.addClass("sidebar-hover");
		}
		else {
			$wrapper.removeClass("sidebar-hover");
		}
		return false;
	});

	$(document).on("mouseenter mouseleave", ".wrapper > .setting-panel", function (e) {
		if (e.type == "mouseenter") {
			$wrapper.addClass("no-transition");
		}
		else {
			$wrapper.removeClass("no-transition");
		}
		return false;
	});

	/*Todo*/
	var random = Math.random();
	$(document).on("keypress", "#add_todo", function (e) {
		if ((e.which == 13) && (!$(this).val().length == 0)) {
			$('<li class="todo-item"><div class="checkbox checkbox-success"><input type="checkbox" id="checkbox' + random + '"/><label for="checkbox' + random + '">' + $('.new-todo input').val() + '</label></div></li><li><hr class="light-grey-hr"/></li>').insertAfter(".todo-list li:last-child");
			$('.new-todo input').val('');
		} else if (e.which == 13) {
			alert('Please type somthing!');
		}
		return;
	});

	/*Chat*/
	$(document).on("keypress", "#input_msg_send", function (e) {
		if ((e.which == 13) && (!$(this).val().length == 0)) {
			$('<li class="self mb-10"><div class="self-msg-wrap"><div class="msg block pull-right">' + $(this).val() + '<div class="msg-per-detail mt-5"><span class="msg-time txt-grey">3:30 pm</span></div></div></div><div class="clearfix"></div></li>').insertAfter(".fixed-sidebar-right .chat-content  ul li:last-child");
			$(this).val('');
		} else if (e.which == 13) {
			alert('Please type somthing!');
		}
		return;
	});
	$(document).on("keypress", "#input_msg_send_widget", function (e) {
		if ((e.which == 13) && (!$(this).val().length == 0)) {
			$('<li class="self mb-10"><div class="self-msg-wrap"><div class="msg block pull-right">' + $(this).val() + '<div class="msg-per-detail mt-5"><span class="msg-time txt-grey">3:30 pm</span></div></div></div><div class="clearfix"></div></li>').insertAfter(".chat-for-widgets .chat-content  ul li:last-child");
			$(this).val('');
		} else if (e.which == 13) {
			alert('Please type somthing!');
		}
		return;
	});
	$(document).on("keypress", "#input_msg_send_chatapp", function (e) {
		if ((e.which == 13) && (!$(this).val().length == 0)) {
			$('<li class="self mb-10"><div class="self-msg-wrap"><div class="msg block pull-right">' + $(this).val() + '<div class="msg-per-detail mt-5"><span class="msg-time txt-grey">3:30 pm</span></div></div></div><div class="clearfix"></div></li>').insertAfter(".chat-for-widgets-1 .chat-content  ul li:last-child");
			$(this).val('');
		} else if (e.which == 13) {
			alert('Please type asomthing!');
		}
		return;
	});

	$(document).on("click", ".fixed-sidebar-right .chat-cmplt-wrap .chat-data", function (e) {
		$(".fixed-sidebar-right .chat-cmplt-wrap").addClass('chat-box-slide');
		return false;
	});
	$(document).on("click", ".fixed-sidebar-right #goto_back", function (e) {
		$(".fixed-sidebar-right .chat-cmplt-wrap").removeClass('chat-box-slide');
		return false;
	});

	/*Chat for Widgets*/
	$(document).on("click", ".chat-for-widgets.chat-cmplt-wrap .chat-data", function (e) {
		$(".chat-for-widgets.chat-cmplt-wrap").addClass('chat-box-slide');
		return false;
	});
	$(document).on("click", "#goto_back_widget", function (e) {
		$(".chat-for-widgets.chat-cmplt-wrap").removeClass('chat-box-slide');
		return false;
	});
	/*Horizontal Nav*/
	$(document).on("show.bs.collapse", ".horizontal-nav .fixed-sidebar-left .side-nav > li > ul", function (e) {

	});

	/*Slimscroll*/
	/*$('.nicescroll-bar').slimscroll({height:'100%',color: '#878787', disableFadeOut : true,borderRadius:0,size:'4px',alwaysVisible:false});*/
	$('.message-nicescroll-bar').slimscroll({ height: '229px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.message-box-nicescroll-bar').slimscroll({ height: '350px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.product-nicescroll-bar').slimscroll({ height: '346px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.app-nicescroll-bar').slimscroll({ height: '162px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.todo-box-nicescroll-bar').slimscroll({ height: '365px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.users-nicescroll-bar').slimscroll({ height: '370px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.users-chat-nicescroll-bar').slimscroll({ height: '257px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.chatapp-nicescroll-bar').slimscroll({ height: '543px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });
	$('.chatapp-chat-nicescroll-bar').slimscroll({ height: '483px', size: '4px', color: '#878787', disableFadeOut: true, borderRadius: 0 });

	/*Product carousel*/
	if ($('.product-carousel').length > 0)
		var $owl = $('.product-carousel').owlCarousel({
			loop: true,
			margin: 15,
			nav: true,
			navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
			dots: false,
			autoplay: true,
			responsive: {
				0: {
					items: 1
				},
				400: {
					items: 2
				},
				767: {
					items: 3
				},
				1399: {
					items: 4
				}
			}
		});

	/*Refresh Init Js*/
	var refreshMe = '.refresh';
	$(document).on("click", refreshMe, function (e) {
		var panelToRefresh = $(this).closest('.panel').find('.refresh-container');
		var dataToRefresh = $(this).closest('.panel').find('.panel-wrapper');
		var loadingAnim = panelToRefresh.find('.la-anim-1');
		panelToRefresh.show();
		setTimeout(function () {
			loadingAnim.addClass('la-animate');
		}, 100);
		function started() { } //function before timeout
		setTimeout(function () {
			function completed() { } //function after timeout
			panelToRefresh.fadeOut(800);
			setTimeout(function () {
				loadingAnim.removeClass('la-animate');
			}, 800);
		}, 1500);
		return false;
	});

	/*Fullscreen Init Js*/
	$(document).on("click", ".full-screen", function (e) {
		$(this).parents('.panel').toggleClass('fullscreen');
		$(window).trigger('resize');
		return false;
	});

	/*Nav Tab Responsive Js*/
	$(document).on('show.bs.tab', '.nav-tabs-responsive [data-toggle="tab"]', function (e) {
		var $target = $(e.target);
		var $tabs = $target.closest('.nav-tabs-responsive');
		var $current = $target.closest('li');
		var $parent = $current.closest('li.dropdown');
		$current = $parent.length > 0 ? $parent : $current;
		var $next = $current.next();
		var $prev = $current.prev();
		$tabs.find('>li').removeClass('next prev');
		$prev.addClass('prev');
		$next.addClass('next');
		return;
	});
};
/***** splasher function end *****/

/***** Chat App function Start *****/
var chatAppTarget = $('.chat-for-widgets-1.chat-cmplt-wrap');
var chatApp = function () {
	$(document).on("click", ".chat-for-widgets-1.chat-cmplt-wrap .chat-data", function (e) {
		var width = $(window).width();
		if (width <= 1007) {
			chatAppTarget.addClass('chat-box-slide');
		}
		return false;
	});
	$(document).on("click", "#goto_back_widget_1", function (e) {
		var width = $(window).width();
		if (width <= 1007) {
			chatAppTarget.removeClass('chat-box-slide');
		}
		return false;
	});
};
/***** Chat App function End *****/

var boxLayout = function () {
	if ((!$wrapper.hasClass("rtl-layout")) && ($wrapper.hasClass("box-layout")))
		$(".box-layout .fixed-sidebar-right").css({ right: $wrapper.offset().left + 300 });
	else if ($wrapper.hasClass("box-layout rtl-layout"))
		$(".box-layout .fixed-sidebar-right").css({ left: $wrapper.offset().left });
}
boxLayout();

/**Only For Setting Panel Start**/

/*Fixed Slidebar*/
var fixedHeader = function () {
	if ($(".setting-panel #switch_3").is(":checked")) {
		$wrapper.addClass("scrollable-nav");
	} else {
		$wrapper.removeClass("scrollable-nav");
	}
};
fixedHeader();
$(document).on('change', '.setting-panel #switch_3', function () {
	fixedHeader();
	return false;
});

/*Theme Color Init*/
$(document).on('click', '.theme-option-wrap > li', function (e) {
	$(this).addClass('active-theme').siblings().removeClass('active-theme');
	$wrapper.removeClass(function (index, className) {
		return (className.match(/(^|\s)theme-\S+/g) || []).join(' ');
	}).addClass($(this).attr('id') + '-active');
	return false;
});

/*Topbar Color Init*/
var topColor = 'input:radio[name="radio-topbar-color"]';
if ($('input:radio[name="radio-topbar-color"]').length > 0) {
	$(document).on('click', topColor, function (e) {
		$wrapper.removeClass(function (index, className) {
			return (className.match(/(^|\s)navbar-top-\S+/g) || []).join(' ');
		}).addClass($(this).attr('id'));
		return;
	});
}

/*Reset Init*/
$(document).on('click', '#reset_setting', function (e) {
	$('.theme-option-wrap > li').removeClass('active-theme').first().addClass('active-theme');
	$wrapper.removeClass(function (index, className) {
		return (className.match(/(^|\s)theme-\S+/g) || []).join(' ');
	}).addClass('theme-2-active');
	if ($(".setting-panel #switch_3").is(":checked"))
		$('.setting-panel .layout-switcher .switchery').trigger('click');
	$('#navbar-top-light').trigger('click');
	return false;
});


/*Switchery Init*/
var elems = Array.prototype.slice.call(document.querySelectorAll('.setting-panel .js-switch'));
$('.setting-panel .js-switch').each(function () {
	new Switchery($(this)[0], $(this).data());
});

/*Only For Setting Panel end*/

/***** Resize function start *****/
$(window).on("resize", function () {
	setHeightWidth();
	boxLayout();
	chatApp();
}).resize();
/***** Resize function end *****/

$(document).ready(function () {
	$("#btn-oferta-movil,.oferta-movil-aside").on('click', function () {
		var Evento_Registro_Numero = $(this).find("label").attr("rel");
		console.log("btn-oferta-movil", Evento_Registro_Numero);
		$("#ofertaMovilModal").modal("show");
		$("#ofertaMovilModal").find("#Evento_Registro_Numero").val(Evento_Registro_Numero);

		$.ajax({
			type: "POST",
			url: URI + "eventos/eventos/EventoTipoEntidadAtencionOfertaMovilLista",
			data: { Evento_Registro_Numero: Evento_Registro_Numero },
			dataType: "json",
			beforeSend: function () {
				$("#tableOfertaMovil tbody").html("<tr><td>Cargando...</td></tr>");
			},
			success: function (data) {

				var html = "";
				var count = 0;

				$.each(data.lista, function (i, e) {
					count++;
					html += '<tr><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre + '</td><td class="text-center">' + e.Evento_Tipo_Entidad_Atencion_Nombre + '</td><td class="delete" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
				});

				if (count == 0) html = "<tr class='sin-registros'><td colspan='3' class='text-center'>No hay registros</td></tr>";

				$("#tableOfertaMovil tbody").html(html);
			}
		});

	});

	$("#formRegistrarOfertaMovil").validate({
		rules: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: true },
			Evento_Tipo_Entidad_Atencion_ID: { required: true }
		},
		messages: {
			Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre: { required: "(*) Campo Requerido" },
			Evento_Tipo_Entidad_Atencion_ID: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/EventoTipoEntidadAtencionOfertaMovilRegistrar",
				data: $("#formRegistrarOfertaMovil").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregando...");
					$("#formRegistrarOfertaMovil button").addClass("disabled");
				},
				success: function (data) {

					$("#formRegistrarOfertaMovil button[type=submit]").text("Agregar");
					$("#formRegistrarOfertaMovil button").removeClass("disabled");

					var html = "";
					var count = 0;

					var sinRegistros = ($("#tableOfertaMovil tbody tr.sin-registros")) ? $("#tableOfertaMovil tbody tr.sin-registros").length : 0;

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableOfertaMovil tbody").html();
								html += '<tr><td class="text-center">' + $("#formRegistrarOfertaMovil").find("input[name=Evento_Tipo_Entidad_Atencion_Oferta_Movil_Nombre]").val() + '</td>';
								html += '<td class="text-center">' + $("#formRegistrarOfertaMovil").find("select option:selected").text() + '</td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formRegistrarOfertaMovil")[0].reset();

						}

						$("#tableOfertaMovil tbody").html(html);

					}
					else {
						$("#duplicate_movil").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_movil").addClass("hide");
						}, 2000);
					}

				}
			});
		}
	});

	$("html").on("click", "#formRegistrarOfertaMovil table tr td.delete", function () {

		var id = $(this).attr("rel");
		$("#deleteOfertaMovilModal").modal("show");
		$("#deleteOfertaMovilModal").find("input[name=id]").val(id);

	});

	$("#deleteOfertaMovilForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eventoTipoEntidadAtencionOfertaMovilEliminar",
				data: $("#deleteOfertaMovilForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#deleteOfertaMovilForm button[type=submit]").text("Eliminando...");
					$("#deleteOfertaMovilForm button").addClass("disabled");
				},
				success: function (data) {
					$("#deleteOfertaMovilForm button").removeClass("disabled");
					$("#deleteOfertaMovilForm button[type=submit]").text("Eliminar");
					location.reload();
				}
			});
		}

	});
	/**********EVENTO ASOCIADO**************/

	$("#btn-eventos-asociados").on('click', function () {
		//var Evento_Registro_Numero = $(this).find("label").attr("rel");
		//console.log("btn-eventos-asociados", Evento_Registro_Numero);
		$("#eventosAsociadosModal").modal("show");
		//$("#eventosAsociadosModal").find("#Evento_Registro_Numero").val(Evento_Registro_Numero);

		$.ajax({
			type: "POST",
			url: URI + "eventos/eventos/EventosAsociadosLista",
			//data:{Evento_Registro_Numero:Evento_Registro_Numero},
			dataType: "json",
			beforeSend: function () {
				$("#tableEventoAsociado tbody").html("<tr><td>Cargando...</td></tr>");
			},
			success: function (data) {

				var html = "";
				var count = 0;

				$.each(data.listaeasociado, function (i, e) {
					count++;
					html += '<tr><td class="text-center">' + e.evento_asociado_descripcion + '</td><td class="text-center">' + e.estado1 + '</td>';
					html += '<td class="activar" rel="' + e.evento_asociado_id + '"><span aria-hidden="true"><i class="fa fa-check-circle" aria-hidden="true"></i></span></td><td class="desactivar" rel="' + e.evento_asociado_id + '"><span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span></td><td class="delete" rel="' + e.evento_asociado_id + '"><span aria-hidden="true"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';
				});

				if (count == 0) html = "<tr class='sin-registros'><td colspan='3' class='text-center'>No hay registros</td></tr>";

				$("#tableEventoAsociado tbody").html(html);
			}
		});

	});

	$("#formRegistrarEventosAsociados").validate({
		rules: {
			Evento_Asociado_Descripcion: { required: true }
		},
		messages: {
			Evento_Asociado_Descripcion: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/EventoAsociadoRegistrar",
				data: $("#formRegistrarEventosAsociados").serialize(),
				dataType: "json",
				beforeSend: function () {
					console.log("estamos en el before");
					$("#formRegistrarEventosAsociados button[type=submit]").text("Agregando...");
					$("#formRegistrarEventosAsociados button").addClass("disabled");
				},
				success: function (data) {
					console.log("estamos en el success");
					$("#formRegistrarEventosAsociados button[type=submit]").text("Agregar");
					$("#formRegistrarEventosAsociados button").removeClass("disabled");

					var html = "";
					var count = 0;

					var sinRegistros = ($("#tableEventoAsociado tbody tr.sin-registros")) ? $("#tableEventoAsociado tbody tr.sin-registros").length : 0;

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formRegistrarEventosAsociados").find("input[name=Evento_Asociado_Descripcion]").val() + '</td><td class="text-center">Activo</td>';
								html += '<td class="activar" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-check-circle" aria-hidden="true"></i></span></td><td class="desactivar" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span></td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableEventoAsociado tbody").html();
								html += '<tr><td class="text-center">' + $("#formRegistrarEventosAsociados").find("input[name=Evento_Asociado_Descripcion]").val() + '</td><td class="text-center">Activo</td>';
								html += '<td class="activar" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-check-circle" aria-hidden="true"></i></span></td><td class="desactivar" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times-circle" aria-hidden="true"></i></span></td><td class="delete" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-trash" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formRegistrarEventosAsociados")[0].reset();

						}

						$("#tableEventoAsociado tbody").html(html);

					}
					else {
						$("#duplicate_movil").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_movil").addClass("hide");
						}, 2000);
					}

				}
			});
		}
	});

	$("html").on("click", "#formRegistrarEventosAsociados table tr td.delete", function () {

		var id = $(this).attr("rel");
		console.log(id);
		$("#deleteEventoAsociadoModal").modal("show");
		$("#deleteEventoAsociadoModal").find("input[name=id]").val(id);

	});

	$("html").on("click", "#formRegistrarEventosAsociados table tr td.activar", function () {

		var id = $(this).attr("rel");
		console.log(id);
		$("#activarEventoAsociadoModal").modal("show");
		$("#activarEventoAsociadoModal").find("input[name=id]").val(id);

	});

	$("html").on("click", "#formRegistrarEventosAsociados table tr td.desactivar", function () {

		var id = $(this).attr("rel");
		console.log(id);
		$("#desactivarEventoAsociadoModal").modal("show");
		$("#desactivarEventoAsociadoModal").find("input[name=id]").val(id);

	});
	$("#deleteEventoAsociadoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eventoAsociadoEliminar",
				data: $("#deleteEventoAsociadoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#deleteEventoAsociadoForm button[type=submit]").text("Eliminando...");
					$("#deleteEventoAsociadoForm button").addClass("disabled");
				},
				success: function (data) {
					$("#deleteEventoAsociadoForm button").removeClass("disabled");
					$("#deleteEventoAsociadoForm button[type=submit]").text("Eliminar");
					location.reload();
				}
			});
		}

	});

	$("#activarEventoAsociadoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eventoAsociadoActivar",
				data: $("#activarEventoAsociadoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#activarEventoAsociadoForm button[type=submit]").text("Activando...");
					$("#activarEventoAsociadoForm button").addClass("disabled");
				},
				success: function (data) {
					$("#activarEventoAsociadoForm button").removeClass("disabled");
					$("#activarEventoAsociadoForm button[type=submit]").text("Activar");
					location.reload();
				}
			});
		}

	});

	$("#desactivarEventoAsociadoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eventoAsociadoDesactivar",
				data: $("#desactivarEventoAsociadoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#desactivarEventoAsociadoForm button[type=submit]").text("Desactivando...");
					$("#desactivarEventoAsociadoForm button").addClass("disabled");
				},
				success: function (data) {
					$("#desactivarEventoAsociadoForm button").removeClass("disabled");
					$("#desactivarEventoAsociadoForm button[type=submit]").text("Desactivar");
					location.reload();
				}
			});
		}

	});
	/**********EVENTO ASOCIADO**************/

});

/**********ASIGNACION**********/

function cargarAddAsignacion(Evento_Registro_Numero) {

	$("#asignacionModal").modal("show");
	$.ajax({
		type: "POST",
		url: URI + "eventos/eventos/listarAsignaciones",
		data: { id: Evento_Registro_Numero },
		dataType: "json",
		beforeSend: function () {
			$("#modalCargaGeneral").css("display", "block");
		},
		success: function (data) {
			$("#modalCargaGeneral").css("display", "none");
			$("#asignacionModal").modal("show");

			$("#formMedicamentos").find("input[name=id]").val(Evento_Registro_Numero);
			$("#formEquipos").find("input[name=id]").val(Evento_Registro_Numero);
			$("#formRecursos").find("input[name=id]").val(Evento_Registro_Numero);


			var html = "";
			var count = 0;

			html = "";
			count = 0;

			$.each(data.eventoMedicamentos, function (i, e) {
				count++;
				html += '<tr><td class="text-center">' + e.articulo + '</td><td class="text-center">' + e.presentacion + '</td><td class="text-center">' + e.cantidad + '</td>';
				html += '<td class="delete-medicamento" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
			});
			if (count == 0) html = "<tr class='sin-registros'><td colspan='4' class='text-center'>No hay registros</td></tr>";
			$("#tableMedicamentos tbody").html(html);

			html = "";
			count = 0;

			$.each(data.eventoEquipos, function (i, e) {
				count++;
				html += '<tr><td class="text-center">' + e.descripcion + '</td><td class="text-center">' + e.fuente + '</td><td class="text-center">' + e.cantidad + '</td>';
				html += '<td class="delete-equipo" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
			});
			if (count == 0) html = "<tr class='sin-registros'><td colspan='4' class='text-center'>No hay registros</td></tr>";
			$("#tableEquipos tbody").html(html);

			html = "";
			count = 0;

			$.each(data.eventoRecursos, function (i, e) {
				count++;
				html += '<tr><td class="text-center">' + e.profesion + '</td><td class="text-center">' + e.especialidad + '</td><td class="text-center">' + e.cantidad + '</td>';
				html += '<td class="delete-recurso" rel="' + e.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
			});
			if (count == 0) html = "<tr class='sin-registros'><td colspan='4' class='text-center'>No hay registros</td></tr>";
			$("#tableRecursos tbody").html(html);
		}
	});

}

$(document).ready(function () {

	$("#formMedicamentos").validate({
		rules: {
			evento_medicamentos_articulo: { required: true },
			evento_medicamentos_presentacion_id: { required: true },
			evento_medicamentos_cantidad: { required: true, min: 0, digits: true },
			evento_medicamentos_prioridad: { required: true }
		},
		messages: {
			evento_medicamentos_articulo: { required: "(*) Campo Requerido" },
			evento_medicamentos_presentacion_id: { required: "(*) Campo Requerido" },
			evento_medicamentos_cantidad: { required: "(*) Campo Requerido", min: 'no menor de 0', digits: 'solo n\xf9meros' },
			evento_medicamentos_prioridad: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/registrarMedicamento",
				data: $("#formMedicamentos").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formMedicamentos button[type=submit]").text("Agregando...");
					$("#formMedicamentos button").addClass("disabled");
				},
				success: function (data) {

					$("#formMedicamentos button[type=submit]").text("Agregar");
					$("#formMedicamentos button").removeClass("disabled");

					var html = "";
					var count = 0;

					var sinRegistros = $("#tableMedicamentos tbody tr.sin-registros").length;
					var id = $("#formMedicamentos").find("input[name=id]").val();
					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formMedicamentos").find("input[name=evento_medicamentos_articulo]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formMedicamentos").find("select[name=evento_medicamentos_presentacion_id] option:selected").text().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formMedicamentos").find("input[name=evento_medicamentos_cantidad]").val() + '</td>';
								html += '<td class="delete-medicamento" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableMedicamentos tbody").html();
								html += '<tr><td class="text-center">' + $("#formMedicamentos").find("input[name=evento_medicamentos_articulo]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formMedicamentos").find("select[name=evento_medicamentos_presentacion_id] option:selected").text().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formMedicamentos").find("input[name=evento_medicamentos_cantidad]").val() + '</td>';
								html += '<td class="delete-medicamento" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formMedicamentos")[0].reset();
							$("#formMedicamentos").find("input[name=id]").val(id);

						}

						$("#tableMedicamentos tbody").html(html);

					}
					else if (parseInt(data.status) == 201) {
						$("#duplicate_medicamento").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_medicamento").addClass("hide");
						}, 2000);
					}
					else {
						alert("Error al registrar");
					}

				}
			});
		}
	});

	$("#formEquipos").validate({
		rules: {
			evento_equipos_descripcion: { required: true },
			evento_equipos_fuente: { required: true },
			evento_equipos_cantidad: { required: true, min: 0, digits: true },
			evento_equipos_prioridad: { required: true }
		},
		messages: {
			evento_equipos_descripcion: { required: "(*) Campo Requerido" },
			evento_equipos_fuente: { required: "(*) Campo Requerido" },
			evento_equipos_cantidad: { required: "(*) Campo Requerido", min: 'no menor de 0', digits: 'solo n\xf9meros' },
			evento_equipos_prioridad: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/registrarEquipo",
				data: $("#formEquipos").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formEquipos button[type=submit]").text("Agregando...");
					$("#formEquipos button").addClass("disabled");
				},
				success: function (data) {

					$("#formEquipos button[type=submit]").text("Agregar");
					$("#formEquipos button").removeClass("disabled");

					var html = "";
					var count = 0;

					var sinRegistros = $("#tableEquipos tbody tr.sin-registros").length;
					var id = $("#formEquipos").find("input[name=id]").val();

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_descripcion]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_fuente]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_cantidad]").val() + '</td>';
								html += '<td class="delete-equipo" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableEquipos tbody").html();
								html += '<tr><td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_descripcion]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_fuente]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formEquipos").find("input[name=evento_equipos_cantidad]").val() + '</td>';
								html += '<td class="delete-equipo" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formEquipos")[0].reset();
							$("#formEquipos").find("input[name=id]").val(id);
						}

						$("#tableEquipos tbody").html(html);

					}
					else if (parseInt(data.status) == 201) {
						$("#duplicate_equipo").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_equipo").addClass("hide");
						}, 2000);
					}
					else {
						alert("Error al registrar");
					}

				}
			});
		}
	});

	$("#formRecursos").validate({
		rules: {
			evento_recursos_humanos_profesion: { required: true },
			evento_recursos_humanos_especialidad: { required: true },
			evento_recursos_humanos_cantidad: { required: true, min: 0, digits: true },
			evento_recursos_humanos_prioridad: { required: true }
		},
		messages: {
			evento_recursos_humanos_profesion: { required: "(*) Campo Requerido" },
			evento_recursos_humanos_especialidad: { required: "(*) Campo Requerido" },
			evento_recursos_humanos_cantidad: { required: "(*) Campo Requerido", min: 'no menor de 0', digits: 'solo n\xf9meros' },
			evento_recursos_humanos_prioridad: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/registrarRecurso",
				data: $("#formRecursos").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#formRecursos button[type=submit]").text("Agregando...");
					$("#formRecursos button").addClass("disabled");
				},
				success: function (data) {

					$("#formRecursos button[type=submit]").text("Agregar");
					$("#formRecursos button").removeClass("disabled");

					var html = "";
					var count = 0;

					var sinRegistros = $("#tableRecursos tbody tr.sin-registros").length;
					var id = $("#formRecursos").find("input[name=id]").val();

					if (parseInt(data.status) == 200) {

						if (parseInt(data.id) > 0) {

							if (parseInt(sinRegistros) > 0) {
								html = '<tr><td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_profesion]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_especialidad]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_cantidad]").val() + '</td>';
								html += '<td class="delete-recurso" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}
							else {
								html = $("#tableRecursos tbody").html();
								html += '<tr><td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_profesion]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_especialidad]").val().toUpperCase() + '</td>';
								html += '<td class="text-center">' + $("#formRecursos").find("input[name=evento_recursos_humanos_cantidad]").val() + '</td>';
								html += '<td class="delete-recurso" rel="' + data.id + '"><span aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></span></td></tr>';
							}

							$("#formRecursos")[0].reset();
							$("#formRecursos").find("input[name=id]").val(id);
						}

						$("#tableRecursos tbody").html(html);

					}
					else if (parseInt(data.status) == 201) {
						$("#duplicate_recurso").removeClass("hide");
						setTimeout(function () {
							$("#duplicate_recurso").addClass("hide");
						}, 2000);
					}
					else {
						alert("Error al registrar");
					}

				}
			});
		}
	});

	$("html").on("click", "#tableMedicamentos tbody tr td.delete-medicamento", function () {

		var id = $(this).attr("rel");
		$("#deleteMedicamentoModal").modal("show");
		$("#deleteMedicamentoModal").find("input[name=id]").val(id);

	});

	$("html").on("click", "#tableEquipos tbody tr td.delete-equipo", function () {

		var id = $(this).attr("rel");
		$("#deleteEquipoModal").modal("show");
		$("#deleteEquipoModal").find("input[name=id]").val(id);

	});

	$("html").on("click", "#tableRecursos tbody tr td.delete-recurso", function () {

		var id = $(this).attr("rel");
		$("#deleteRecursoModal").modal("show");
		$("#deleteRecursoModal").find("input[name=id]").val(id);

	});

	$("#deleteMedicamentoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eliminarMedicamento",
				data: $("#deleteMedicamentoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#deleteMedicamentoModal button[type=submit]").text("Eliminando...");
					$("#deleteMedicamentoModal button").addClass("disabled");
				},
				success: function (data) {
					if (parseInt(data.status) == 200) {
						location.reload();
					} else {
						$("#deleteMedicamentoModal button").removeClass("disabled");
						$("#deleteMedicamentoModal button[type=submit]").text("Eliminar");
					}
				}
			});
		}

	});

	$("#deleteEquipoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eliminarEquipo",
				data: $("#deleteEquipoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#deleteEquipoModal button[type=submit]").text("Eliminando...");
					$("#deleteEquipoModal button").addClass("disabled");
				},
				success: function (data) {

					if (parseInt(data.status) == 200) {
						location.reload();
					} else {
						$("#deleteEquipoModal button").removeClass("disabled");
						$("#deleteEquipoModal button[type=submit]").text("Eliminar");
					}

				}
			});
		}

	});

	$("#deleteRecursoForm").validate({

		rules: {
			id: { required: true }
		},
		messages: {
			id: { required: "(*) Campo Requerido" }
		},
		submitHandler: function (form, event) {
			event.preventDefault();

			$.ajax({
				type: "POST",
				url: URI + "eventos/eventos/eliminarRecurso",
				data: $("#deleteRecursoForm").serialize(),
				dataType: "json",
				beforeSend: function () {
					$("#deleteRecursoModal button[type=submit]").text("Eliminando...");
					$("#deleteRecursoModal button").addClass("disabled");
				},
				success: function (data) {
					if (parseInt(data.status) == 200) {
						location.reload();
					} else {
						$("#deleteRecursoModal button").removeClass("disabled");
						$("#deleteRecursoModal button[type=submit]").text("Eliminar");
					}
				}
			});
		}

	});

});

/******************************/