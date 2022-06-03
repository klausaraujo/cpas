var data, table;
$(document).ready(function () {
  table = $('#dt-select').DataTable({
    data: lista,
    pageLength: 10,
    language: languageDatatable,
    autoWidth: true,
    lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
    columns: [
      {
        data: null,
        "render": function (data, type, row, meta) {
          return `<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
          <i class="fa fa-pencil-square-o"></i></button>`
        }
      },
      { data: "descripcion" },
      { data: "categoria" },
      { data: "administracion" },
      { data: "presentacion" },
      {
        data: "imagen",
        render: function (data, type, row, meta) {
          return data ? `<button class="btn btn-warning btn-circle actionImage" title="IMAGEN" type="button" style="margin-right: 5px;" >
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                  </button>` : ``
        }
      },
      {
        data: "ficha",
        render: function (data, type, row, meta) {
          return data ? `<button class="btn btn-primary btn-circle actionPdf" title="PDF" type="button" style="margin-right: 5px;" >
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </button>` : ``
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
    dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
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
        title: 'Lista General de Artículos',
        exportOptions: { columns: [1, 2, 3, 4, 7] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Artículos',
        exportOptions: { columns: [1, 2, 3, 4, 7] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Artículos',
        exportOptions: { columns: [1, 2, 3, 4, 7] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Artículos',
        orientation: 'landscape',
        exportOptions: { columns: [1, 2, 3, 4, 7] },
      },
      {
        extend: 'print',
        title: 'Lista General de Artículos',
        exportOptions: { columns: [1, 2, 3, 4, 7] },
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

  $("#file").change(function (event) {
    readURL(this);
  });

  $("#datetimepicker").datetimepicker({
    format: "DD/MM/YYYY",
    maxDate: moment()
  });

  $(".btn-nuevo").on('click', function (event) {
    $('#imagen').attr('src', '');
    data = {};
    $("#formRegistrar")[0].reset();
    showModal(event, 'Registrar Nuevo Artículo');
  });

  $('input#siga')
  .keypress(function (event) {
    if (event.which < 48 || event.which > 57) {
      return false;
    }
  });


});

$("#formRegistrar").validate({
  rules: {
    siga: { required: true },
    nombre: { required: true },
    categoria: { required: true },
    medida: { required: true },
    administracion: { required: true },
    presentacion: { required: true }
  },
  messages: {
    siga: { required: "(*) Campo Requerido" },
    nombre: { required: "(*) Campo Requerido" },
    categoria: { required: "(*) Campo Requerido" },
    medida: { required: "(*) Campo Requerido" },
    administracion: { required: "(*) Campo Requerido" },
    presentacion: { required: "(*) Campo Requerido" }
  },
  submitHandler: function (form, event) {
    var formData = new FormData(document.getElementById("formRegistrar"));
    formData.append("file", document.getElementById("file"));
    formData.append("ficha", document.getElementById("ficha"));

    $.ajax({
      type: 'POST',
      url: URI + 'farmacia/articulos/guardarArticulo',
      data: formData,
      method: "POST",
      dataType: "json",
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

$("#file").change(function (event) {
  readURL(this);
});

$("#ficha").change(function (event) {
  readURL(this, false);
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
$("#administracion").change(function () {
  var id = $(this).val();
  if (id.length > 0) {
    searchPresentation(id);
  }
});

$('body').on('click', 'td button.actionImage', function () {
  var tr = $(this).parents('tr');
  var row = table.row(tr);

  index = row.index();
  data = row.data();
  const { imagen } = data;
  const imageUrl = `${URI}public/farmacia/fotos/${imagen}`
  $('#imagepreview').attr('src', imageUrl);
  $('#imagemodal').modal('show');
});

$('body').on('click', 'td button.actionPdf', function () {
  var tr = $(this).parents('tr');
  var row = table.row(tr);

  index = row.index();
  data = row.data();
  const { ficha } = data;
  const ruta = `${URI}public/farmacia/fichas/${ficha}`;
  if (ruta)
    window.open(ruta);
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

$("body").on("click", ".actionEdit", function () {
  var tr = $(this).parents('tr');
  var row = table.row(tr);

  index = row.index();
  data = row.data();
  console.log(data);
  const { idarticulo, descripcion, idcategoria,
    idviaadministracion, idunidadmedida, imagen, idpresentacion, estado, codigo_siga, cantmin, cantmax, porcstock } = data;
  $('#idarticulo').val(idarticulo);
  $('#nombre').val(descripcion);
  $('#siga').val(codigo_siga);
  $('#categoria').val(idcategoria);
  $('#administracion').val(idviaadministracion);
  searchPresentation(idviaadministracion, idpresentacion);
  $('#medida').val(idunidadmedida);
  $('#cantmin').val(cantmin);
  $('#cantmax').val(cantmax);
  $('#porcstock').val(porcstock);
  $('#imagen').attr('src', URI + 'public/farmacia/fotos/' + imagen);
  $("#estado").prop("checked", estado === '1' ? true : false);
  $('.btn-buscar').attr("disabled", "disabled");
  showModal(event, 'Editar Artículo');
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    var filename = $("#file").val();
    filename = filename.substring(filename.lastIndexOf('\\') + 1);
    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
      $('#blah').hide();
      $('#blah').fadeIn(500);
      $('.custom-file-label').text(filename);
    }
    reader.readAsDataURL(input.files[0]);
  }
  $(".alert").removeClass("loading").hide();
}

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
function FadeInAlert(text) {
  $(".alert").show();
  $(".alert").text(text).addClass("loading");
}

function loadData(table) {
  $.ajax({
    type: 'POST',
    url: URI + 'farmacia/articulos/obtenerLista',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaArticulos } } = response;
      table.clear();
      table.rows.add(listaArticulos).draw();
    }
  });
}

function searchPerson(documentNumber, inputName) {
  $.ajax({
    url: URI + "brigadistas/curl",
    data: {
      type: '01',
      document: documentNumber
    },
    method: 'post',
    dataType: 'json',
    beforeSend: function () {
    },
    success: function (data) {
      const { data: { attributes: { nombres, apellido_paterno, apellido_materno } } } = data;
      $(inputName).val(nombres + ' ' + apellido_paterno + ' ' + apellido_materno);
    }
  });
}

function showModal(event, title) {
  $("#editarModal").modal("show");
  $("#editarModalLabel").text(title);
  event.stopPropagation();
  event.stopImmediatePropagation();
}