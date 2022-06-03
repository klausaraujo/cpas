var data;
$(document).ready(function () {
  var table = $('#dt-select').DataTable({
    data: lista,
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
        data: "nombre"
      },
      {
        data: "domicilio",
      },
      {
        data: null,
        render: function (data, type, row, meta) {
          const { Region, Provincia, Distrito } = data;
          return `${Region}, ${Provincia}, ${Distrito}`
        }
      },
      {
        data: "nombre_encargado_titular",
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
        title: 'Lista General de Almacenes',
        exportOptions: { columns: [0, 1, 2, 3, 4] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Almacenes',
        exportOptions: { columns: [0, 1, 2, 3, 4] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Almacenes',
        exportOptions: { columns: [0, 1, 2, 3, 4] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Almacenes',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2, 3, 4] },
      },
      {
        extend: 'print',
        title: 'Lista General de Almacenes',
        exportOptions: { columns: [0, 1, 2, 3, 4] },
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

  $("#btnIpressUbicacion").on('click', function (event) {
    $("#mapModal").modal("show");
  });

  $('#mapModal').on('hidden.bs.modal', function () {
    $(document.body).addClass('modal-open');
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

  $(".btnMap").on("click", function () {
    const latitud = $("#latitud").val();
    const longitud = $("#longitud").val();
    if (latitud && longitud) {
      $("#ipressUbicacion").val(`${longitud} ${latitud}`)
    }
    $("#mapModal").modal('hide');
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
          $("#provinciamap").html('<option value="">Cargando...</option>');
          $("#distritomap").html('<option value="">--Elija Distrito--</option>');
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

  $("#datetimepicker").datetimepicker({
    format: "DD/MM/YYYY",
    maxDate: moment()
  });

  $("input[name=numeroDniTitular]").change(function(){
    $("#nombreTitular").val("");

	});
	$("#numeroDniSuplente").change(function(){
    $("#nombreSuplente").val("");

	});


  $("#btnBuscarTitular").on('click', function (event) {
    var documentNumber = $('#numeroDniTitular').val();
    searchPerson(documentNumber, '#nombreTitular', '#numeroDniTitular');
  });

  $("#btnBuscarSuplente").on('click', function (event) {
    var documentNumber = $('#numeroDniSuplente').val();
    searchPerson(documentNumber, '#nombreSuplente', '#numeroDniSuplente');
  });

  $(".btn-nuevo").on('click', function (event) {
    data = {};
    showModal(event, 'Registrar Nuevo Almacén');
  });

  $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();

    $('#nombre').val(data.nombre);
    $('#direccion').val(data.domicilio);
    $('#codigoUbigeo').val(data.ubigeo);
    if (data.ubigeo) {
      generateUbication(data.ubigeo)
    }
    $('#numeroDniTitular').val(data.dni_encargado_titular);
    $('#nombreTitular').val(data.nombre_encargado_titular);
    $('#telefonoTitular').val(data.fono_encargado_titular);
    $('#numeroDniSuplente').val(data.dni_encargado_suplente);
    $('#nombreSuplente').val(data.nombre_encargado_suplente);
    $('#telefonoSuplente').val(data.fono_encargado_suplente);
    if (data.coordenadas) {
      $('#ipressUbicacion').val(data.coordenadas);
    }
    $("#estado").prop("checked", data.estado === '1' ? true : false);
    showModal(event, 'Editar Almacén');
  }); 
  
  $("#formRegistrar").validate({
    rules: {
      nombre: { required: true, minlength: 2 },
      direccion: { required: true },
      codigoUbigeo: { required: true },
      numeroDniTitular: { required: true },
      nombreTitular: { required: true, minlength: 2 },
      telefonoTitular: { required: true },
      numeroDniSuplente: { required: true },
      nombreSuplente: { required: true, minlength: 2 },
      telefonoSuplente: { required: true },
      departamento: { required: true },
      provincia: { required: true },
      distrito: { required: true },
    },
    messages: {
      nombre: { required: "(*) Campo Requerido" },
      direccion: { required: "(*) Campo Requerido" },
      codigoUbigeo: { required: "(*) Campo Requerido" },
      numeroDniTitular: { required: "(*) Campo Requerido" },
      nombreTitular: { required: "(*) Campo Requerido" },
      telefonoTitular: { required: "(*) Campo Requerido" },
      numeroDniSuplente: { required: "(*) Campo Requerido" },
      nombreSuplente: { required: "(*) Campo Requerido" },
      telefonoSuplente: { required: "(*) Campo Requerido" },
      departamento: { required: "(*) Campo Requerido" },
      provincia: { required: "(*) Campo Requerido" },
      distrito: { required: "(*) Campo Requerido" },
    },
    submitHandler: function (form, event) {
      var formData = ($("#formRegistrar").serializeArray());
      var nombreTitular = $("#nombreTitular").val();
      var nombreSuplente = $("#nombreSuplente").val();
      var codigoUbigeo = $("#codigoUbigeo").val();
      var param = {
        id: data.idalmacen,
        nombreTitular,
        nombreSuplente,
        codigoUbigeo
      };
      formData.forEach((item, index) => {
        param[item.name] = item.value;
      });

      $.ajax({
        type: 'POST',
        url: URI + 'inventario/main/guardarAlmacen',
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

  $("#provincia")
    .change(
      function () {

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

  $('input#numeroDniTitular')
  .keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 8) {
      return false;
    }
  });

  $('input#numeroDniSuplente')
  .keypress(function (event) {
    if (event.which < 48 || event.which > 57 || this.value.length === 8) {
      return false;
    }
  });

});

function loadData(table) {
  $.ajax({
    type: 'POST',
    url: URI + 'inventario/main/obtenerAlmacenes',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaAlmacenes } } = response;
      table.clear();
      table.rows.add(listaAlmacenes).draw();
    }
  });
}

function searchPerson(documentNumber, inputName, inputDocnum) {
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
      const { data: { attributes: { nombres, apellido_paterno, apellido_materno, es_persona_viva, edad_anios } } } = data;

      if (es_persona_viva == true && edad_anios > 17)
      {
      $(inputName).val(nombres + ' ' + apellido_paterno + ' ' + apellido_materno);
      }
      
      else {$(inputDocnum).val("");}

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
function generateUbication(ubigeoCode) {
  const idDepartamento = ubigeoCode.slice(0, 2);
  const idProvincia = ubigeoCode.slice(2, 4);
  const idDistrito = ubigeoCode.slice(4, 6);
  let ubigeoDetail = '';
  $('#departamento').val(idDepartamento);

  $.ajax({
    data: {
      departamento: idDepartamento
    },
    url: URI + "eventos/main/cargarProvincias",
    method: "POST",
    dataType: "json",
    beforeSend: function () {
      $("#provincia").html('<option value="">Cargando...</option>');
      $("#distrito").html('<option value="">--Elija Provincia--</option>');
    },
    success: function (data) {
      let $html = '<option value="">--Seleccione--</option>';
      $.each(data.lista, function (i, e) {
        $html += `<option value="${e.Codigo_Provincia}" ${e.Codigo_Provincia == idProvincia ? 'selected' : ''}> ${e.Nombre} </option>`;
      });
      $("#provincia").html($html);

      $.ajax({
        data: {
          departamento: idDepartamento,
          provincia: idProvincia
        },
        url: URI + "eventos/main/cargarDistritos",
        method: "POST",
        dataType: "json",
        beforeSend: function () {
          $("#distrito").html('<option value="">Cargando...</option>');
        },
        success: function (data) {
          let $html = '<option value="">--Seleccione--</option>';
          $.each(data.lista, function (i, e) {
            $html += `<option value="${e.Codigo_Distrito}" ${e.Codigo_Distrito == idDistrito ? 'selected' : ''}> ${e.Nombre} </option>`;
          });
          $("#distrito").html($html);

          const departamentoDetail = $("#departamento option:selected").text();
          const provinciaDetail = $("#provincia option:selected").text();
          const distritoDetail = $("#distrito option:selected").text();

          $("#nombreUbigeo").val(`${departamentoDetail}, ${provinciaDetail}, ${distritoDetail}`)
        }
      });
    }
  });
}