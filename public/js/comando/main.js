$(document).ready(function () {
   var data;
   var validate;

   $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();
      $('.btn-buscar').removeAttr("disabled");
      initDates();
      data = {};
      //tablerrhhmision.clear().draw();
      showModal(event, 'Registrar Indicador');
   });

   $("input[name=matriz-1]").on("keyup", function(){calculatetab1sec1();});
   $("input[name=matriz-2]").on("keyup", function(){calculatetab1sec1();});
   
   $("input[name=matriz-3]").on("keyup", function(){calculatetab1sec2();});
   $("input[name=matriz-4]").on("keyup", function(){calculatetab1sec2();});
   
   $("input[name=matriz-5]").on("keyup", function(){calculatetab1sec3();});
   $("input[name=matriz-6]").on("keyup", function(){calculatetab1sec3();});
   
   $("input[name=matriz-7]").on("keyup", function(){calculatetab1sec4();});
   $("input[name=matriz-8]").on("keyup", function(){calculatetab1sec4();});
   
   $("input[name=matriz-9]",).on("keyup", function(){calculatetab1sec5();});
   $("input[name=matriz-10]").on("keyup", function(){calculatetab1sec5();});
   
   $("input[name=matriz-11]").on("keyup", function(){calculatetab1sec6();});
   $("input[name=matriz-12]").on("keyup", function(){calculatetab1sec6();});
   
   $("input[name=matriz-13]").on("keyup", function(){calculatetab1sec7();});
   $("input[name=matriz-14]").on("keyup", function(){calculatetab1sec7();});
   
   $("input[name=matriz-15]").on("keyup", function(){calculatetab1sec8();});
   $("input[name=matriz-23]").on("keyup", function(){calculatetab1sec8();});
   
   $("input[name=matriz-21]").on("keyup", function(){calculatetab1sec9();});
   $("input[name=matriz-22]").on("keyup", function(){calculatetab1sec9();});
   
   $("input[name=matriz-16]").on("keyup", function(){calculatetab1sec10();});
   $("input[name=matriz-24]").on("keyup", function(){calculatetab1sec10();});
   
   $("input[name=matriz-17]").on("keyup", function(){calculatetab1sec11();});
   $("input[name=matriz-18]").on("keyup", function(){calculatetab1sec11();});
   
   $("input[name=matriz-19]").on("keyup", function(){calculatetab1sec12();});
   $("input[name=matriz-20]").on("keyup", function(){calculatetab1sec12();});

   $("#region").change(function () {

      id = $(this).val();

      if (id.length > 0) {

         $.ajax({
            data: { region: id },
            url: URI + "indicadoresppr/main/cargarUnidadEjecutora",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
               $("#idejecutora").html('<option value="">Cargando...</option>');
            },
            success: function (data) {

               var $html = '<option value="">--Seleccione--</option>';
               $.each(data.lista, function (i, e) {

                  $html += '<option value="' + e.idejecutora + '">' + e.nombre + '</option>';

               });
               $("#idejecutora").html($html);

            }
         });

      }

   });

   validate = $("#formRegistrar").validate({
      rules: {
         region: { required: true },
         idejecutora: { required: true },
         fecha_recepcion: { required: true },
         anio: { required: true },
         mes: { required: true }
      },
      messages: {
         region: { required: "Campo requerido" },
         idejecutora: { required: "Campo requerido" },
         fecha_recepcion: { required: "Campo requerido" },
         anio: { required: "Campo requerido" },
         mes: { required: "Campo requerido" }
      },
      submitHandler: function (form, event) {
         var formData = new FormData(document.getElementById("formRegistrar"));
         //formData.append("funcion", document.getElementById("funcion"));
         //const data = tablecalculoindicador.rows().data().toArray();
         if(data.length === 0){
         showAlertForm(`No hay Recursos Registrados, <a class="alert-link">Seleccione al menos un Recurso.</a>`);
         return;
         }
         //var data1 = tablecalculoindicador.$('input').serialize();
         //console.log(data1);
         
         //formData.append(data1);
         
         $.ajax({
            type: 'POST',
            url: URI + 'indicadoresppr/main/guardarIndicador',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {

            },
            success: function (response) {
               $("#editarModal").modal('hide');
               const { status } = response;
               if (status === 200) {
                  $("#formRegistrar")[0].reset();
                  $('.btn-editar').removeClass('active');
                  loadData(tablaRegInd)
                  $('.alert-success').fadeIn(1000);
               } else {
                  $('.alert-danger').fadeIn(1000);
               }
               setTimeout(() => {
                  $('.alert').fadeOut(1000);
               }, 1500);
            }
         });
      }
   });

   $('body').on('click', 'td button.actionPdf', function () {
      var tr = $(this).parents('tr');
      var row = tablaRegInd.row(tr);
  
      index = row.index();
      data = row.data();
      const { archivo_reporte: ficha } = data;
      const ruta = `${URI}public/comando/reportes/${ficha}`;
      if (ruta)
        window.open(ruta);
    });

  $('body').on('click', 'td button.actionInforme', function () {
   var tr = $(this).parents('tr');
   var row = table.row(tr);

   index = row.index();
   data = row.data();
   const { idcomando_registro: ID } = data;
   const ruta = `${URI}comando/reportes/${ID}`;
   if (ruta)
     window.open(ruta);
 });

