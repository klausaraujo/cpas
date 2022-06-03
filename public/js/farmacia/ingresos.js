$(document).ready(function () {
  var data;
  var validate;

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
        { data: "descripcion" },
        { data: "categoria" },
        { data: "presentacion" },
        { data: "via" },
        {
          data: "estado",
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
        buttons: [
          {
            extend: 'pageLength',
            titleAttr: 'Registros a mostrar',
            className: 'selectTable'
          }
        ]
      }
    });

  var tableArticuloIngresos = $('.tableArticuloIngresos').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      data: [],
      columns: [
        { data: "descripcion" },
        { data: "lote" },
        { data: "cantidad" },
        { data: "vencimiento" },
        { data: "costo_unitario" },
        { data: "categoria" },
        {
          data: "presentacion"
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
        buttons: [
          {
            extend: 'pageLength',
            titleAttr: 'Registros a mostrar',
            className: 'selectTable'
          }
        ]
      }
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
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      pageLength: 25,
      lengthMenu: [[25, 50, 100, 500, -1], [25, 50, 100, 500, 'Todas']],
      columns: [
        {
          data: null,
          "render": function (data, type, row, meta) {
            return `<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
            <i class="fa fa-pencil-square-o"></i></button>`
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
            return data ? `<button class="btn btn-primary btn-circle actionPdf" title="PDF" type="button" style="margin-right: 5px;">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>` : ``
          },
        },
        { data: "observaciones" },
        {
          data: "estado",
          render: function (data, type, row) {
            return data === '1' ? 'ACTIVO' : 'INACTIVO'
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

  $("#formArticuloRegistrar").validate({
    rules: {
      lote: { required: true },
      fechaVencimiento: { required: true },
      cantidad: { required: true },
    },
    messages: {
      lote: { required: "(*) Campo Requerido" },
      fechaVencimiento: { required: "(*) Campo Requerido" },
      cantidad: { required: "(*) Campo Requerido" },
    },
    submitHandler: function (form, event) {
      var formData = $("#formArticuloRegistrar").serializeArray();
      let items = {};
      const rowTable = tableArticuloIngresos.rows().data().toArray();
      formData.forEach(element => {
        items[element.name] = element.value;
      }); var selectedTable = tableArticulo.rows('.selected').data().toArray();
      if (selectedTable.length === 0) return;
      const data = {
        ...selectedTable[0],
        ...items
      }

      if (rowTable.find(item => item.lote === data.lote)) {
        showAlertForm();
      } else {
        tableArticuloIngresos.rows.add([data]).draw();
        $("#formArticuloRegistrar")[0].reset();

      }
      $("#tableArticuloModal").modal('hide');

    }
  });

  $('.tableArticulo tbody').on('click', 'tr', function () {
    if ($(this).hasClass('selected')) {
      $(this).removeClass('selected');
    }
    else {
      tableArticulo.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
    }

  });

  $(".btn-nuevo").on('click', function (event) {
    $("#formRegistrar")[0].reset();
    $('#anio').removeAttr("disabled");
    $('#almacen').removeAttr("disabled");
    $('#fechaEmision').removeAttr("disabled");
    $('.btn-buscar').removeAttr("disabled");
    $('#idingreso').val('');
    
    data = {};
    tableArticuloIngresos.clear().draw();
    showModal(event, 'Registrar Guía de Ingreso');
  });

  $(".btn-buscar").on('click', function (event) {
    $.ajax({
      type: 'POST',
      url: URI + 'farmacia/articulos/obtenerListaInventariado',
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
  }); $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();

    validate.resetForm();

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

    if (fecha_emision) {
      const [fecha, hora] = fecha_emision.split(' ')
      $('#fechaEmision').val(fecha);
      $('#fechaEmision').attr("disabled", "disabled");
    }
    $('#tipoIngreso').val(idtipoingreso);
    $('#almacen').val(idalmacen);
    $('#observaciones').val(observaciones); $.ajax({
      type: 'POST',
      url: URI + 'farmacia/ingresos/obtenerDetalleIngreso',
      data: { id: idingreso },
      dataType: 'json',
      success: function (response) {
        const { data: { lista } } = response;
        tableArticuloIngresos.clear();
        tableArticuloIngresos.rows.add(lista).draw();
        if (lista.length > 0) {
          $('.btn-buscar').attr("disabled", "disabled");
          $('#almacen').attr("disabled", "disabled");
        }
        showModal(event, 'Editar Guía de Ingreso');
      }
    });
  });
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
      formData.append("costo_unitario", data.map((item) => item.costo_unitario).join('|'));
      formData.append("lote", data.map((item) => item.lote).join('|'));
      formData.append("cantidad", data.map((item) => item.cantidad).join('|'));
      formData.append("observacionArticulo", data.map((item) => item.observacionArticulo).join('|'));
      formData.append("vencimiento", data.map((item) => item.vencimiento).join('|'));

      $.ajax({
        type: 'POST',
        url: URI + 'farmacia/ingresos/guardar',
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
    const ruta = `${URI}public/farmacia/ingresos/${ficha}`;
    if (ruta)
      window.open(ruta);
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
    url: URI + 'farmacia/ingresos/obtenerLista',
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

function getFormattedDate() {
  var todayTime = new Date();
  var month = format(todayTime.getMonth() + 1);
  var day = format(todayTime.getDate());
  var year = format(todayTime.getFullYear());
  return month + "/" + day + "/" + year;
}