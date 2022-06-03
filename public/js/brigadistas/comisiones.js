
$(document).ready(function () {
   var data;
   var validate;

   $("#ficha").change(function (event) {
      readURL(this, false);
   });
   validate = $("#formRegistrar").validate({
      rules: {
         region: { required: true },
         tipo: { required: true },
         tipoEvento: { required: true },
         evento: { required: true },
         eventoDetalle: { required: true },
         numeroEvento: { required: true },
         descripcion: { required: true },
         fechaInicio: { required: true },
         fechaFin: { required: true }
      },
      messages: {
         region: { required: "(*) Campo Requerido" },
         tipo: { required: "(*) Campo Requerido" },
         tipoEvento: { required: "(*) Campo Requerido" },
         evento: { required: "(*) Campo Requerido" },
         eventoDetalle: { required: "(*) Campo Requerido" },
         numeroEvento: { required: "(*) Campo Requerido" },
         descripcion: { required: "(*) Campo Requerido" },
         fechaInicio: { required: "(*) Campo Requerido" },
         fechaFin: { required: "(*) Campo Requerido" }
      },
      submitHandler: function (form, event) {
         var formData = new FormData(document.getElementById("formRegistrar"));

         const data = tablerrhhmision.rows().data().toArray();
         if (data.length === 0) {
            showAlertForm(`No hay Recursos Registrados, <a class="alert-link">Seleccione al menos un Recurso.</a>`);
            return;
         }
         formData.append("idrenarhed", data.map((item) => item.idrenarhed).join('|'));
         formData.append("apellidos", data.map((item) => item.apellidos).join('|'));
         formData.append("nombres", data.map((item) => item.nombres).join('|'));
         formData.append("numero_documento", data.map((item) => item.numero_documento).join('|'));
         formData.append("idfuncion", data.map((item) => item.idfuncion).join('|'));

         $.ajax({
            type: 'POST',
            url: URI + 'brigadistas/main/guardarComision',
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
                  loadData(tablaRegied)
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
      }); $('.tablaRegied tbody').on('click', 'td .actionIdioma', function () {

         var data = table.row($(this).parents('tr')).data();
         post(URI + "brigadistas/formAdditional", { id: data.idrenarhed });
      });

   $("body").on("click", ".actionEdit", function () {
      initDates();
      var tr = $(this).parents('tr');
      var row = tablaRegied.row(tr);
      data = row.data();

      console.log(data.idcomision)
      $("#editarModal").find("input[name=idcomision]").val(data.idcomision);
      $("#editarModal").find("input[name=descripcion]").val(data.descripcion);
      $("#editarModal").find("select[name=region]").val(data.codigo_region);
      $("#editarModal").find("select[name=tipo]").val(data.tipoe);

      generateUbication(data.codigo_tipo_evento, data.codigo_evento, data.codigo_evento_detalle);

      $("#editarModal").find("input[name=numeroEvento]").val(data.evento_sireed);
      $("#editarModal").find("input[name=idEvento]").val(data.evento_registro_numero);
      $("#editarModal").find("input[name=fechaInicio]").val(data.fecha_inicio);
      $("#editarModal").find("input[name=fechaFin]").val(data.fecha_fin);

      $.ajax({
         type: 'POST',
         url: URI + 'brigadistas/main/obtenerDetalleComision',
         data: { id: data.idcomision },
         dataType: 'json',
         success: function (response) {
            const { data: { listacomi } } = response;

            tablerrhhmision.clear();

            tablerrhhmision.rows.add(listacomi).draw();

            if (listacomi.length > 0) { }
            showModal(event, 'Editar Comisión');
         }
      });
   }); $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();
      $('.btn-buscar').removeAttr("disabled");
      initDates();
      data = {};
      tablerrhhmision.clear().draw();
      showModal(event, 'Registrar Comisión');
   });

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
         idfuncion: { required: "(*) Campo Requerido" }
      },
      submitHandler: function (form, event) {
         var formData = $("#formRRHHComiRegistrar").serializeArray();
         const funcionnomb = $('select[name="idfuncion"] option:selected').text();
         let items = {};
         const rowTable = tablerrhhmision.rows().data().toArray();
         formData.forEach(element => {
            items[element.name] = element.value;

         }); var selectedTable = tableRHComi.rows('.selected').data().toArray();

         if (selectedTable.length === 0) return;
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
      if ($(this).hasClass('selected')) {
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
      $('#idEvento').val(id); if (ubigeo)
         generateUbigeo(ubigeo);
      $("#eventosModal").modal('hide');
      console.log(tipoevento);
      console.log(eventocodigo);
      console.log(eventodetalle);
      if (tipoevento)
         generateUbication(tipoevento, eventocodigo, eventodetalle);
   });

});