/*
   var tableEvento = $('.tableEventos').DataTable(
      {
         pageLength: 5,
         lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
         language: languageDatatable,
         autoWidth: true,
         data: [],
         columns: [
            { "data": "correlativo" },
            { "data": "evento" },
            { "data": "fecha" },
            { "data": "ubicacion" },
            { "data": "estado" },
            { "data": "orden" },
            { "data": "id" },
            { "data": "tipo" },
            { "data": "detalle" },
            { "data": "descripcion" },
            { "data": "tipoevento" },
            { "data": "eventocodigo" },
            { "data": "eventodetalle" },
         ],
         columnDefs: [{
            "targets": [5, 6, 7, 8, 9, 10, 11, 12],
            "visible": false,
            "searchable": false
         }],
         buttons: {
            dom: {
               container: {
                  tag: 'div',
                  className: 'flexcontent'
               },
               buttonLiner: {
                  tag: null
               }
            },
            buttons: [{
               extend: 'pageLength',
               titleAttr: 'Registros a mostrar',
               className: 'selectTable'
            }]
         },
         order: [[5, "asc"]],
         ajax: {
            url: URI + "inventario/main/eventos",
            type: "POST",
            data: function (d) {
               d.Anio_Ejecucion = document.getElementById("Anio_Ejecucion_Evento").value;
               d.mes = document.getElementById("mes").value;
            }
         }
      });
   */

   $("body").on("click", ".actionEdit", function () {
      initDates();
      var tr = $(this).parents('tr');
      var row = tablaRegInd.row(tr);
      data = row.data();
      //console.log(data);
      $("#editarModal input[name=idregistro]").val("");

      console.log(data.ID);

      $("#editarModal input[name=idregistro]").val(data.ID);
      if (data.fecha_registro) {
         const [fecha_registro] = data.fecha_registro.split(' ')
         $('#fecha_recepcion').val(fecha_registro);
         //$('#fechaEmision').attr("disabled", "disabled");
       }
      //$("#editarModal").find("input[name=fecha_recepcion]").val(data.fecha_registro);
      $("#editarModal").find("select[name=anio]").val(data.anio_ejecucion);
      $("#editarModal").find("select[name=mes]").val(data.codigo_mes);

      generateUbication(data.codigo_region, data.idejecutora);
      
      
      $.ajax({
        type: 'POST',
        url: URI + 'indicadoresppr/main/obtenerDetalleIndicador',
        data: { id: data.ID },
        dataType: 'json',
        success: function (response) {
          const { data: { listadetalleindicador } } = response;
                
          listadetalleindicador.forEach(item => {
               $(`#matriz-${item.idmatriz}`).val(item.valor);
               calculatetab1sec1();
               calculatetab1sec2();
               calculatetab1sec3();
               calculatetab1sec4();
               calculatetab1sec5();
               calculatetab1sec6();
               calculatetab1sec7();
               calculatetab1sec8();
               calculatetab1sec9();
               calculatetab1sec10();
               calculatetab1sec11();
               calculatetab1sec12();
               $(`#comentarios-${item.idmatriz}`).val(item.comentarios);
          })
          
          showModal(event, 'Editar Indicador');
        }
      });
    });
    /*
   $("#tipoEvento").change(function () {

      id = $(this).val();

      if (id.length > 0) {

         $.ajax({
            data: { tipoEvento: id },
            url: URI + "eventos/eventos/cargarEvento",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
               $("#evento").html('<option value="">Cargando...</option>');
               $("#eventoDetalle").html('<option value="">-- Seleccione --</option>');
            },
            success: function (data) {

               var $html = '<option value="">--Seleccione--</option>';
               $.each(data.lista, function (i, e) {

                  $html += '<option value="' + e.Evento_Codigo + '">' + e.Evento_Nombre + '</option>';

               });
               $("#evento").html($html);

            }
         });

      }

   });
   $("#btnBuscarEvento").on('click', function (event) {
      $("#eventosModal").modal("show");
   });

   $("#Anio_Ejecucion_Evento, #mes").on("change", function () {
      tableEvento.ajax.reload();
   });


   $("#formRRHHComiRegistrar").validate({
      rules: {
         idfuncion: { required: true }
      },
      messages: {
         idfuncion: { required: "Campo requerido" }
      },
      submitHandler: function (form, event) {
        var formData = $("#formRRHHComiRegistrar").serializeArray();
        const funcionnomb = $('select[name="idfuncion"] option:selected').text();
        let items = {};
        const rowTable = tablerrhhmision.rows().data().toArray();
        formData.forEach(element => {
          items[element.name] = element.value;
        });
  
        
        var selectedTable = tableRHComi.rows('.selected').data().toArray();
        if(selectedTable.length === 0) return;
        const data = {
          ...selectedTable[0],
          ...items, 
          funcionnomb
        }
        tablerrhhmision.rows.add([data]).draw();
        $("#formRRHHComiRegistrar")[0].reset();

        $("#tableRHComiModal").modal('hide');
  
      }
    });

    $('#tableRHComiModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
      validate.resetForm();
    });
       
    $('#eventosModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
      validate.resetForm();
    });

   $('.tableRHComi tbody').on('click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
      }
      else {
         tableRHComi.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
      }
      
    });

   $('body').on('click', '.tableEventos tbody tr td', function () {
      var tr = $(this).parents('tr');
      var row = tableEvento.row(tr);

      index = row.index();
      data = row.data();

      const { coordenada, correlativo, ubigeo, id, eventodetalle, tipoevento, eventocodigo } = data;
      $('#numeroEvento').val(correlativo);
      $('#idEvento').val(id);
      if (ubigeo)
         generateUbigeo(ubigeo);
      $("#eventosModal").modal('hide');
      console.log(tipoevento);
      console.log(eventocodigo);
      console.log(eventodetalle);
      if (tipoevento)
         generateUbication(tipoevento, eventocodigo, eventodetalle);
   });
*/
});
var tablecalculoindicador

