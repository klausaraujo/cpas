$(document).ready(function () {
  var data;
  let item;
  var validate;
  var idAlmacen;

  $("#ficha").change(function (event) {
    readURL(this, false);
  });

  var tableArticulo = $('.tableArticulo').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      dom: 'Brt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
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
          className: 'selectTable table-search'
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
        { data: "marca" },
        { data: "modelo" },
        { data: "almacen" },
        { data: "codigo_patrimonial_original" },
        { data: "codigo_patrimonial_actual" },
        { data: "condicion" },
        {
        data: null,
        "render": function (data, type, row, meta) {
          return data.idsalida > 0 ? `` : `<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
          <i class="fa fa-trash" aria-hidden="true"></i>
        </button>`
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
    if (data.idsalida) {
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/salidas/eliminarDetalleSalida',
        data: { id: data.idsalida, idArticulo: data.idarticuloregistro },
        dataType: 'json',
        success: function (response) {
          const { status } = response;
          if (status === 200) {
            tableArticuloIngresos.row(tr).remove().draw(false);
            item = null;
          }
          $("#decisionModal").modal('hide');
        }
      });
    } else {
      tableArticuloIngresos.row(tr).remove().draw(false);
      item = null;
      $("#decisionModal").modal('hide');
    }
  }
  $('body').on('click', 'td button.actionDelete', function (e) {
    e.preventDefault();
    const tr = $(this).parents('tr');
    const row = tableArticuloIngresos.row(tr);
    data = row.data();

    item = { data, actionType: 1, tr }

    $("#decisionModal #btn-decision").text("Eliminar");
    $("#decisionModal").modal("show");
    $("#decisionModal .modal-title").text("Eliminar Artículo");
    $("#decisionModal .modal-body p").html("Est\xe1 seguro de querer eliminar el artículo");
  });

  $("#btn-decision").on("click", function (e) {
    e.preventDefault();
    switch (item.actionType) {
      case 1: deleteItem(item.data, item.tr);
        break;
    }

  });

  $(".btnMap").on("click", function () {
    const departamentoMap = $("#departamentoMap").val();
    const provinciaMap = $("#provinciaMap").val();
    const distritoMap = $("#distritoMap").val();
    const latitud = $("#latitud").val();
    const longitud = $("#longitud").val();
    if (latitud && longitud) {
      $("#ipressUbicacion").val(`${longitud} ${latitud}`)
    }

    generateUbication(`${departamentoMap}${provinciaMap}${distritoMap}`);
    $("#mapModal").modal('hide');
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
              <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" style="margin-right: 10px;">
              <i class="fa fa-pencil-square-o"></i></button>
              <button class="btn btn-info btn-circle actionFile" title="ADJUNTO" type="button" style="margin-right: 10px;"><i class="fa fa-cloud-upload"></i></button>
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
        { data: "tipo_desplazamiento" },
        { data: "nombre_almacen" },
        {
          data: null,
          render: function (data, type, row, meta) {
            return data.salida_file && data.estado == '1' ? `<button class="btn btn-primary btn-circle actionPdf" title="PDF" type="button" style="margin-right: 5px;" >
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>` : ``;
          }
        },
        { data: "observaciones" },
        {
          data: "estado",
          render: function (data, type, row) {
            return data === '1' ? 'ACTIVO' : 'INACTIVO'
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
          title: 'Lista General de Guía Salida',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Guía Salida',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Guía Salida',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Guía Salida',
          orientation: 'landscape',
          exportOptions: { columns: [0, 1, 2, 3, 4, 6, 7] },
        },

        {
          extend: 'print',
          title: 'Lista General de Guía Salida',
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
  });

  $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();

    validate.resetForm();
    initDates();

    const { anio_ejecucion,
      dni_receptor,
      fecha_emision,
      id_renipress,
      idalmacen,
      idsalida,
      idtipodesplazamiento,
      nombre_receptor,
      observaciones,
      coordenadas_ipress,
      coordenadas_sireed,
      numero_sireed,
      ubigeo_sireed,
      correlativo_sireed,
    } = data;

    $('#anio').val(anio_ejecucion);
    $('#anio').attr("disabled", "disabled");
    $('#idsalidaRegistro').val(idsalida);
    if (fecha_emision) {
      const [fecha, hora] = fecha_emision.split(' ')
      $('#fechaEmision').val(fecha);
      $('#fechaEmision').attr("disabled", "disabled");
    }
    $('#tipoDesplazamiento').val(idtipodesplazamiento);
    $('#almacen').val(idalmacen);
    $('#almacen').attr("disabled", "disabled");
    $('#observaciones').val(observaciones);
    $('#numeroDocumento').val(dni_receptor);
    $('#nombreReceptor').val(nombre_receptor);

    $('#ipressUbicacion').val(coordenadas_ipress || '')
    $('#numeroEventoUbicacion').val(coordenadas_sireed || '');
    $('#numeroEvento').val(correlativo_sireed || '');
    $('#idEvento').val(numero_sireed);

    if (ubigeo_sireed) {
      generateUbication(ubigeo_sireed)
    }

    $.ajax({
      type: 'POST',
      url: URI + 'inventario/main/obtenerRenipressId',
      data: {
        idRenipress: id_renipress
      },
      dataType: 'json',
      success: function (response) {
        const { data } = response;
        if (data.length > 0) {
          const {
            institucion, codigo_renipress, nombre, clasificacion, tipo, region, id_renipress
          } = data[0];
          $('#renipress').val(codigo_renipress);
          $('#institucion').val(institucion);
          $('#nombreSalud').val(nombre);
          $('#regionSalud').val(region);
          $('#clasificacionSalud').val(clasificacion);
          $('#tipoSalud').val(tipo);
          $('#idrenipress').val(id_renipress);
        }
        $.ajax({
          type: 'POST',
          url: URI + 'inventario/salidas/obtenerDetalleSalida',
          data: { id: idsalida },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            if (lista.length === 0) {
              $('#almacen').prop("disabled", false);
              $(".btn-buscar").prop("disabled", !idalmacen);
            }
            tableArticuloIngresos.clear();
            tableArticuloIngresos.rows.add(lista).draw();

            showModal(event, 'Editar Guía de Salida');
          }
        });
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
    $("#decisionModal .modal-title").text("Anular Salida");
    $("#decisionModal .modal-body p").html("Est\xe1 seguro de querer anular el registro de salida");
  });


  $("#btn-decision").on("click", function () {
    switch (item.actionType) {
      case 1: deleteItem(item.data);
        break;
    }
  });

  function deleteItem(data) {
    if (data.idsalida) {
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/salidas/anularIngreso',
        data: { id: data.idsalida },
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

  function addItems(data, hideModal = true) {
    const rowTable = tableArticuloIngresos.rows().data().toArray();
    if (rowTable.find(item => item.idarticuloregistro === data.idarticuloregistro)) {
      $("#tableArticuloModal").modal('hide');
      showAlertForm();
    } else {
      tableArticuloIngresos.rows.add([data]).draw();
    }

    $("#searchArticulo").val('');

    if (hideModal)
      $("#tableArticuloModal").modal('hide');
    else {
      $(".search__span").show()
      setTimeout(() => {
        $(".search__span").hide()
      }, 2000);
    }

  }

  $('.tableArticulo tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = tableArticulo.row(tr);

    index = row.index();
    data = row.data();
    addItems(data);
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
    $('#idEvento').val('');
    $('#idrenipress').val('');
    $('#idsalidaRegistro').val('');

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

  
  $('#tableArticuloModal').on('shown.bs.modal', function () {
    $('#searchArticulo').focus();
  })
  
  $('#searchArticulo').on('paste', function () {
    var _this = this;
    setTimeout(function () {
      tableArticulo.search($(_this).val()).draw();
      const data = tableArticulo.rows({ filter: 'applied' }).data().toArray();
      if (data.length === 1) {
        addItems(data[0], false);
        tableArticulo.search('').draw();
      }
    }, 100);
  })

  $('#searchArticulo').keyup(function () {
    tableArticulo.search($(this).val()).draw();
  })

  $('#tableArticuloModal', '#mapModal','#tableEntidadesSaludModal','#documentoModal','#eventosModal','#editarModal','#decisionModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });
  
  validate = $("#formRegistrar").validate({
    rules: {
      anio: { required: true },
      fechaEmision: { required: true },
      almacen: { required: true },
      tipoDesplazamiento: { required: true },
      departamentoEvento: { required: true },
      provinciaEvento: { required: true },
      distritoEvento: { required: true }
    },
    messages: {
      anio: { required: "(*) Campo Requerido" },
      fechaEmision: { required: "(*) Campo Requerido" },
      almacen: { required: "(*) Campo Requerido" },
      tipoDesplazamiento: { required: "(*) Campo Requerido" },
      departamentoEvento: { required: "(*) Campo Requerido" },
      provinciaEvento: { required: "(*) Campo Requerido" },
      distritoEvento: { required: "(*) Campo Requerido" }
    },
    submitHandler: function (form, event) {
      var formData = new FormData(document.getElementById("formRegistrar"));
      const data = tableArticuloIngresos.rows().data().toArray();
      if (data.length === 0) {
        showAlertForm(`No hay Artículos, <a class="alert-link">seleccione al menos un artículo.</a>`);
        return;
      }

      formData.append("articulos", data.map((item) => item.idarticuloregistro).join('|'));
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/salidas/guardar',
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

  $("#departamentoMap").change(function () {
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
          $("#provinciaMap").html($html);

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

  $("#provinciaMap").change(function () {

    var id = $(this).val();
    var departamento = $("#departamentoMap").val();

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
          $("#distritoMap").html('<option value="">Cargando...</option>');
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
          $("#distritoMap").html($html);
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
      const { institucion, codigo_renipress, nombre, clasificacion, tipo, region, id_renipress, norte, este, ubigeo } = data;
      $('#renipress').val(codigo_renipress);
      $('#institucion').val(institucion);
      $('#nombreSalud').val(nombre);
      $('#regionSalud').val(region);
      $('#clasificacionSalud').val(clasificacion);
      $('#tipoSalud').val(tipo);
      $('#idrenipress').val(id_renipress);
      $('#tblRemittanceList').DataTable().destroy();
      $("#tableEntidadesSaludModal").modal('hide');
      if (ubigeo)
        generateUbication(ubigeo)
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

  $('body').on('click', '#tableArticuloInventariado tr', function () {
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

  $('input#numeroDocumento')
  .keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 8) {
      return false;
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
    url: URI + 'inventario/salidas/obtenerLista',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaSalida } } = response;
      table.clear();
      table.rows.add(listaSalida).draw();
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