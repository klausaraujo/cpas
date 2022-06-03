$(document).ready(function () {
  let tablaPaciente;
  if (tablaPaciente)
    $('.tablaPaciente').dataTable().fnDestroy();
  let columns = [];
  for (const key in lista[0]) {
    if (!key.includes('ID'))
      columns = [...columns, { title: key, data: key }]
  }
  columnIndex = columns.map((item, index) => (index + 1));
  tablaPaciente = $('.tablaPaciente').DataTable(
    {
      pageLength: 10,
      responsive: true,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      data: lista,
      columns: [
        {
          data: "Estado",
          title: "Estado",
          render: function (data, type, row, meta) {
            return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
          }
        },
        ...columns
      ],
      columnDefs: [{
        "targets": columnIndex.filter(item => item > 14),
        "visible": false,
        "searchable": false
      }],
      dom: 'Bfrtip',
      retrieve: true,
      select: true,
      buttons: [{
        extend: 'copy',
        title: 'Lista General de Paciente',
        exportOptions: { columns: columnIndex },
      },
      {
        extend: 'csv',
        title: 'Lista General de Paciente',
        exportOptions: { columns: columnIndex },
      },
      {
        extend: 'excel',
        title: 'Lista General de Paciente',
        exportOptions: { columns: columnIndex },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Paciente',
        orientation: 'landscape',
        exportOptions: { columns: columnIndex },
      },

      {
        extend: 'print',
        title: 'Lista General de Paciente',
        exportOptions: { columns: columnIndex },
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

});