$.ajax({
   url: URI + "indicadoresppr/main/cargaformreg",
   type: "POST",
   data: {},
   dataType: 'json',
   success: function (response) {
      tablecalculoindicador = $('.tablecalculoindicador').DataTable(
         {
            pageLength: 50,
            lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            data: response,
            dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
            language: languageDatatable,
            autoWidth: true,
            columns: [
               { data: "producto_proyecto" },
               { data: "actividad" },
               { data: "forma_calculo" },
               { data: null, 
                  render: function (data, type, row) {
                  return `<div style="display: flex">
                           ${data.accionnom}  <input type="text" class="form-control" name="matriz-${data.idmatriz}" id="matriz-${data.idmatriz}" value="" style="font-size: 12px; text-transform:uppercase;">
                        </div>`;
               }
               },
               { data: "idactividad", 
                  render: function (data, type, row) {
                  return `<div style="display: flex">
                          <input type="text" class="form-control" name="valor" value="" style="font-size: 12px; text-transform:uppercase;">
                        </div>`;
               }
               },
               { data: "idactividad", 
                  render: function (data, type, row) {
                  return `<div style="display: flex">
                           <input type="text" class="form-control" name="comentario-${data.idactividad}" value="" style="font-size: 12px; text-transform:uppercase;">
                        </div>`;
               }
               },
               { data: "idproductoproyecto" },
               { data: "idactividad" }
            ],
            'rowsGroup': [0, 1, 4, 5],
            columnDefs: [{
               "targets": [6, 7],
               "visible": false,
               "searchable": false
            }],
            buttons: {
               dom: {
                  container: {
                     tag: 'div',
                     className: 'flexcontent'
                  },
                  buttonLiner: {
                     tag: null
                  }
               },
               buttons: [{
                  extend: 'pageLength',
                  titleAttr: 'Registros a mostrar',
                  className: 'selectTable'
               }]
            }
         });
   }
});




