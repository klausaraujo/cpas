$(document).ready(function () {

  $("#idCategoria").on("change", function () {
    $("#formCategoria").submit();
  });

  var tableDetalle = $('.tableDetalle').DataTable(
    {
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      data: [],
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      language: languageDatatable,
      autoWidth: true,
      columns: [
        { data: "idarticulo" },
        { data: "SIGA" },
        { data: "Articulo" },
        { data: "Categoria" },
        { data: "Lote" },
        { data: "Expira" },
        { data: "Stock" },
        { data: "Ubicacion" }
      ]
    }); $('body').on('click', '.product__stock', function () {
      const idArticulo = $(this).data("id");
      $.ajax({
        type: 'POST',
        url: URI + 'farmacia/main/obtenerStock',
        data: { idArticulo },
        dataType: 'json',
        success: function (response) {
          const { data: { lista } } = response;
          tableDetalle.clear();
          tableDetalle.rows.add(lista).draw();
          $("#tableDetalleModal").modal('show');
        }
      });
    })

  $('body').on('click', '.product__file', function () {
    const ruta = $(this).data("src");
    if (ruta)
      window.open(URI_MAP + 'public/farmacia/fichas/' + ruta);
  })

  $(".chip-close").on("click", function () {
    $("#idCategoria").val("");
    $("#formCategoria").submit();
  })

  var table = $('.tableArticulos').DataTable({
    dom: '<"html5buttons"B>g',
    oLanguage: {
      "sSearch": ""
    },
    "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "Todos"]],
    columns: [
      { "data": "IdArticulo" },
      { "data": "Articulo" },
      { "data": "Via" },
      { "data": "Presentacion" },
      { "data": "Categoria" },
      { "data": "Cantidad" },
      { "data": "Estado" },
      { "data": "imagen" },
    ],
    "order": [[0, "asc"]],
    buttons: [
      {
        extend: 'copy',
        title: 'Lista Logística de Farmacia',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'csv',
        title: 'Lista Logística de Farmacia',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'excel',
        title: 'Lista Logística de Farmacia',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },
      {
        extend: 'pdf',
        title: 'Lista Logística de Farmacia',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] },
      },

      {
        extend: 'print',
        title: 'Lista Logística de Farmacia',
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
      }
    ]

  });

  $('#buscarArticulo').on('keyup', function () {
    table.search(this.value).draw();
    filtrarArticulos(table, this.value)
  });
})
function filtrarArticulos(table, value) {
  const data = table.rows({ search: 'applied' }).data().toArray();
  let dataHtml = '';

  data.forEach(element => {

    const articuloHtml = `
      <div class="col-sm-6 col-md-3">
        <div class="iq-card">
          <div class="iq-card-body text-center">
              <div class="doc-profile">
                <img class="rounded-circle img-fluid avatar-80" src="${URI_MAP}public/farmacia/fotos/${element.imagen}" alt="picture">
              </div>
              <div class="iq-doc-info mt-3">
                <h4 class="principal__span">${element.Articulo}</h4>
                <p class="mb-0" >STOCK (${element.Cantidad})</p>
                <!-- <a href="javascript:void();">www.demo.com</a> -->
              </div>
              <div class="iq-doc-description mt-2">
                <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor non erat non gravida. In id ipsum consequat</p> -->
              </div>
              <a data-id="${element.IdArticulo}" class="btn btn-primary product__stock"><i class="fa fa-list"></i> Ver Detalle </a>
              ${element.ficha ? `
                <a data-src="${element.ficha}" class="btn product__file"><i class="fa fa-file-pdf-o"></i> Ficha</a>` : ''
      }
          </div>
        </div>
    </div>
    `;

    dataHtml += articuloHtml;
  });

  $("#listaStock").html(dataHtml)
}