var tablerrhhmision = $('.tablerrhhmision').DataTable(
   {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      data: [],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      columns: [
         { data: "idrenarhed" },
         { data: "apellidos" },
         { data: "nombres" },
         { data: "numero_documento" },
         { data: "funcionnomb" },
         { data: "idfuncion" },
         {
            data: null,
            className: "center",
            defaultContent: `<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
         </button>`,
            orderable: false
         }
      ],
      columnDefs: [{
         "targets": [5],
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
   });

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

var tablaRegied = $('.tablaRegied').DataTable({
   pageLength: 5,
   lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
   data: lista,

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
         data: "idcomision"
      },
      {
         data: "Region"
      },
      {
         data: "tipo"
      },
      {
         data: "fecha_inicio"
      },
      {
         data: "fecha_fin"
      },
      {
         data: "Tipo_Evento_Nombre"
      },
      {
         data: "Evento_Nombre"
      },
      {
         data: "estado",
         render: function (data, type, row, meta) {
            return `<span class="badge ${data === 'Activo' ? 'badge-success' : 'badge-danger'}">${data}</span>`
         }
      },
      {
         data: "Evento_Detalle_Nombre"
      },
      {
         data: "codigo_region"
      },
      {
         data: "codigo_tipo_evento"
      },
      {
         data: "codigo_evento"
      },
   ],
   order: [],
   columnDefs: [{
      "targets": [9, 10, 11, 12],
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
   }],

   language:
   {
      search: "Buscar:",
      lengthMenu: "Mostrando _MENU_ registros por página",
      zeroRecords: "Sin registros",
      info: "Mostrando página  _PAGE_ de _PAGES_",
      infoEmpty: "No hay registros disponibles",
      infoFiltered: "(filrado de _MAX_ registros totales)",
      paginate: {
         first: "Primero",
         last: "Último",
         next: "Siguiente",
         previous: "Anterior"
      },
   }
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
   $("#deleteModal input[name=idcomision]").val("");
   $('#deleteModal').modal('show');

   var tr = $(this).parents('tr');
   var row = tablaRegied.row(tr);
   data = row.data();
   console.log(data.idcomision);
   $("#deleteModal input[name=idcomision]").val(data.idcomision);
});
$('body').on('click', 'td button.actionDelete', function (e) {
   e.preventDefault();
   tablerrhhmision.row($(this).parents('tr')).remove().draw(false);
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

function generateUbication(tipoevento, eventocodigo, eventodetalle) {

   $('#tipoEvento').val(tipoevento);

   $.ajax({
      data: {
         tipoEvento: tipoevento
      },
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

            $html += `<option value="${e.Evento_Codigo}" ${e.Evento_Codigo == eventocodigo ? 'selected' : ''}> ${e.Evento_Nombre} </option>`;
         });
         $("#evento").html($html);

      }
   });

   $.ajax({
      data: { tipoEvento: tipoevento, evento: eventocodigo },
      url: URI + "eventos/eventos/cargarEventoDetalle",
      method: "POST",
      dataType: "json",
      beforeSend: function () {
         $("#eventoDetalle").html('<option value="">Cargando...</option>');
      },
      success: function (data) {

         var $html = '<option value="">--Seleccione--</option>';
         $.each(data.lista, function (i, e) {
            $html += `<option value="${e.Evento_Detalle_Codigo}" ${e.Evento_Detalle_Codigo == eventodetalle ? 'selected' : ''}> ${e.Evento_Detalle_Nombre} </option>`;
         });
         $("#eventoDetalle").html($html);

      }
   });

}
function loadData(table) {
   $.ajax({
      type: 'POST',
      url: URI + 'brigadistas/main/obtenerListaComision',
      data: {},
      dataType: 'json',
      success: function (response) {
         const { data: { listarComisiones } } = response;
         table.clear();
         table.rows.add(listarComisiones).draw();
      }
   });
}