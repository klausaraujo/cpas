function main(URI) {

	setTimeout(function() {
		$(".alert").slideUp();
	}, 3500);
	
	function post(path, params, method) {
		method = method || "post";

		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);

		for ( var key in params) {
			if (params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("name", key);
				hiddenField.setAttribute("value", params[key]);

				form.appendChild(hiddenField);
			}
		}

		document.body.appendChild(form);
		form.submit();
	}

	$(document) .ready( function() {
		
		$("select[name=Anio]").on("change",function(){
			
			var anio = $(this).val();
			
			if( anio.length > 1 ) {
				post(URI+ "friaje",{Anio : anio});				
			}
			
		});
		
		var table = "";

		$("#evento_fecha").datetimepicker({
			format: "DD/MM/YYYY",
			maxDate:moment()
	     });
		
		setTimeout(function(){
		table = $('.tbLista').DataTable(			
				{
				dom : '<"html5buttons"B>lTfgitp',	
					pageLength : 25,
					columns : [
						{ "data" : "id" },
						{ "data" : "planes_registro_tipo" },
						{ "data" : "planes_fecha_inicio" },
						{ "data" : "planes_fecha_fin" },
						{ "data" : "avance" },
						{ "data" : "Evento_Estado_Codigo" },
						{ "data" : "archivo" },
						{ "data" : "estado" },
						{ "data" : "planes_archivo" },
						{ "data" : "Activo" },
						{ "data" : "descripcion" },
						{ "data" : "indicador" }
					],
					columnDefs : [ {
						"targets" : [ 8,9,10,11 ],
						"visible" : false,
						"searchable" : false
					} ],
					"order" : [ [ 0, "asc" ] ],
					buttons : [
							{
								extend : 'copy',
								title : 'lista-planes',
								exportOptions: {columns: [0,1,2,3]},
							},
							{
								extend : 'csv',
								title : 'lista planes',
								exportOptions: {columns: [0,1,2,3]},
							},
							{
								extend : 'excel',
								title : 'lista planes',
								exportOptions: {columns: [0,1,2,3]},
							},
							{
								extend : 'pdf',
								title : 'lista planes',
								orientation: 'landscape',
								exportOptions: {columns: [0,1,2,3]},
							},

							{
								extend : 'print',
								title : 'lista planes',
								exportOptions: {columns: [0,1,2,3]},
								customize: function (win){
					                $(win.document.body).addClass('white-bg');
					                $(win.document.body).css('font-size', '10px');

					                $(win.document.body).find('table')
					                        .addClass('compact')
					                        .css('font-size', 'inherit');

					                var css = '@page { size: landscape; }',
					                head = win.document.head || win.document.getElementsByTagName('head')[0],
					                style = win.document.createElement('style');

					                style.type = 'text/css';
					                style.media = 'print';

					                if (style.styleSheet)
					                {
					                  style.styleSheet.cssText = css;
					                }
					                else
					                {
					                  style.appendChild(win.document.createTextNode(css));
					                }

					                head.appendChild(style);
								}
							} 
						]

				});
		
		},300);			
		
		$("#btn-nuevo").on("click",function(){
			$("#modal-registrar").modal("show");
		});
		
		var tableIndicador = $('.tbIndicador').DataTable(
				{
					pageLength : 5,
					columns : [ {
						"data" : "id"
					}, {
						"data" : "Indicador"
					} ],
					"ajax" : {
						url : URI + "friaje/indicadoresAjax",
						type : "POST",
						data : function(d) {
							d.Anio_Ejecucion = document.getElementById("Anio_Ejecucion").value
						}
					}
				});

		$("#formRegistrar select[name=planes_registro_anio_ejecucion], #formActualizar select[name=planes_registro_anio_ejecucion]").on("change",function(){
			
			var anio = $(this).val();
			tableIndicador.ajax.reload();
			
		});
		
		$('.tbIndicador tbody').on('click', 'tr', function () {
			
	        var data = tableIndicador.row( this ).data();
	        
	        $("#formRegistrar input[name=IdIndicador]").val(data.id);
	        $("#formRegistrar input[name=Nombre_Indicador").val(data.Indicador);
	        $('#tableIndicadorModal').modal('hide');
	    });

		$('body').on('click','.tbLista tr',function() {

			$("#Tipo_Accion").val("");

			var tr = $(this);
			var row = table.row(tr);

			index = row.index();

			data = row.data();
			var id = data.id;
			
			$("#btn-editar").removeClass("editar");
			$("#btn-anular").removeClass("anular");		
			
			//if (estado == '1') {
				$("#btn-editar").addClass("editar");
				$("#btn-anular").addClass("anular");
			//}

			$("#btn-editar").find("label").attr("rel", id);
			$("#btn-anular").find("label").attr("rel", id);

			if ($(this).hasClass('selected')) {
				$(this).removeClass('selected');
			} else {
				table.$('tr.selected').removeClass('selected');
				$(this).addClass('selected');
			}

		});
		
		
		
	});

}