/*
$(".btn-buscarb").on('click', function (event) {
      initDates();
      data = {};
      $.ajax({
         type: 'POST',
         url: URI + 'brigadistas/main/obtenerListaRenarhed',
         data: {},
         dataType: 'json',
         success: function (response) {
           const { data: { listarComisionesRenarhed } } = response;
           tableRHComi.clear();
           tableRHComi.rows.add(listarComisionesRenarhed).draw();
          
           $("#tableRHComiModal").modal('show');
         }
       });
   });


var tableRHComi = $('.tableRHComi').DataTable(
      {
         pageLength: 5,
         lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
         language: languageDatatable,
         autoWidth: true,
         data: [],
         columns: [
            { "data": "idrenarhed" },
            { "data": "apellidos" },
            { "data": "nombres" },
            { "data": "numero_documento" }
         ],
         columnDefs: [{
            "searchable": true
         }],
         buttons: {
            dom: {
               container: {
                  tag: 'div',
                  className: 'flexcontent'
               },
               buttonLiner: {
                  tag: null
               }
            },
            buttons: [{
               extend: 'pageLength',
               titleAttr: 'Registros a Mostrar',
               className: 'selectTable'
            }]
         },
         order: [[0, "asc"]]
      });
*/

var tablaRegInd = $('.tablaRegInd').DataTable({
   pageLength: 10,
   lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
   data: lista,
   language: languageDatatable,
   //dom: '<"html5buttons"B>lTfgitp',
   columns: [
      {
         data: null,
         render: function (data, type, row) {
            const btnEdit = data.estado == 'Activo' ? `
            <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` : `
            <button class="btn btn-warning btn-circle disabled" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` ;
            const btnDelete = data.estado == 'Activo' ? `<button class="btn btn-danger btn-circle actionDeleteComi" title="Anular Registro" type="button style="margin-right: 5px;">
               <i class="fa fa-times" aria-hidden="true"></i>
            </button>` : `<button class="btn btn-danger btn-circle disabled" title="Anular Registro" type="button style="margin-right: 5px;">
               <i class="fa fa-times" aria-hidden="true"></i>
            </button>`;

            return `<div style="display: flex">
                     ${canEdit ? btnEdit : ''} 
                     ${canDelete ? btnDelete : ''}
                     </div>`;
         }
      },
      {
         data: "ID"
      },
      {
         data: "region"
      },
      {
         data: "fecha"
      },
      {
         data: "anio_ejecucion"
      },
      {
         data: "nombre_mes"
      },
      {
         data: null,
         render: function (data, type, row, meta) {
           return data.archivo_reporte ? `<button class="btn btn-primary btn-circle actionPdf" title="Reporte Comando" type="button" style="margin-right: 5px;" >
                 <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
               </button>` : ``;
         }
       },
      {
         data: "estado",
         render: function (data, type, row, meta) {
            return `<span class="badge ${data === 'Activo' ? 'badge-success' : 'badge-danger'}">${data}</span>`
         }
      },
      {
         data: "codigo_region"
      },
      {
         data: "mes"
      }
   ],
   order: [],
   columnDefs: [{
      "targets": [1,8,9],
      "visible": false,
      "searchable": false
   }],
   dom: 'Bfrtip',
   select: true,
   buttons: [{
      extend: 'copy',
      title: 'Lista General de Pacientes',
      exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
   },
   {
      extend: 'csv',
      title: 'Lista General de Pacientes',
      exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
   },
   {
      extend: 'excel',
      title: 'Lista General de Pacientes',
      exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
   },
   {
      extend: 'pdf',
      title: 'Lista General de Pacientes',
      orientation: 'landscape',
      exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
   },

   {
      extend: 'print',
      title: 'Lista General de Brigadistas',
      exportOptions: { columns: [0, 1, 2, 3, 4, 5] },
      customize: function (win) {
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

         if (style.styleSheet) {
            style.styleSheet.cssText = css;
         }
         else {
            style.appendChild(win.document.createTextNode(css));
         }

         head.appendChild(style);
      }
   }]
});

