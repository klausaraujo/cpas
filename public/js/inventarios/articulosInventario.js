$(document).ready(function () {
  var data;
  var validate;
  var tableArticulo = $('.tableArticulo').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      language: languageDatatable,
      autoWidth: true,
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      columns: [{
        "data": "codigo_siga"
      },
      {
        "data": "descripcion"
      },
      {
        "data": "marca"
      },
      {
        "data": "modelo"
      },
      {
        "data": "clasificacion"
      },
      {
        "data": "estado"
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
      "ajax": {
        url: URI + "inventario/articulos/obtenerListaBusqueda",
        type: "POST"
      }
    });

  $('.tableArticulo tbody').on('click', 'tr', function () {
    var tr = $(this);
    var row = tableArticulo.row(tr);
    index = row.index();
    data = row.data();

    if (data) {
      const { idarticulo, descripcion, idmarca, modelo, dimensiones, peso, idcolor, idclasificacion, idunidadmedida, imagen, codigo_siga } = data;
      $('#siga').val(codigo_siga);
      $('#idarticulo').val(idarticulo);
      $('#nombre').val(descripcion);
      $('#marca').val(idmarca);
      $('#modelo').val(modelo);
      $('#dimensiones').val(dimensiones);
      $('#peso').val(peso);
      $('#color').val(idcolor);
      $('#clasificacion').val(idclasificacion);
      $('#medida').val(idunidadmedida);
      $("#imagen").attr("src", URI + "public/inventarios/fotos/" + imagen);
      $("#tableArticulo").modal('hide');
    }
  });

  var tableArticuloInv = $('.tableArticuloInv').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      language: languageDatatable,
      autoWidth: true,
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      columns: [
        { data: "descripcion" },
        { data: "marca" },
        { data: "modelo" },
        { data: "codigo_patrimonial_original" },
        { data: "codigo_patrimonial_actual" },
        { data: "serie_vista" }
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
      "ajax": {
        url: URI + "inventario/main/obtenerListaInventarioModal",
        type: "POST"
      }
    });

    $('.tableArticuloInv tbody').on('click', 'tr', function () {
      var tr = $(this);
      var row = tableArticuloInv.row(tr);
      index = row.index();
      data = row.data();
      
      if (data) {
        const { idarticuloregistro, codigo_siga, idarticulo, descripcion, idmarca, modelo, dimensiones, peso,
      idcolor, idclasificacion, idunidadmedida, imagen, fecha_registro_articulo, serie, estadoInventariado, codigo_patrimonial_original, codigo_patrimonial_actual, condicion,
      costo_inicial, orden, pecosa, codigo_activo, clasificador, observaciones, caracteristicas, subcomponentes, fecha_compra, anio_fabricacion, codigo_digerd, tipohospital, idtipohospital } = data;
    
    $('#siga').val(codigo_siga);
    $('#idarticulo').val(idarticulo);
    $('#nombre').val(descripcion);
    $('#marca').val(idmarca);
    $('#modelo').val(modelo);
    $('#dimensiones').val(dimensiones);
    $('#peso').val(peso);
    $('#color').val(idcolor);
    $('#clasificacion').val(idclasificacion);
    $('#medida').val(idunidadmedida);
    $('#imagen').attr('src', URI + 'public/inventarios/fotos/' + imagen);    
    if (fecha_registro_articulo) $('#fechaRegistro').val(toFormatHour(fecha_registro_articulo));
    $('#condicionActual').val(condicion);
    $("#estadoInventariado").prop("checked", estadoInventariado === '1' ? true : false);
    $("#costoInicial").val(costo_inicial);
    if (fecha_compra)
      $("#fecCompra").val(toFormatHour(fecha_compra));
    $("#anioFabricacion").val(anio_fabricacion);
    $("#ordenCompra").val(orden);
    $("#numPecosa").val(pecosa);
    $("#codigoSbn").val(codigo_activo);
    $("#tipoPresupuesto").val(clasificador);
    $("#observacion").val(observaciones);
    $("#caracteristica").val(caracteristicas);
    $("#tipohospital").val(idtipohospital);
    $("#estadoSubItems").prop("checked", subcomponentes === '1' ? true : false); $('.btn-buscar').attr("disabled", "disabled");
    $("#tableArticuloInv").modal('hide');
      }
    });

  var table = $('#tableArticuloInventariado').DataTable({
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
          return `<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
          <i class="fa fa-pencil-square-o"></i></button>`
        }
      },
      { data: "codigo_siga" },
      { data: "descripcion" },
      { data: "marca" },
      { data: "modelo" },
      { data: "clasificacion" },
      { data: "codigo_patrimonial_original" },
      { data: "codigo_patrimonial_actual" },
      { data: "serie_vista" },
      { data: "clasificador_vista" },
      {
        data: "condicion",
        render: function (data, type, row, meta) {
          return data === '1' ? 'OPERATIVO' : 'INOPERATIVO'
        }
      },
      { data: "tipohospital" },
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
        title: 'Lista General de Artículos Inventariados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Artículos Inventariados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Artículos Inventariados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Artículos Inventariados',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'print',
        title: 'Lista General de Artículos Inventariados',
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
      }, {
        extend: 'pageLength',
        titleAttr: 'Registros a mostrar',
        className: 'selectTable'
      }]
    }
  });

  $(".btn-nuevo").on('click', function (event) {
    $('#imagen').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=');
    $("#formRegistrar")[0].reset();
    $('.btn-buscar').removeAttr('disabled');
    initDates();
    data = {};
    showModal(event, 'Registrar Nuevo Articulo Inventariado');
  });
  $(".btn-buscar").on('click', function (event) {
    $("#tableArticulo").modal('show');
  });
  $(".btn-buscainv").on('click', function (event) {
    $("#tableArticuloInv").modal('show');
  });
  $('#tableArticulo').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
    validate.resetForm();
  });
  $('#tableArticuloInv').on('hidden.bs.modal', function () {
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

    const { idarticuloregistro, codigo_siga, idarticulo, descripcion, idmarca, modelo, dimensiones, peso,
      idcolor, idclasificacion, idunidadmedida, imagen, fecha_registro_articulo, serie, estadoInventariado, codigo_patrimonial_original, codigo_patrimonial_actual, condicion,
      costo_inicial, orden, pecosa, codigo_activo, clasificador, observaciones, caracteristicas, subcomponentes, fecha_compra, anio_fabricacion, codigo_digerd, tipohospital } = data;

    $('#siga').val(codigo_siga);
    $('#idarticuloregistro').val(idarticuloregistro);
    $('#idarticulo').val(idarticulo);
    $('#nombre').val(descripcion);
    $('#marca').val(idmarca);
    $('#modelo').val(modelo);
    $('#dimensiones').val(dimensiones);
    $('#peso').val(peso);
    $('#color').val(idcolor);
    $('#clasificacion').val(idclasificacion);
    $('#medida').val(idunidadmedida);
    $('#imagen').attr('src', URI + 'public/inventarios/fotos/' + imagen);
    $('#serie').val(serie);
    $('#patrimonioOriginal').val(codigo_patrimonial_original);
    $('#patrimonioActual').val(codigo_patrimonial_actual);
    if (fecha_registro_articulo) $('#fechaRegistro').val(toFormatHour(fecha_registro_articulo));
    $('#condicionActual').val(condicion);
    $("#estadoInventariado").prop("checked", estadoInventariado === '1' ? true : false);
    $("#costoInicial").val(costo_inicial);
    if (fecha_compra)
      $("#fecCompra").val(toFormatHour(fecha_compra));
    $("#anioFabricacion").val(anio_fabricacion);
    $("#codDigerd").val(codigo_digerd);
    $("#ordenCompra").val(orden);
    $("#numPecosa").val(pecosa);
    $("#codigoSbn").val(codigo_activo);
    $("#tipoPresupuesto").val(clasificador);
    $("#observacion").val(observaciones);
    $("#caracteristica").val(caracteristicas);
    $("#tipohospital").val(tipohospital);
    $("#estadoSubItems").prop("checked", subcomponentes === '1' ? true : false); $('.btn-buscar').attr("disabled", "disabled");
    showModal(event, 'Editar Artículo Invetariado');
  });

  validate = $("#formRegistrar").validate({
    rules: {
      patrimonioOriginal: { required: true },
      patrimonioActual: { required: true },
      condicionActual: { required: true },
    },
    messages: {
      condicionActual: { required: "(*) Campo Requerido" }
    },
    submitHandler: function (form, event) {
      var formData = ($("#formRegistrar").serializeArray());
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/articulos/guardarArticuloInventariado',
        data: formData,
        dataType: 'json',
        error: function (response) {
          const { status } = response;
          if (status === 501) {
            $('.alert-danger').fadeIn(1000);
          } 
          else if (status === 502) {
            $('.alert-danger').fadeIn(1000);
          }
          else if (status === 503){
            $('.alert-danger').fadeIn(1000);
          }
        },

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
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    }
  });
});

function loadData(table) {
  $.ajax({
    type: 'POST',
    url: URI + 'inventario/articulos/obtenerListaInventariado',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaArticulos } } = response;
      table.clear();
      table.rows.add(listaArticulos).draw();
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
  return dateValue
}