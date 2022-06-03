var data;

$(document).ready(function () {
  var table = $('#dt-select').DataTable({
    data: listaMarcas,
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
      {
        data: "descripcion"
      },
      {
        data: "fecha_registro",
        "render": function (data, type, row, meta) {
          const dateValue = data ? data.split(' ') : [''];
          return toFormatHour(dateValue[0]);
        }
      },
      {
        data: "estado",
        "render": function (data, type, row, meta) {
          return (data == '1' ? 'Activo' : 'Inactivo');
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
        title: 'Lista General de Marcas',
        exportOptions: { columns: [0, 1, 2] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Marcas',
        exportOptions: { columns: [0, 1, 2] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Marcas',
        exportOptions: { columns: [0, 1, 2] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Marcas',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2] },
      },
      {
        extend: 'print',
        title: 'Lista General de Marcas',
        exportOptions: { columns: [0, 1, 2] },
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

  $("#datetimepicker").datetimepicker({
    format: "DD/MM/YYYY",
    maxDate: moment()
  });

  $(".btn-nuevo").on('click', function (event) {
    data = {};
    showModal(event, 'Registrar Nueva Marca');
  });

  $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();

    const dateValue = data.fecha_registro ? data.fecha_registro.split(' ') : [''];
    $('#nombre').val(data.descripcion);
    $('#fecha_registro').val(dateValue[0]);
    $("#estado").prop("checked", data.estado === '1' ? true : false);
    showModal(event, 'Editar Marca');
  }); $("#formRegistrar").validate({
    rules: {
      nombre: { required: true },
      fecha_registro: { required: true }
    },
    messages: {
      nombre: { required: "(*) Campo Requerido" },
      fecha_registro: { required: "(*) Campo Requerido" }
    },
    submitHandler: function (form, event) {
      var formData = ($("#formRegistrar").serializeArray());
      var param = {
        id: data.idmarca
      };
      formData.forEach((item, index) => {
        param[item.name] = item.value;
      });

      $.ajax({
        type: 'POST',
        url: URI + 'inventario/main/guardarMarca',
        data: toQueryString(param),
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (response) {
          $("#editarModal").modal('hide');
          const { status } = response;
          if (status === 200) {
            $("#formRegistrar")[0].reset();
            $('.btn-editar').removeClass('active');
            loadData(table);
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

  $('body').on('click', '#dt-select tr', function () {
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
    url: URI + 'inventario/main/obtenerMarcas',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaMarcas } } = response;
      table.clear();
      table.rows.add(listaMarcas).draw();
    }
  });
}

function showModal(event, title) {
  $("#editarModal").modal("show");
  $("#editarModalLabel").text(title);
  event.stopPropagation();
  event.stopImmediatePropagation();
}

function toQueryString(params) {
  const query = Object.keys(params).map(key => key + '=' + params[key]).join('&');
  return query;
};

function toFormatHour(event) {
  const date = event.split('-');
  return event ? date[2] + '/' + date[1] + '/' + date[0] : event
}