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
        data: "Articulo",
      },
      {
        data: "Marca",
      },
      {
        data: "Modelo",
      },
      {
        data: "Serie",
      },
      {
        data: "PAT01",
      },
      {
        data: "PAT02",
      },
      {
        data: "Condicion",
      },
      {
        data: "Costo",
      },
      {
        data: "Almacen",
      },
      {
        data: "Estado",
      },
      {
        data: "Clasificacion",
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
        title: 'Artículos Asignados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'csv',
        title: 'Artículos Asignados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'excel',
        title: 'Artículos Asignados',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: 'print',
        title: 'Artículos Asignados',
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
      }]
    }
  });

  $("#formTable").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function (form, event) {
      var formData = $("#formTable").serialize(); $.ajax({
        type: 'POST',
        url: URI + 'inventario/articulos/asignados',
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
