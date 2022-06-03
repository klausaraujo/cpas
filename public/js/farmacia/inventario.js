var data;
$(document).ready(function () {
  var table = $('#dt-select').DataTable({
    data: lista,
    dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
    language: languageDatatable,
    autoWidth: true,
    columns: [
      {
        data: "ID"
      },
      {
        data: "SIGA",
      },
      {
        data: "Articulo",
      },
      {
        data: "Categoria",
      },
      {
        data: "Presentacion",
      },
      {
        data: "Via",
      },
      {
        data: "Und_Med",
      },
      {
        data: "Lote",
      },
      {
        data: "Vencimiento",
      },
      {
        data: "Stock",
      },
      {
        data: "Almacen",
      },
      {
        data: "Estado",
      },
      {
        data: null,
        "render": function (data, type, row, meta) {
          let classType = ''
          switch (data.Estado) {
            case 'Vencido':
              classType = 'circle-black';
              break;
            case 'Por Vencer':
              classType = 'circle-red';
              break;
            case 'Riesgo de Vencimiento':
              classType = 'circle-yellow';
              break;
            case 'Sin Riesgo':
              classType = 'circle-green';
              break;
          }
          return `<div class="circle ${classType}"></div>`
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
        title: 'Inventario General',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'csv',
        title: 'Inventario General',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'excel',
        title: 'Inventario General',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'print',
        title: 'Inventario General',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
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

  $("#formTable").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function (form, event) {
      var formData = $("#formTable").serialize();

      $.ajax({
        type: 'POST',
        url: URI + 'farmacia/articulos/inventario',
        data: formData,
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (response) {
          const { data: { lista } } = response;
          table.clear();
          table.rows.add(lista).draw();
        }
      });
    }
  }); $("#administracion").change(function () {
    var id = $(this).val();
    if (id.length > 0) {
      searchPresentation(id);
    }
  });

});
function searchPresentation(id, idpresentacion = null) {
  $.ajax({
    data: {
      administracion: id
    },
    url: URI + "farmacia/main/obtenerPresentacion",
    method: "POST",
    dataType: "json",
    beforeSend: function () {
      $("#presentacion").html('<option value="">Cargando...</option>');
    },
    success: function (response) {
      var $html = '<option value="">--Seleccione--</option>';
      const { data } = response;
      $.each(data.lista, function (i, e) {
        $html += '<option value="'
          + e.id
          + '">'
          + e.descripcion
          + '</option>';
      });
      $("#presentacion").html($html);
      if (idpresentacion)
        $("#presentacion").val(idpresentacion);

    }
  });
}