function post(path, params, method) {
   method = method || "post";

   var form = document.createElement("form");
   form.setAttribute("method", method);
   form.setAttribute("action", path);

   for (var key in params) {
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

function initDates() {
   const defaultDate = moment().toDate();
   $('.date').each(function () {
      $(this).datetimepicker({
         format: 'DD/MM/YYYY',
         maxDate: moment(),
         useCurrent: true,
         defaultDate
      });
   });
}

function toFormatHour(data = "") {
   const dateValue = (data ? data.split(' ') : [''])[0];
   const date = dateValue.split('-');
   return dateValue ? date[2] + '/' + date[1] + '/' + date[0] : dateValue
}

function showModal(event, title) {
   $("#editarModal").modal("show");
   $("#editarModalLabel").text(title);
   event.stopPropagation();
   event.stopImmediatePropagation();
}

function generateUbigeo(ubigeoCode) {
   const idDepartamento = ubigeoCode.slice(0, 2);
   const idProvincia = ubigeoCode.slice(2, 4);
   const idDistrito = ubigeoCode.slice(4, 6);

   $('#region').val(idDepartamento);

}

$("body").on("click", ".actionDeleteComi", function () {
   $("#deleteModal input[name=idregistro]").val("");
   $('#deleteModal').modal('show');

   var tr = $(this).parents('tr');
   var row = tablaRegInd.row(tr);
   data = row.data();
   console.log(data.ID);
   $("#deleteModal input[name=idregistro]").val(data.ID);
});


$('body').on('click', 'td button.actionDelete', function (e) {
   e.preventDefault();
   tablerrhhmision.row($(this).parents('tr')).remove().draw(false);
   //const data = tableArticuloIngresos.rows().data();
   //if (data.length === 0) {
   //$('#almacen').removeAttr("disabled");
   //$('.btn-buscar').removeAttr("disabled");
   //}
});


function readURL(input, isImage = true) {
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $(input).val();
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
      reader.onload = function (e) {
         if (isImage) $('#imagen').attr('src', e.target.result);
         $(`${isImage ? '.custom-file-img' : '.custom-file'}`).text(filename);
      }
      reader.readAsDataURL(input.files[0]);
   }
   $(".alert").removeClass("loading").hide();
}

function generateUbication(codigo_region, idejecutora) {

   $('#region').val(codigo_region);

   $.ajax({
      data: { region: codigo_region },
      url: URI + "indicadoresppr/main/cargarUnidadEjecutora",
      method: "POST",
      dataType: "json",
      beforeSend: function () {
         $("#idejecutora").html('<option value="">Cargando...</option>');
      },
      success: function (data) {

         var $html = '<option value="">--Seleccione--</option>';
         $.each(data.lista, function (i, e) {
            $html += `<option value="${e.idejecutora}" ${e.idejecutora == idejecutora ? 'selected' : ''}> ${e.nombre} </option>`;
            //$html += '<option value="' + e.idejecutora + '">' + e.nombre + '</option>';

         });
         $("#idejecutora").html($html);

      }
   });

}

function loadData(table) {
   $.ajax({
      type: 'POST',
      url: URI + 'indicadoresppr/main/obtenerListaIndicadores',
      data: {},
      dataType: 'json',
      success: function (response) {
         const { data: { listarIndicadores } } = response;
         table.clear();
         table.rows.add(listarIndicadores).draw();
      }
   });
}

function calculatetab1sec1(){
		
   const matriz1 = Number($('#matriz-1').val() || 0);
   const matriz2 = Number($('#matriz-2').val() || 0);
	
   $('#valor-1').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec2(){
		
   const matriz1 = Number($('#matriz-3').val() || 0);
   const matriz2 = Number($('#matriz-4').val() || 0);
	
   $('#valor-2').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec3(){
		
   const matriz1 = Number($('#matriz-5').val() || 0);
   const matriz2 = Number($('#matriz-6').val() || 0);
	
   $('#valor-3').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec4(){
		
   const matriz1 = Number($('#matriz-7').val() || 0);
   const matriz2 = Number($('#matriz-8').val() || 0);
	
   $('#valor-4').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec5(){
		
   const matriz1 = Number($('#matriz-9').val() || 0);
   const matriz2 = Number($('#matriz-10').val() || 0);
	
   $('#valor-5').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec6(){
		
   const matriz1 = Number($('#matriz-11').val() || 0);
   const matriz2 = Number($('#matriz-12').val() || 0);
	
   $('#valor-6').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec7(){
		
   const matriz1 = Number($('#matriz-13').val() || 0);
   const matriz2 = Number($('#matriz-14').val() || 0);
	
   $('#valor-7').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec8(){
		
   const matriz1 = Number($('#matriz-15').val() || 0);
   const matriz2 = Number($('#matriz-23').val() || 0);
	
   $('#valor-8').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec9(){
		
   const matriz1 = Number($('#matriz-21').val() || 0);
   const matriz2 = Number($('#matriz-22').val() || 0);
	
   $('#valor-9').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec10(){
		
   const matriz1 = Number($('#matriz-16').val() || 0);
   const matriz2 = Number($('#matriz-24').val() || 0);
	
   $('#valor-10').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec11(){
		
   const matriz1 = Number($('#matriz-17').val() || 0);
   const matriz2 = Number($('#matriz-18').val() || 0);
	
   $('#valor-11').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};

function calculatetab1sec12(){
		
   const matriz1 = Number($('#matriz-19').val() || 0);
   const matriz2 = Number($('#matriz-20').val() || 0);
	
   $('#valor-12').val(Math.round(matriz1 / matriz2 * 100 || 0) + "%");		
   
};