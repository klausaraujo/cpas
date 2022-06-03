$(document).ready(function () {
  var data;
  var validate;
  let item;

  $("#ficha").change(function (event) {
    readURL(this, false);
  });

  var tableArticulo = $('.tableArticulo').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      data: [],
      columns: [
        { data: "idarticuloregistro" },
        { data: "descripcion" },
        { data: "marca" },
        { data: "modelo" },
        { data: "clasificacion" },
        { data: "codigo_patrimonial_original" },
        { data: "codigo_patrimonial_actual" },
        {
          data: "condicion",
          render: function (data, type, row) {
            return data === '1' ? 'OPERATIVO' : data === '2' ? 'INOPERATIVO' : ''
          }
        }
      ],
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

  var tableArticuloIngresos = $('.tableArticuloIngresos').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      data: [],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      columns: [
        { data: "idarticuloregistro" },
        { data: "descripcion" },
        { data: "marca" },
        { data: "modelo" },
        { data: "clasificacion" },
        { data: "codigo_patrimonial_original" },
        { data: "codigo_patrimonial_actual" },
        {
          data: "condicion",
          render: function (data, type, row) {
            return data === '1' ? 'OPERATIVO' : data === '2' ? 'INOPERATIVO' : ''
          }
        },
        {
          data: null,
          className: "center",
          defaultContent: `<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>`,
          orderable: false
        }
      ],
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

  $('body').on('click', 'td button.actionDelete', function (e) {
    e.preventDefault();
    tableArticuloIngresos.row($(this).parents('tr')).remove().draw(false);
    const data = tableArticuloIngresos.rows().data();
    if (data.length === 0) {
      $('#almacen').removeAttr("disabled");
      $('.btn-buscar').removeAttr("disabled");
    }
  });

  var table = $('#tableArticuloInventariado').DataTable(
    {
      data: lista,
      pageLength: 25,
      lengthMenu: [[25, 50, 100, 500, -1], [25, 50, 100, 500, 'Todas']],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      columns: [
        {
          data: null,
          "render": function (data, type, row, meta) {
            return row.estado == '1' ? `<div style="display: flex;"> 
              <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" style="margin-right: 10px;"> <i class="fa fa-pencil-square-o"></i></button>
              <button class="btn btn-danger btn-circle actionBlocked" title="ANULAR" type="button"><i class="fa fa-minus-circle"></i></button>
            </div>` : ``
          }
        },
        {
          data: "anio_ejecucion"
        },
        {
          data: "numero_guia",
          render: function (data = 0, type, row) {
            if (data) {
              const size = `${data}`.length
              return ('0000' + data).slice(-4 - (size > 4 ? (size - 4) : 0))
            }

            return data;
          }
        },
        {
          data: "fecha_emision",
          render: function (data, type, row) {
            return toFormatHour(data);
          }
        },
        { data: "tipo_ingreso" },
        { data: "nombre_almacen" },
        {
          data: "ingreso_file", 
          render: function (data, type, row, meta) {
            return row.estado == '1' ? `<div style="display: flex;"> 
            <button class="btn btn-primary btn-circle actionFiles" title="Archivos" style="margin-right: 5px;">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>`  : ``
          },
        },
        { data: "observaciones" },
        {
          data: "estado",
          render: function (data, type, row) {
            return data == '1' ? 'ACTIVO' : 'INACTIVO'
          }
        },
        {
          data: null,
          render: function (data, type, row, meta) {
            return data.estado == '1' ? `<button class="btn btn-primary btn-circle actionInforme" title="PDF" type="button" style="margin-right: 5px;" >
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>` : ``;
          }
        }
      ],
      columnDefs: [],
      select: true,
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
          extend: 'copy',
          title: 'Lista General de Guía de Ingreso',
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Guía de Ingreso',
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Guía de Ingreso',
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Guía de Ingreso',
          orientation: 'landscape',
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
        },
        {
          extend: 'print',
          title: 'Lista General de Guía de Ingreso',
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
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
        },
        {
          extend: 'pageLength',
          titleAttr: 'Registros a mostrar',
          className: 'selectTable'
        }]
      }
    });

  $('.tableArticulo tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = tableArticulo.row(tr);
    const rowTable = tableArticuloIngresos.rows().data().toArray();
    index = row.index();
    data = row.data();
    if (rowTable.find(item => item.idarticuloregistro === data.idarticuloregistro)) {
      showAlertForm();
    } else {
      tableArticuloIngresos.rows.add([data]).draw();
    }
    $("#tableArticuloModal").modal('hide');
  });

  $("#btnRegistrar").on('click', function (event) {
    $("#formRegistrar")[0].reset();
    $('#anio').removeAttr("disabled");
    $('#almacen').removeAttr("disabled");
    $('#fechaEmision').removeAttr("disabled");
    $(".custom-file").text('Escoger archivo…');    
    $('.btn-buscar').removeAttr("disabled");    
    $('#idingreso').val('');
    initDates();
    data = {};
    tableArticuloIngresos.clear().draw();
    showModal(event, 'Registrar Guía de Ingreso');
  });

  $(".btn-buscar").on('click', function (event) {
    $.ajax({
      type: 'POST',
      url: URI + 'inventario/articulos/obtenerListaInventariado',
      data: {},
      dataType: 'json',
      success: function (response) {
        const { data: { listaArticulos } } = response;
        tableArticulo.clear();
        tableArticulo.rows.add(listaArticulos).draw();
        $("#tableArticuloModal").modal('show');
      }
    });
  });

  $('#tableArticuloModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });

  $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    validate.resetForm();
    initDates();
    const { anio_ejecucion,
      fecha_emision,
      idalmacen,
      idingreso,
      idtipoingreso,
      numero_guia,
      observaciones } = data;

    $('#anio').val(anio_ejecucion);
    $('#idingreso').val(idingreso);
    $('#anio').attr("disabled", "disabled");
    $('#almacen').attr("disabled", "disabled");

    if (fecha_emision) {
      const [fecha, hora] = fecha_emision.split(' ')
      $('#fechaEmision').val(fecha);
      $('#fechaEmision').attr("disabled", "disabled");
    }

    $('#tipoIngreso').val(idtipoingreso);
    $('#almacen').val(idalmacen);
    $('#observaciones').val(observaciones);

    $.ajax({
      type: 'POST',
      url: URI + 'inventario/ingresos/obtenerDetalleIngreso',
      data: { id: idingreso },
      dataType: 'json',
      success: function (response) {
        const { data: { lista } } = response;
        tableArticuloIngresos.clear();
        tableArticuloIngresos.rows.add(lista).draw();

        showModal(event, 'Editar Guía de Ingreso');
      }
    });
  });

  $("body").on("click", ".actionBlocked", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    item = { data, actionType: 1, tr }

    $("#decisionModal #btn-decision").text("Anular");
    $("#decisionModal").modal("show");
    $("#decisionModal .modal-title").text("Anular Ingreso");
    $("#decisionModal .modal-body p").html("Est\xe1 seguro de querer anular el registro de ingreso");
  });


  $("#btn-decision").on("click", function () {
    switch (item.actionType) {
      case 1: deleteItem(item.data);
        break;
    }
  });

  function deleteItem(data) {
    if (data.idingreso) {
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/ingresos/anularIngreso',
        data: { id: data.idingreso },
        dataType: 'json',
        success: function (response) {
          const { status } = response;
          if (status === 200) {
            loadData(table);
            item = null;
          }
          $("#decisionModal").modal('hide');
        }
      });
    } else {
      item = null;
      $("#decisionModal").modal('hide');
    }
  }

  validate = $("#formRegistrar").validate({
    rules: {
      anio: { required: true },
      fechaEmision: { required: true },
      tipoIngreso: { required: true },
      almacen: { required: true },
    },
    messages: {
      anio: { required: "(*) Campo Requerido" },
      fechaEmision: { required: "(*) Campo Requerido" },
      tipoIngreso: { required: "(*) Campo Requerido" },
      almacen: { required: "(*) Campo Requerido" }
    },
    submitHandler: function (form, event) {
      var formData = new FormData(document.getElementById("formRegistrar"));
      formData.append("ficha", document.getElementById("ficha"));
      const data = tableArticuloIngresos.rows().data().toArray();
      if (data.length === 0) {
        showAlertForm(`No hay Artículos, <a class="alert-link">seleccione al menos un artículo.</a>`);
        return;
      }
      formData.append("articulos", data.map((item) => item.idarticuloregistro).join('|'));
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/ingresos/guardar',
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
            loadData(table)
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
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { ingreso_file: ficha } = data;
    const ruta = `${URI}public/inventarios/ingresos/${ficha}`;
    if (ruta)
      window.open(ruta);
  });

  $('body').on('click', 'td button.actionInforme', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { idingreso: ficha } = data;
    const ruta = `${URI}inventario/ingresos/informe/${ficha}`;
    if (ruta)
      window.open(ruta);
  });


  $('body').on('click', '#tableArticuloInventariado tr', function () {
    var tr = $(this);
    var row = table.row(tr);
    index = row.index();
    data = row.data();

    if (data) {
      $('.btn-editar').removeClass('active');
      $('.btn-editar').addClass('active');
      if ($(this).hasClass('selected')) {
        $('.btn-editar').removeClass('active');
        $(this).removeClass('selected');
      } else {
        table.$('.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    }
  });


$(".actionFiles").on("click", function () {
  var tr = $(this).parents('tr');
  var row = table.row(tr); 

  index = row.index();
  data = row.data();
  
  console.log(data);

   post(URI + "inventario/main/filesinventario",
   {
     idingreso: data.idingreso
   });

});

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

function loadData(table) {
  $.ajax({
    type: 'POST',
    url: URI + 'inventario/ingresos/obtenerLista',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaIngresos } } = response;
      table.clear();
      table.rows.add(listaIngresos).draw();
    }
  });
}

function showModal(event, title) {
  $("#editarModal").modal("show");
  $("#editarModalLabel").text(title);
  event.stopPropagation();
  event.stopImmediatePropagation();
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

function showAlertForm(htmlText) {
  $('.alert__span').html(htmlText || `El Artículo ya esta registrado, <a class="alert-link">seleccione otro Artículo.</a>`);
  $('.ingresos__alert').attr("hidden", false);
  $('#editarModal').animate({ scrollTop: 0 }, 'slow');
  setTimeout(() => {
    $('.ingresos__alert').attr("hidden", true);
  }, 3000);
}


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