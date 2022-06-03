$(document).ready(function () {
  var data;
  let item;
  var validate;
  var idAlmacen;
  let selectedRow;

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
        { data: "marca" },
        { data: "modelo" },
        { data: "almacen" },
        { data: "codigo_patrimonial_original" },
        { data: "codigo_patrimonial_actual" },
        { data: "condicion" }
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
        { "data": "descripcion" }
      ],
      columnDefs: [{
        "targets": [5, 6, 7, 8, 9],
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

  var tableSinComponentes = $('.tableSinComponentes').DataTable(
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
          render: function (data, type, row, meta) {
            return data === '1' ? 'OPERATIVO' : 'INOPERATIVO'
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
      }
    });

  var tableListaComponentes = $('.tableListaComponentes').DataTable(
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
          render: function (data, type, row, meta) {
            return data === '1' ? 'OPERATIVO' : 'INOPERATIVO'
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
      }
    });

  function deleteItem(data, tr) {
    if (data.idarticuloregistro) {
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/articulos/eliminarComponente',
        data: { idHijo: data.idarticuloregistro, idPadre: data.idarticuloprincipal },
        dataType: 'json',
        success: function (response) {
          const { status } = response;
          loadData(table)
          $("#decisionModal").modal('hide');
          $("#tableComponenteModal").modal('hide');
        }
      });
    } else {
      loadData(table);
      item = null;
      $("#decisionModal").modal('hide');
      $("#tableComponenteModal").modal('hide');
    }
  }

  $('body').on('click', 'td button.actionDelete', function (e) {
    e.preventDefault();
    const tr = $(this).parents('tr');
    const row = tableSinComponentes.row(tr);
    data = row.data();

    item = { data, actionType: 1, tr }

    $("#decisionModal #btn-decision").text("Eliminar");
    $("#decisionModal").modal("show");
    $("#decisionModal .modal-title").text("Eliminar Artículo");
    $("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar el artículo");
  });

  $("#btn-decision").on("click", function () {
    switch (item.actionType) {
      case 1: deleteItem(item.data, item.tr);
        break;
    }

  });

  $('.tableListaComponentes tbody').on('click', 'tr', function () {
    let tr = $(this);
    let row = tableListaComponentes.row(tr);
    let data = row.data();
    selectedRow = data;
    if ($(this).hasClass('selected')) {
      $('.btn-editar').removeClass('active');
      $(this).removeClass('selected');
    } else {
      tableListaComponentes.$('tr.selected').removeClass('selected');
      $(this).addClass('selected');
    }
  }); var table = $('#tableComponentes').DataTable(
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
            return `<div style="display: flex;"> <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" style="margin-right: 10px;">
            <i class="fa fa-pencil-square-o"></i></button></div>`
          }
        },
        {
          data: null,
          "render": function (data, type, row, meta) {
            return `<div style="display: flex;"><button class="btn btn-info btn-circle actionShow" title="CONSULTAR" type="button">
            <i class="fa fa-cloud-upload"></i></button> </div>`
          }
        },
        {
          data: "descripcion"
        },
        { data: "marca" },
        { data: "modelo" },
        { data: "codigo_patrimonial_original" },

        {
          data: null,
          "render": function (data, type, row, meta) {
            return ''
          }
        },
        {
          data: null,
          "render": function (data, type, row, meta) {
            return ''
          }
        },
        {
          data: "condicion",
          render: function (data, type, row, meta) {
            return data === '1' ? 'OPERATIVO' : 'INOPERATIVO'
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
          title: 'Lista General de Items con Registro de Subcomponentes Internos',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Items con Registro de Subcomponentes Internos',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Items con Registro de Subcomponentes Internos',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Items con Registro de Subcomponentes Internos',
          orientation: 'landscape',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },

        {
          extend: 'print',
          title: 'Lista General de Items con Registro de Subcomponentes Internos',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
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
        }, {
          extend: 'pageLength',
          titleAttr: 'Registros a mostrar',
          className: 'selectTable'
        }]
      }
    });

  $('body').on('click', 'td button.actionPdf', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { ingreso_file: ficha } = data;
    const ruta = `${URI}public/inventarios/salidas/${ficha}`;
    if (ruta)
      window.open(ruta);
  });

  $('body').on('click', 'td button.actionInforme', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { idsalida: ficha } = data;
    const ruta = `${URI}inventario/salidas/informe/${ficha}`;
    if (ruta)
      window.open(ruta);
  }); $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const idArticuloRegistro = data.idarticuloregistro;

    $.ajax({
      type: 'POST',
      url: URI + 'inventario/articulos/dependenciaComponente',
      data: {},
      dataType: 'json',
      success: function (response) {
        const { data } = response;
        $("#idarticuloregistro").val(idArticuloRegistro);
        tableListaComponentes.clear();
        tableListaComponentes.rows.add(data).draw();
        $("#tableArticuloModal").modal("show");
      }
    });

  });

  $('#tableArticuloModal').on('shown.bs.modal', function () {
    $('#searchArticulo').focus();
  })

  $('#searchArticulo').keyup(function () {
    tableListaComponentes.search($(this).val()).draw();
  })

  $("body").on("click", ".actionShow", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const idArticuloRegistro = data.idarticuloregistro;
    console.log(idArticuloRegistro);
    $.ajax({
      type: 'POST',
      url: URI + 'inventario/articulos/dependenciaComponente',
      data: { idArticulo: idArticuloRegistro },
      dataType: 'json',
      success: function (response) {
        const { data } = response;
        tableSinComponentes.clear();
        tableSinComponentes.rows.add(data).draw();
        $("#tableComponenteModal").modal("show");
      }
    });

  });

  $("body").on("click", ".actionFile", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    validate.resetForm();
    initDates();
    const { idsalida } = data;
    $("#idsalida").val(idsalida);
    $('#documentoModal').modal('show');
  });

  $('.tableArticulo tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = tableArticulo.row(tr);
    const rowTable = tableArticuloIngresos.rows().data().toArray();
    index = row.index();
    data = row.data();
    if (rowTable.find(item => item.idarticuloregistro === data.idarticuloregistro)) {
      showAlertForm()
    } else {
      tableArticuloIngresos.rows.add([data]).draw();
    }
    $("#tableArticuloModal").modal('hide');
  });

  $("#btnBuscarEvento").on('click', function (event) {
    $("#eventosModal").modal("show");
  });
  $("#btnIpressUbicacion").on('click', function (event) {
    $("#mapModal").modal("show");
  });

  $("#Anio_Ejecucion_Evento, #mes").on("change", function () {
    tableEvento.ajax.reload();
  });

  $('body').on('click', '.tableEventos tbody tr td', function () {
    var tr = $(this).parents('tr');
    var row = tableEvento.row(tr);

    index = row.index();
    data = row.data();

    const { coordenada, correlativo, ubigeo, id } = data;
    $('#numeroEventoUbicacion').val(coordenada);
    $('#numeroEvento').val(correlativo);
    $('#idEvento').val(id);
    if (ubigeo)
      generateUbication(ubigeo);
    $("#eventosModal").modal('hide');

  });

  $(".btn-nuevo").on('click', function (event) {
    $("#formRegistrar")[0].reset();
    $('#anio').removeAttr("disabled");
    $('#almacen').removeAttr("disabled");
    $('#fechaEmision').removeAttr("disabled");
    $('.btn-buscar').removeAttr("disabled");
    initDates();
    data = {};
    tableArticuloIngresos.clear().draw();
    showModal(event, 'Registrar Guía de Salida');
  });

  $(".btn-buscar").on('click', function (event) {
    idAlmacen = $('#almacen').val();
    $.ajax({
      type: 'POST',
      url: URI + 'inventario/articulos/obtenerArticulosSalida',
      data: { idAlmacen },
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

  validate = $("#formRegistrar").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function (form, event) {
      const idArticuloRegistro = $("#idarticuloregistro").val()

      $.ajax({
        type: 'POST',
        url: URI + 'inventario/articulos/guardarComponente',
        data: { idPadre: idArticuloRegistro, idHijo: selectedRow.idarticuloregistro },
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (response) {
          $("#tableArticuloModal").modal('hide');
          const { status } = response;
          if (status === 200) {
            $("#formRegistrar")[0].reset();
            loadData(table)
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

  $("#formDocumentoRegistrar").validate({
    rules: {
      ficha: { required: true },
    },
    messages: {
      ficha: { required: "(*) Campo Requerido" },
    },
    submitHandler: function (form, event) {
      var formData = new FormData(document.getElementById("formDocumentoRegistrar"));
      formData.append("ficha", document.getElementById("ficha"));

      $.ajax({
        type: 'POST',
        url: URI + 'inventario/salidas/guardarAdjunto',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {

        },
        success: function (response) {
          $("#documentoModal").modal('hide');
          const { status } = response;
          if (status === 200) {
            $("#formDocumentoRegistrar")[0].reset();
            $('.btn-editar').removeClass('active');
            $('.btn-adjunto').removeClass('active');
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

  $("#btnBuscarPaciente").on("click", function () {
    var documento_numero = $("input[name=numeroDocumento]").val();
    if (documento_numero.length >= 8) {
      var type = "01";
      if (documento_numero.length > 8) {
        type = "03";
      }
      $.ajax({
        url: URI + "ofertamovil/main/curl",
        data: { type: type, document: documento_numero },
        method: 'post',
        dataType: 'json',
        error: function (xhr) {
          $("#btnBuscarPaciente").removeAttr("disabled");
          $("#btnBuscarPaciente").html('<i class="fa fa-search" aria-hidden="true"></i>');
        },
        beforeSend: function () {
          $("#btnBuscarPaciente").html('<i class="fa fa-spinner fa-pulse"></i>');
          $("#btnBuscarPaciente").attr("disabled", "disabled");
        },
        success: function (data) {
          $("#btnBuscarPaciente").removeAttr("disabled");
          $("#btnBuscarPaciente").html('<i class="fa fa-search" aria-hidden="true"></i>');

          $("#nombreReceptor").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno + " " + data.data.attributes.nombres)
          validate.resetForm();
        }
      });

    }

  });

  $("#departamento").change(function () {
    var id = $(this).val();
    if (id.length > 0) {
      $.ajax({
        data: {
          departamento: id
        },
        url: URI + "eventos/main/cargarProvincias",
        method: "POST",
        dataType: "json",
        beforeSend: function () {
          $("#provincia").html('<option value="">Cargando...</option>');
          $("#distrito").html('<option value="">--Elija Provincia--</option>');
        },
        success: function (data) {

          var $html = '<option value="">--Seleccione--</option>';
          $.each(data.lista, function (i, e) {

            $html += '<option value="'
              + e.Codigo_Provincia
              + '">'
              + e.Nombre
              + '</option>';
          });
          $("#provincia").html($html);

        }
      });

    }
  });

  $("#departamentoEvento").change(function () {
    var id = $(this).val();
    if (id.length > 0) {
      $.ajax({
        data: {
          departamento: id
        },
        url: URI + "eventos/main/cargarProvincias",
        method: "POST",
        dataType: "json",
        beforeSend: function () {
          $("#provinciaEvento").html('<option value="">Cargando...</option>');
          $("#distritoEvento").html('<option value="">--Elija Provincia--</option>');
        },
        success: function (data) {

          var $html = '<option value="">--Seleccione--</option>';
          $.each(data.lista, function (i, e) {

            $html += '<option value="'
              + e.Codigo_Provincia
              + '">'
              + e.Nombre
              + '</option>';
          });
          $("#provinciaEvento").html($html);

        }
      });

    }
  });

  $("#almacen").change(function () {
    idAlmacen = $(this).val();
    $(".btn-buscar").prop("disabled", false);
  });

  $("#provinciaEvento").change(function () {

    var id = $(this).val();
    var departamento = $("#departamentoEvento").val();

    if (id.length > 0 && departamento.length > 0) {

      $.ajax({
        data: {
          departamento: departamento,
          provincia: id
        },
        url: URI + "eventos/main/cargarDistritos",
        method: "POST",
        dataType: "json",
        beforeSend: function () {
          $("#distritoEvento").html('<option value="">Cargando...</option>');
        },
        success: function (data) {
          var $html = '<option value="">--Seleccione--</option>';
          $.each(data.lista, function (i, e) {

            $html += '<option value="'
              + e.Codigo_Distrito
              + '">'
              + e.Nombre
              + '</option>';

          });
          $("#distritoEvento").html($html);
        }
      });
    }
  });

  $("#provincia").change(function () {

    var id = $(this).val();
    var departamento = $("#departamento").val();

    if (id.length > 0 && departamento.length > 0) {

      $.ajax({
        data: {
          departamento: departamento,
          provincia: id
        },
        url: URI + "eventos/main/cargarDistritos",
        method: "POST",
        dataType: "json",
        beforeSend: function () {
          $("#distrito").html('<option value="">Cargando...</option>');
        },
        success: function (data) {
          var $html = '<option value="">--Seleccione--</option>';
          $.each(data.lista, function (i, e) {

            $html += '<option value="'
              + e.Codigo_Distrito
              + '">'
              + e.Nombre
              + '</option>';

          });
          $("#distrito").html($html);
        }
      });

    }
  });

  $("#distrito").change(function () {
    var distrito = $(this).val();
    var nombreDistrito = $(this).find('option:selected').text();
    var departamento = $("#departamento").val();
    var nombreDepartamento = $("#departamento option:selected").text();
    var provincia = $("#provincia").val();
    var nombreProvincia = $("#provincia option:selected").text();
    $("#codigoUbigeo").val(`${departamento}${provincia}${distrito}`)
    $("#nombreUbigeo").val(`${nombreDepartamento}, ${nombreProvincia}, ${nombreDistrito}`)
  });

  tableEntidadesSalud = $('.tableEntidadesSalud').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      columns: [{
        "data": "codigo_renipress"
      }, {
        "data": "nombre"
      }, {
        "data": "clasificacion"
      }],
      data: []
    }); $("#btnFiltrarUbigeo").on('click', function (event) {
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/main/obtenerRenipress',
        data: {
          departamento: document.getElementById("departamento").value,
          provincia: document.getElementById("provincia").value,
          distrito: document.getElementById("distrito").value
        },
        dataType: 'json',
        success: function (response) {
          const { data } = response;
          tableEntidadesSalud.clear();
          tableEntidadesSalud.rows.add(data).draw();
        }
      });

    })

  $('.tableEntidadesSalud tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = tableEntidadesSalud.row(tr);
    index = row.index();
    data = row.data();

    if (data) {
      const { institucion, codigo_renipress, nombre, clasificacion, tipo, region, id_renipress, norte, este } = data;
      $('#renipress').val(codigo_renipress);
      $('#institucion').val(institucion);
      $('#nombreSalud').val(nombre);
      $('#regionSalud').val(region);
      $('#clasificacionSalud').val(clasificacion);
      $('#tipoSalud').val(tipo);
      $('#idrenipress').val(id_renipress);
      $('#tblRemittanceList').DataTable().destroy();
      $("#tableEntidadesSaludModal").modal('hide');

      if (norte && este) {
        $('#ipressUbicacion').val(`${norte}, ${este}`)
      }
      if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
      } else {
        tableEntidadesSalud.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    }
  });

  $('#tableEntidadesSaludModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });

  $('#eventosModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });

  $('#decisionModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });

  $('body').on('click', '#tableComponentes tr', function () {
    var tr = $(this);
    var row = table.row(tr);
    index = row.index();
    data = row.data();

    if (data) {
      $('.btn-editar').removeClass('active');
      $('.btn-adjunto').removeClass('active');
      $('.btn-editar').addClass('active');
      $('.btn-adjunto').addClass('active');
      if ($(this).hasClass('selected')) {
        $('.btn-editar').removeClass('active');
        $('.btn-adjunto').removeClass('active');
        $(this).removeClass('selected');
      } else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    }
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
    url: URI + 'inventario/articulos/obtenerListaComponentes',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { lista } } = response;
      table.clear();
      table.rows.add(lista).draw();
    }
  });
}

function showModal(event, title) {
  $("#editarModal").modal("show");
  $("#editarModalLabel").text(title);
  event.stopPropagation();
  event.stopImmediatePropagation();
}

function showModalDocument(event, title) {
  $("#documentoModal").modal("show");
  $("#documentoModalLabel").text(title);
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
  $('.salida__alert').attr("hidden", false);
  $('#editarModal').animate({ scrollTop: 0 }, 'slow');
  setTimeout(() => {
    $('.salida__alert').attr("hidden", true);
  }, 3000);
}

function generateUbication(ubigeoCode) {
  const idDepartamento = ubigeoCode.slice(0, 2);
  const idProvincia = ubigeoCode.slice(2, 4);
  const idDistrito = ubigeoCode.slice(4, 6);

  $('#departamentoEvento').val(idDepartamento);

  $.ajax({
    data: {
      departamento: idDepartamento
    },
    url: URI + "eventos/main/cargarProvincias",
    method: "POST",
    dataType: "json",
    beforeSend: function () {
      $("#provinciaEvento").html('<option value="">Cargando...</option>');
      $("#distritoEvento").html('<option value="">--Elija Provincia--</option>');
    },
    success: function (data) {
      let $html = '<option value="">--Seleccione--</option>';
      $.each(data.lista, function (i, e) {
        $html += `<option value="${e.Codigo_Provincia}" ${e.Codigo_Provincia == idProvincia ? 'selected' : ''}> ${e.Nombre} </option>`;
      });
      $("#provinciaEvento").html($html);
    }
  });

  $.ajax({
    data: {
      departamento: idDepartamento,
      provincia: idProvincia
    },
    url: URI + "eventos/main/cargarDistritos",
    method: "POST",
    dataType: "json",
    beforeSend: function () {
      $("#distritoEvento").html('<option value="">Cargando...</option>');
    },
    success: function (data) {
      let $html = '<option value="">--Seleccione--</option>';
      $.each(data.lista, function (i, e) {
        $html += `<option value="${e.Codigo_Distrito}" ${e.Codigo_Distrito == idDistrito ? 'selected' : ''}> ${e.Nombre} </option>`;
      });
      $("#distritoEvento").html($html);
    }
  });

}