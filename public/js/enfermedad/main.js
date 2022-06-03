function main(URI, LISTA_PAISES) {

  function replaceSpecial(palabra) {

    palabra = palabra.replace('ñ', 'n');
    palabra = palabra.replace('Ñ', 'n');
    palabra = palabra.replace('á', 'a');
    palabra = palabra.replace('á', 'i');
    palabra = palabra.replace('é', 'e');
    palabra = palabra.replace('É', 'e');
    palabra = palabra.replace('í', 'i');
    palabra = palabra.replace('Í', 'i');
    palabra = palabra.replace('ó', 'o');
    palabra = palabra.replace('Ó', 'o');
    palabra = palabra.replace('ú', 'u');
    palabra = palabra.replace('Ú', 'u');

    return palabra.toLowerCase();
  }

  $(document).ready(function () {
    let data;
    let tableEntidadesSalud, tableHistorial;
    let validate, updateValidate;

    var tablaexamenes = $('#tablaexamenes').DataTable(
      {
        pageLength: 20,
        lengthMenu: [],
        data: [],
        columns: [
          {
            data: null,
            render: function (data, type, row) {
              return `${data.descripcion}`;
            }
          },
          {
            data: null,
            render: function (data, type, row, meta) {
              return `<input id="dia1-${meta.row}" type="input" name="ex${data.id_examen}[]" value="${data.dia_1 || 0}">`;
            }
          },
          {
            data: null,
            render: function (data, type, row, meta) {
              return `<input id="dia2-${meta.row}" type="input" name="ex${data.id_examen}[]" value="${data.dia_2 || 0}">`;
            }
          },
          {
            data: null,
            render: function (data, type, row, meta) {
              return `<input id="dia3-${meta.row}" type="input" name="ex${data.id_examen}[]" value="${data.dia_3 || 0}">`;
            }
          },
          {
            data: null,
            render: function (data, type, row, meta) {
              return `<input id="dia5-${meta.row}" type="input" name="ex${data.id_examen}[]" value="${data.dia_5 || 0}">`;
            }
          },
          {
            data: null,
            render: function (data, type, row, meta) {
              return `<input id="dia7-${meta.row}" type="input" name="ex${data.id_examen}[]" value="${data.dia_7 || 0}">`;
            }
          },
        ],
        columnDefs: [{ orderable: false, targets: '_all' }],
        dom: 'rt',
        ordering: false
      });

    const validateRules = {
      rules: {
        "renipress": { required: true },
        "institucion": { required: true },
        "nombreSalud": { required: true },
        "tipoSalud": { required: true },
        "clasificacionSalud": { required: true },
        "regionSalud": { required: true },
        "tipoDocumento": { required: true },
        "numeroDocumento": { required: true },
        "apellido": { required: true },
        "nombre": { required: true },
        "sexo": { required: true },
        "fechaNacimiento": { required: true },
        "edad": { required: true },
        "domicilio": { required: true },
      },
      messages: {
        "renipress": { required: "(*) Campo Requerido" },
        "institucion": { required: "(*) Campo Requerido" },
        "nombreSalud": { required: "(*) Campo Requerido" },
        "tipoSalud": { required: "(*) Campo Requerido" },
        "clasificacionSalud": { required: "(*) Campo Requerido" },
        "regionSalud": { required: "(*) Campo Requerido" },
        "tipoDocumento": { required: "(*) Campo Requerido" },
        "numeroDocumento": { required: "(*) Campo Requerido" },
        "apellido": { required: "(*) Campo Requerido" },
        "nombre": { required: "(*) Campo Requerido" },
        "sexo": { required: "(*) Campo Requerido" },
        "fechaNacimiento": { required: "(*) Campo Requerido" },
        "edad": { required: "(*) Campo Requerido" },
        "domicilio": { required: "(*) Campo Requerido" },
        "pa1": "Solo valores enteros",
        "pa2": "Solo valores enteros",
        "fc": "Solo valores enteros",
        "fr": "Solo valores enteros",
        "so2": "Solo valores enteros",
        "fios2": "Solo valores enteros",
        "tiempoEnfermedad": "Solor valores enteros"
      }
    }

    obtenerGrafica(grafico, graficoSexo, graficoCritico)

    let table = $('.tablaPaciente').DataTable({
      pageLength: 5,
      lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
      data: lista,
      dom: '<"html5buttons"B>lTfgitp',
      columns: [
        {
          data: null,
          render: function (data, type, row) {
            const btnEdit = `
          <button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button" style="margin-right: 5px;">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>`;
            const btnDelete = `
          <button class="btn btn-primary btn-circle actionDelete" title="ELIMINAR" type="button">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>`;
            return `<div style="display: flex">
                    ${canEdit ? btnEdit : ''} 
                    ${canDelete ? btnDelete : ''}
                  </div>`;
          }
        },
        {
          data: "Paciente"
        },
        {
          data: "Sexo"
        },
        {
          data: "Edad",
        },
        {
          data: "Ingreso_Hospital"
        },
        {
          data: "Ingreso_UCI"
        },

        {
          data: "Estado",
          render: function (data, type, row, meta) {
            return `<span class="badge ${data === 'Activo' ? 'badge-info' : 'badge-default'}">${data}</span>`
          }
        },
      ],
      order: [],
      columnDefs: [],
      dom: 'Bfrtip',
      select: true,
      buttons: [{
        extend: 'copy',
        title: 'Lista General de Pacientes',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Pacientes',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Pacientes',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Pacientes',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
      },

      {
        extend: 'print',
        title: 'Lista General de Pacientes',
        exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6] },
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

    $("#btnPacientes").on('click', function (event) {
      $.ajax({
        type: "POST",
        url: URI + "enfermedad/main/listaexamenesnew",
        data: {},
        dataType: "json",
        beforeSend: function () {
          $("#modalCargaGeneral").css("display", "block");
        },
        success: function (data) {
          $("#modalCargaGeneral").css("display", "none");

          $("#recomendacionesModal").modal("show");
          var html = "";
          var count = 0;

          tablaexamenes.clear();
          tablaexamenes.rows.add(data.listaexamenesnew).draw();
        }
      });

    });

    $("#fechaNacimientoPicker").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fechaingresohospPicker").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fechaingresouciPicker").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#pcr_rt_coronavirus_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#pcr_pt_influenza_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#primer_cultivo_secresion_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#filmarray_respiratorio_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#prueba_rapida_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#hemocultivo_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#otros_cultivos_fecha").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_intubacion").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_ingreso_vm").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_primer_dia_prona").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_extubacion").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_traqueostomia").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_egreso_vm").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    });

    $("#fecha_alta_uci").datetimepicker({
      format: "DD/MM/YYYY",
      maxDate: moment(),
    }); $('body').on('click', 'td .actionActualizar', function () {

      var data = table.row($(this).parents('tr')).data();
      const { ID, Paciente } = data;
      $("#nombrePaciente").val(Paciente);
      $("#idpaciente").val(ID)
      $("#actualizarPacienteModal").modal('show');
    });

    $('body').on('click', 'td .actionEdit', function () {

      var data = table.row($(this).parents('tr')).data();

      $.ajax({
        type: 'POST',
        url: URI + 'enfermedad/main/listaexamenes_edit',
        data: { idpaciente: data.id_paciente },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
          const { status } = response;
          if (status === 200) {
            initEdit(data, response.data, tablaexamenes);
            $('.alert-success').fadeIn(1000);
          } else {
            $('.alert-danger').fadeIn(1000);
          }
        }
      }); $("#modalFullscreen").modal('show');
    });

    $('body').on('click', 'td .actionDelete', function () {
      var data = table.row($(this).parents('tr')).data();
      $.ajax({
        type: 'POST',
        url: URI + 'enfermedad/main/eliminarPaciente',
        data: { idpaciente: data.id_paciente },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
          const { status } = response;
          if (status === 200) {
            $('.alert-success').fadeIn(1000);
          } else {
            $('.alert-danger').fadeIn(1000);
          }
          setTimeout(() => {
            $('.alert').fadeOut(1000);
            location.reload();
          }, 1000);
        }
      });
    });

    $('body').on('click', 'td .actionEliminarHistorial', function () {
      var data = tableHistorial.row($(this).parents('tr')).data();
      const { id_historial: idhistorial, id_paciente: idpaciente } = data;

      $.ajax({
        type: 'POST',
        url: URI + 'enfermedad/main/eliminarHistorialPaciente',
        data: { idhistorial, idpaciente },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (response) {
          $("#tableHistorialModal").modal('hide');
          const { status } = response;
          if (status === 200) {
            $("#formRegistrar")[0].reset();
            $('.btn-editar').removeClass('active');
            $('.alert-success').fadeIn(1000);
          } else {
            $('.alert-danger').fadeIn(1000);
          }
          setTimeout(() => {
            $('.alert').fadeOut(1000);
            location.reload();
          }, 1000);
        }
      });
    });

    $('body').on('click', 'td .actionHistorial', function () {
      var data = table.row($(this).parents('tr')).data();
      const { ID, Paciente } = data;

      $.ajax({
        url: URI + "enfermedad/main/obtenerHistorialPaciente",
        data: { idpaciente: ID },
        method: 'post',
        dataType: 'json',
        error: function (xhr) {
        },
        beforeSend: function () {
        },
        success: function (data) {
          const { lista = [{}] } = data;
          if (tableHistorial) {
            tableHistorial.clear().destroy();
          }
          let columns = [];
          for (const key in lista[0]) {
            if (!key.includes('id'))
              columns = [...columns, { title: key, data: key }]
          }
          columnIndex = columns.map((item, index) => (index + 1));
          tableHistorial = $('.tableHistorial').DataTable(
            {
              pageLength: 5,
              responsive: true,
              lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
              data: lista,
              columns: [
                {
                  title: 'Eliminar',
                  data: null,
                  render: function (data, type, row) {
                    return `<button class="btn btn-danger btn-circle actionEliminarHistorial" title="ELIMINAR" type="button">
                  <i class="fa fa-trash" aria-hidden="true"></i>
                </button>`;
                  }
                },
                ...columns
              ],
              columnDefs: [],
              dom: 'Bfrtip',
              retrieve: true,
              select: true,
              buttons: [{
                extend: 'copy',
                title: 'Lista General de Historial',
                exportOptions: { columns: columnIndex },
              },
              {
                extend: 'csv',
                title: 'Lista General de Historial',
                exportOptions: { columns: columnIndex },
              },
              {
                extend: 'excel',
                title: 'Lista General de Historial',
                exportOptions: { columns: columnIndex },
              },
              {
                extend: 'pdf',
                title: 'Lista General de Historial',
                orientation: 'landscape',
                exportOptions: { columns: columnIndex },
              },

              {
                extend: 'print',
                title: 'Lista General de Historial',
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

          $("#historialPaciente").val(Paciente);
          $("#tableHistorialModal").modal('show');
        }
      });

    });

    $("#btnBuscarPaciente").on("click", function () {
      var documento_numero = $("input[name=numeroDocumento]").val();
      if (documento_numero.length >= 8) {
        var type = "01";
        if (documento_numero.length > 8) {
          type = "03";
        }
        $.ajax({
          url: URI + "enfermedad/main/curl",
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

            var fecha = (data.data.attributes.fecha_nacimiento).split("-");
            $("input[name=fechaNacimiento]").val(fecha[2] + "/" + fecha[1] + "/" + fecha[0]);
            $("input[name=edad]").val(data.data.attributes.edad_anios);
            $("select[name=sexo]").val(data.data.attributes.sexo);
            $("select[name=sexo]").attr("rel", data.data.attributes.sexo);
            $("input[name=apellido]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
            $("input[name=nombre]").val(data.data.attributes.nombres);
            $("input[name=domicilio]").val(data.data.attributes.domicilio_direccion);
            if (data.data.attributes.sexo !== "2") {
              $('#gestante').prop('checked', false);
              $("#tieneGestacion").hide();
            }
            else
              $("#tieneGestacion").show();

            validate.resetForm();
          }
        });

      }

    });

    $("#btnPacientes").on('click', function (event) {

      $("#modalFullscreen").modal('show');
    });

    validate = $("#formRegistrar").validate({

      submitHandler: function (form, event) {
        var myform = $('#formRegistrar');

        var formData = myform.serializeArray();

        $.ajax({
          type: 'POST',
          url: URI + 'enfermedad/main/guardarPaciente',
          data: formData,
          dataType: 'json',
          beforeSend: function () {

          },
          success: function (response) {
            $("#modalFullscreen").modal('hide');
            const { status } = response;
            if (status === 200) {
              $("#formRegistrar")[0].reset();
              $('.btn-editar').removeClass('active');
              $('.alert-success').fadeIn(1000);
            } else {
              $('.alert-danger').fadeIn(1000);
            }
            setTimeout(() => {
              $('.alert').fadeOut(1000);
              location.reload();
            }, 1000);
          }
        });
      }
    });

    $("input[name=cod_pais]").on("keyup", function () {

      var match = $(this).val();

      $("#paises").html("");
      if (match.length < 3) {
        $("#paises").html("");
        $("#paises").css("display", "none");
      } else {
        var lista = LISTA_PAISES;

        var filtrado = lista.filter(data => replaceSpecial(data.name).match(replaceSpecial(match)));

        if (filtrado.length > 0) {
          var html = '<ul>';
          $("#paises").css("display", "block");
          $.each(filtrado, function (i, e) {
            html += '<li class="select-country" rel="' + e.id + '">' + e.name + '</li>';
          });
          html += '</ul>';
          $("#paises").html(html);
        } else {
          $("#paises").css("display", "none");
        }

      }
    });

    $("body").on("click", ".select-country", function () {

      var attr = $(this).attr("rel");
      var value = $(this).html();

      $("input[name=id_pais]").val(attr);
      $("input[name=cod_pais]").val(value);
      $("#paises").html("");
      $("#paises").css("display", "none");

    });

    updateValidate = $("#formActualizarPaciente").validate({
      submitHandler: function (form, event) {
        var myform = $('#formActualizarPaciente');
        var formData = myform.serialize();
        $.ajax({
          type: 'POST',
          url: URI + 'enfermedad/main/actualizarEstadoPaciente',
          data: formData,
          dataType: 'json',
          beforeSend: function () {

          },
          success: function (response) {
            $("#actualizarPacienteModal").modal('hide');
            const { status } = response;
            if (status === 200) {
              $("#formActualizarPaciente")[0].reset();
              $('.alert-success').fadeIn(1000);
            } else {
              $('.alert-danger').fadeIn(1000);
            }
            setTimeout(() => {
              $('.alert').fadeOut(1000);
              location.reload();
            }, 1000);
          }
        });
      }
    }); $('body').on('click', '#dt-select tr', function () {
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

    $('.tableEntidadesSalud tbody').on('click', 'tr', function () {
      var tr = $(this);
      var row = tableEntidadesSalud.row(tr);
      index = row.index();
      data = row.data();

      if (data) {
        const { institucion, codigo_renipress, nombre, clasificacion, tipo, region, id_renipress } = data;
        $('#renipress').val(codigo_renipress);
        $('#institucion').val(institucion);
        $('#nombreSalud').val(nombre);
        $('#regionSalud').val(region);
        $('#clasificacionSalud').val(clasificacion);
        $('#tipoSalud').val(tipo);
        $('#idrenipress').val(id_renipress);
        $("#tableEntidadesSaludModal").modal('hide');
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

    $('#tableEnfermedadesModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
      updateValidate.resetForm();
    });

    $('#modalFullscreen').on('hidden.bs.modal', function () {
      $("#formRegistrar")[0].reset();
    });

    $('#sexo').change(function () {
      if (this.value !== "2") {
        $('#gestante').prop('checked', false);
        $("#tieneGestacion").hide();
      }
      else
        $("#tieneGestacion").show();
    });
    $('#tipoDocumento').change(function () {
      if (this.value === '06') {
        $('#apellido').prop('readonly', false);
        $('#nombre').prop('readonly', false);
        $('#sexo').prop('readonly', false);
        $('#fechaNacimiento').prop('readonly', false);
        $('#edad').prop('readonly', false);
        $('#domicilio').prop('readonly', false);
      } else {
        $('#apellido').prop('readonly', false);
        $('#nombre').prop('readonly', false);
        $('#sexo').prop('readonly', false);
        $('#fechaNacimiento').prop('readonly', false);
        $('#edad').prop('readonly', false);
        $('#domicilio').prop('readonly', false);
      }
    });
    $('#otrosAntecedentes').change(function () {
      if (this.checked) {
        $('#otrosAntecedentesDetalle').prop("readonly", false);
      } else {
        $('#otrosAntecedentesDetalle').val('');
        $('#otrosAntecedentesDetalle').prop("readonly", true);
      }
    });
    $('#otrosSintomas').change(function () {
      if (this.checked) {
        $('#otrosSintomasDetalle').prop("readonly", false);
      } else {
        $('#otrosSintomasDetalle').val('');
        $('#otrosSintomasDetalle').prop("readonly", true);
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
        columns: [{
          "data": "codigo_renipress"
        }, {
          "data": "nombre"
        }, {
          "data": "clasificacion"
        }],
        data: []
      });

    $("#btnFiltrarUbigeo").on('click', function (event) {
      $.ajax({
        type: 'POST',
        url: URI + 'enfermedad/main/obtenerRenipress',
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

    var tableEnfermedades = $('.tableEnfermedades').DataTable({
      "pageLength": 7,
      "bLengthChange": false,
      "info": false,
      "ajax": {
        url: URI + "public/js/eventos/enfermedades.txt",
        method: "POST"
      }
    });

    $(".search-cie").on("click", function () {
      var attr = $(this).attr("rel");
      $("input[name=cie10-number]").val(attr);
      $("#tableEnfermedadesModal").modal("show");

    });

    $(".clear-cie").on("click", function () {
      var attr = $(this).attr("rel");

      switch (parseInt(attr)) {
        case 1: { $("input[name=cie10_1_codigo]").val(""); $("input[name=cie10_1_texto]").val(""); } break;
        case 2: { $("input[name=cie10_2_codigo]").val(""); $("input[name=cie10_2_texto]").val(""); } break;
        case 3: { $("input[name=cie10_3_codigo]").val(""); $("input[name=cie10_3_texto]").val(""); } break;
      }

    });

    $('.tableEnfermedades tbody').on('click', 'tr', function () {
      var data = tableEnfermedades.row(this).data();

      var cie = $("input[name=cie10-number]").val();
      switch (parseInt(cie)) {
        case 1: { $("input[name=cie10_1_codigo]").val(data[0]); $("input[name=cie10_1_texto]").val(data[1]); } break;
        case 2: { $("input[name=cie10_2_codigo]").val(data[0]); $("input[name=cie10_2_texto]").val(data[1]); } break;
        case 3: { $("input[name=cie10_3_codigo]").val(data[0]); $("input[name=cie10_3_texto]").val(data[1]); } break;
      }

      $('#tableEnfermedadesModal').modal('hide');
    });
  });

  function showModal(event, title) {
    $("#tableEntidadesSaludModal").modal("show");
    event.stopPropagation();
    event.stopImmediatePropagation();
  }

  function obtenerGrafica(grafico = [], graficoSexo = {}, graficoCritico = {}) {
    try {
      var dom = document.getElementById("containerLeft");
      var domEjecucion = document.getElementById("containerRight");
      var domGender = document.getElementById("containerGenderLeft");
      var domStatus = document.getElementById("containerStatusRight");
      var myChartLeft = echarts.init(dom);
      var myChartRight = echarts.init(domEjecucion);
      var myChartGender = echarts.init(domGender);
      var myChartStatus = echarts.init(domStatus);
      let { data, serieData, series } = loadGraphicData(grafico);

      const optionLeft = {
        title: {
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          data: Object.keys(serieData)
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: {
          type: 'category',
          boundaryGap: false,
          data
        },
        yAxis: {
          type: 'value'
        },
        series
      };

      const optionRight = {
        tooltip: {
          trigger: 'axis',
          axisPointer: {
            type: 'shadow'
          }
        },
        legend: {
          data: Object.keys(serieData)
        },
        grid: {
          left: '3%',
          right: '4%',
          bottom: '3%',
          containLabel: true
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: [
          {
            type: 'category',
            data
          }
        ],
        yAxis: [
          {
            type: 'value'
          }
        ],
        series: series.map(item => ({ ...item, type: 'bar' }))
      };

      const optionGender = {
        title: {
        },
        tooltip: {
          trigger: 'item',
          formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        legend: {
          orient: 'vertical',
          left: 'left',
          data: Object.keys(graficoSexo)
        },
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        series: [
          {
            name: 'Positivo(a)',
            type: 'pie',
            radius: '55%',
            center: ['50%', '60%'],
            data: Object.keys(graficoSexo).map(item => ({ name: item, value: graficoSexo[item] })),
            emphasis: {
              itemStyle: {
                shadowBlur: 10,
                shadowOffsetX: 0,
                shadowColor: 'rgba(0, 0, 0, 0.5)'
              }
            },
            label: {
              normal: {
                formatter: '{c}',
                position: 'inside'
              }
            },
          }
        ]
      };

      const optionStatus = {
        toolbox: {
          feature: {
            saveAsImage: {}
          }
        },
        xAxis: {
          type: 'category',
          data: Object.keys(graficoCritico).map(item => item.replace(/_/g, " \n ")),
          silent: false,
          splitLine: {
            show: true
          },
          splitArea: {
            show: true
          },
        },
        yAxis: {
          type: 'value'
        },
        series: [{
          data: Object.values(graficoCritico),
          type: 'bar',
          showBackground: true,
          backgroundStyle: {
            color: 'rgba(25, 118, 210, 1)'
          }
        }]
      }; if (optionLeft && typeof optionLeft === "object") {
        myChartLeft.setOption(optionLeft, true);
        myChartRight.setOption(optionRight, true);
        myChartGender.setOption(optionGender, true);
        myChartStatus.setOption(optionStatus, true);
      }
    } catch (error) {
      console.log(error)
    }
  }

  function loadGraphicData(grafico) {
    let data = [], serieData = {}, series = [];
    grafico.forEach((item) => {
      const name = `${item.Fecha}`
      data = [...data, name];
      delete item.Fecha;
      for (const key in item) {
        serieData[key] = [...(serieData[key] || []), item[key]];
      }
    })

    for (const key in serieData) {
      series = [...series, {
        name: key,
        type: 'line',
        data: serieData[key]
      }];
    }

    return { data, serieData, series };
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

  function initEdit(data, examenes, tablaexamenes) {
    const { id_paciente, id_renipress: idrenipress, codigo_renipress: renipress, id_documento: tipoDocumento,
      numero_documento: numeroDocumento, apellidos: apellido, nombres: nombre, sexo: sexo, gestante, nacimiento: fechaNacimiento,
      Edad: edad, domicilio, numero_historia: numero_historia, ingreso_hospital: ingreso_hospital, ingreso_uci: ingreso_uci,
      idpais: idpais, pais: pais, Telef_Tabla: Telef_Tabla, talla: talla, peso_ideal_vm: peso_ideal_vm, peso_actual: peso_actual, imc: imc,
      apache: apache, sofa: sofa, tiempo_emfermedad: tiempo_emfermedad, institucion, nombre: nombreSalud, tipo: tipoSalud, clasificacion: clasificacionSalud, region: regionSalud,

      hta: hta,
      otras_enf_pulmonares: otras_enf_pulmonares,
      cancer: cancer,
      diabetes_mellitus: diabetes_mellitus,
      asma: asma,
      acv_previo: acv_previo,
      epoc_bronquiectasias: epoc_bronquiectasias,
      falla_cardiaca: falla_cardiaca,
      fumador_cronico: fumador_cronico,
      epid_fibrosis_pulmonar: epid_fibrosis_pulmonar,
      enf_renal_cronica: enf_renal_cronica,
      vih: vih,
      viajes_pervios: viajes_pervios,
      contacto_personas_covid: contacto_personas_covid,
      contacto_extranjeros: contacto_extranjeros,
      personal_salud: personal_salud,
      rinorrea: rinorrea,
      tos_con_flema: tos_con_flema,
      disnea: disnea,
      fiebre: fiebre,
      fatiga: fatiga,
      escalofrios: escalofrios,
      cefalea: cefalea,
      hemoptisis: hemoptisis,
      diarrea: diarrea,
      tos_seca: tos_seca,
      mialgia_artralgia: mialgia_artralgia,
      dolor_de_garganta: dolor_de_garganta,
      pcr_rt_coronavirus: pcr_rt_coronavirus,
      pcr_pt_influenza: pcr_pt_influenza,
      primer_cultivo_secresion: primer_cultivo_secresion,
      filmarray_respiratorio: filmarray_respiratorio,
      perdida_gusto: perdida_gusto,
      perdida_olfato: perdida_olfato,
      hemocultivo: hemocultivo,
      prueba_rapida: prueba_rapida,
      prueba_rapida_igg: prueba_rapida_igg,
      prueba_rapida_igm: prueba_rapida_igm, otros_cultivos: otros_cultivos,
      falla_cardiovascular: falla_cardiovascular,
      falla_respiratorio: falla_respiratorio,
      falla_renal: falla_renal,
      falla_hepatico: falla_hepatico,
      falla_neurologico: falla_neurologico,
      falla_coagulacion: falla_coagulacion,
      utilizacion_vmni: utilizacion_vmni,
      utilizacion_canula: utilizacion_canula,
      uso_titular_peep: uso_titular_peep,
      pv_tools: pv_tools,
      open_lung_tools: open_lung_tools,
      peep_in_view: peep_in_view,
      reclutamiento_alveolar: reclutamiento_alveolar,
      hidroxicloroquina: hidroxicloroquina,
      condicion_vivo: condicion_vivo,
      condicion_fallecido: condicion_fallecido,
      procedencia_viajes: procedencia_viajes,
      procedencia_extranjeros: procedencia_extranjeros,
      disnea_dias: disnea_dias,
      fiebre_t_max: fiebre_t_max,
      hb: hb,
      ldh: ldh,
      procalcitonina: procalcitonina,
      leucocitos: leucocitos,
      tgo: tgo,
      dimero_d: dimero_d,
      linfocitos: linfocitos,
      cpk: cpk,
      plaquetas: plaquetas,
      bt: bt,
      cpk_mb: cpk_mb,
      creatinina: creatinina,
      pcr: pcr,
      troponina_t: troponina_t,
      troponina_i: troponina_i,
      pcr_rt_coronavirus_resultado: pcr_rt_coronavirus_resultado,
      pcr_pt_influenza_resultado: pcr_pt_influenza_resultado,
      primer_cultivo_secresion_resultado: primer_cultivo_secresion_resultado,
      filmarray_respiratorio_resultado: filmarray_respiratorio_resultado,
      hemocultivo_resultado: hemocultivo_resultado,
      destino: destino,
      otros_cultivos_resultado: otros_cultivos_resultado,
      ingreso_hospital_pa: ingreso_hospital_pa,
      ingreso_hospital_pam: ingreso_hospital_pam,
      ingreso_hospital_fr: ingreso_hospital_fr,
      ingreso_hospital_fc: ingreso_hospital_fc,
      ingreso_hospital_t: ingreso_hospital_t,
      ingreso_hospital_sat02: ingreso_hospital_sat02,
      ingreso_hospital_fio2: ingreso_hospital_fio2,
      ingreso_hospital_pa02_fio02: ingreso_hospital_pa02_fio02,
      ingreso_hospital_glasgow: ingreso_hospital_glasgow,
      ingreso_uci_pa: ingreso_uci_pa,
      ingreso_uci_pam: ingreso_uci_pam,
      ingreso_uci_fr: ingreso_uci_fr,
      ingreso_uci_fc: ingreso_uci_fc,
      ingreso_uci_t: ingreso_uci_t,
      ingreso_uci_sat02: ingreso_uci_sat02,
      ingreso_uci_fio2: ingreso_uci_fio2,
      ingreso_uci_pa02_fio02: ingreso_uci_pa02_fio02,
      ingreso_uci_glasgow: ingreso_uci_glasgow,
      utilizacion_vmni_horas: utilizacion_vmni_horas,
      utilizacion_canula_horas: utilizacion_canula_horas,
      dx_ards: dx_ards,
      esquema_prona_supina_horas01: esquema_prona_supina_horas01,
      esquema_prona_supina_horas02: esquema_prona_supina_horas02,
      otras: otras,
      peep_maximo: peep_maximo,
      po2_fio2_prepona: po2_fio2_prepona,
      pco2preprona: pco2preprona,
      po2_fio2_prona_4_horas: po2_fio2_prona_4_horas,
      po2_prona_4_horas: po2_prona_4_horas,
      po2_fio2_supino_4_horas: po2_fio2_supino_4_horas,
      pco2_supono_4_horas: pco2_supono_4_horas,
      pam: pam,
      gc: gc,
      ic: ic,
      pvc: pvc,
      ccs: ccs,
      vpp: vpp,
      sat02_venosa_central: sat02_venosa_central,
      lactato: lactato,
      vasopresor_inotropico: vasopresor_inotropico,
      hemodinamia_fevi: hemodinamia_fevi,
      hemodinamia_ic: hemodinamia_ic,
      hemodinamia_vci: hemodinamia_vci,
      hemodinamia_otros_hallazgos: hemodinamia_otros_hallazgos,
      hemodinamia_sedacion: hemodinamia_sedacion,
      hemodinamia_analgesia: hemodinamia_analgesia,
      hemodinamia_relajante: hemodinamia_relajante,
      hemodinamia_antibiotico: hemodinamia_antibiotico,
      hemodinamia_antiviral: hemodinamia_antiviral,
      hidroxicloroquina_dosis: hidroxicloroquina_dosis,
      descripcion_rx_torax: descripcion_rx_torax,

      pcr_rt_coronavirus_fecha_: pcr_rt_coronavirus_fecha_,
      pcr_pt_influenza_fecha_: pcr_pt_influenza_fecha_,
      primer_cultivo_secresion_fecha_: primer_cultivo_secresion_fecha_,
      filmarray_respiratorio_fecha_: filmarray_respiratorio_fecha_,

      prueba_rapida_fecha_: prueba_rapida_fecha_,
      hemocultivo_fecha_: hemocultivo_fecha_,

      otros_cultivos_fecha_: otros_cultivos_fecha_,
      fecha_intubacion_: fecha_intubacion_,
      fecha_ingreso_vm_: fecha_ingreso_vm_,
      fecha_primer_dia_prona_: fecha_primer_dia_prona_,
      fecha_extubacion_: fecha_extubacion_,
      fecha_traqueostomia_: fecha_traqueostomia_,
      fecha_egreso_vm_: fecha_egreso_vm_,
      fecha_alta_uci_: fecha_alta_uci_ } = data; tablaexamenes.clear();
    tablaexamenes.rows.add(examenes.listaexamenes_edit || []).draw();

    console.log(data);
    $('#id').val(id_paciente);
    $('#id_pais').val(idpais);
    $('#idrenipress').val(idrenipress);
    $('#renipress').val(renipress);
    $('#tipoDocumento').val(`0${tipoDocumento}`);
    $('#numeroDocumento').val(numeroDocumento);
    $('#apellido').val(apellido);
    $('#nombre').val(nombre);
    $('#sexo').val(sexo);
    if (gestante) {
      $("#tieneGestacion").show();
      $('#gestante').prop('checked', true);
    }
    else {
      $("#tieneGestacion").hide();
      $('#gestante').prop('checked', false);
    }
    $('#gestante').val(gestante);
    $('#fechaNacimiento').val(toFormatHour(fechaNacimiento));
    $('#edad').val(edad);
    $('#domicilio').val(domicilio);
    $('#institucion').val(institucion);
    $('#nombreSalud').val(nombreSalud);
    $('#tipoSalud').val(tipoSalud);
    $('#clasificacionSalud').val(clasificacionSalud);
    $('#regionSalud').val(regionSalud);
    $('#numero_historia').val(numero_historia);
    $('#ingreso_hospital').val(toFormatHour(ingreso_hospital));
    $('#ingreso_uci').val(toFormatHour(ingreso_uci));
    $('#cod_pais').val(pais);
    $('#telefono').val(Telef_Tabla);
    $('#talla').val(talla);
    $('#peso_ideal_vm').val(peso_ideal_vm);
    $('#peso_actual').val(peso_actual);
    $('#imc').val(imc);
    $('#apache').val(apache);
    $('#sofa').val(sofa);
    $('#tiempo_enfermedad').val(tiempo_emfermedad);

    $('#hta').prop('checked', hta === '1' ? true : false);
    $('#otras_enf_pulmonares').prop('checked', otras_enf_pulmonares === '1' ? true : false);
    $('#cancer').prop('checked', cancer === '1' ? true : false);
    $('#diabetes_mellitus').prop('checked', diabetes_mellitus === '1' ? true : false);
    $('#asma').prop('checked', asma === '1' ? true : false);
    $('#acv_previo').prop('checked', acv_previo === '1' ? true : false);
    $('#epoc_bronquiectasias').prop('checked', epoc_bronquiectasias === '1' ? true : false);
    $('#falla_cardiaca').prop('checked', falla_cardiaca === '1' ? true : false);
    $('#fumador_cronico').prop('checked', fumador_cronico === '1' ? true : false);
    $('#epid_fibrosis_pulmonar').prop('checked', epid_fibrosis_pulmonar === '1' ? true : false);
    $('#enf_renal_cronica').prop('checked', enf_renal_cronica === '1' ? true : false);
    $('#vih').prop('checked', vih === '1' ? true : false);
    $('#viajes_pervios').prop('checked', viajes_pervios === '1' ? true : false);
    $('#contacto_personas_covid').prop('checked', contacto_personas_covid === '1' ? true : false);
    $('#contacto_extranjeros').prop('checked', contacto_extranjeros === '1' ? true : false);
    $('#personal_salud').prop('checked', personal_salud === '1' ? true : false);
    $('#rinorrea').prop('checked', rinorrea === '1' ? true : false);
    $('#tos_con_flema').prop('checked', tos_con_flema === '1' ? true : false);
    $('#disnea').prop('checked', disnea === '1' ? true : false);
    $('#fiebre').prop('checked', fiebre === '1' ? true : false);
    $('#fatiga').prop('checked', fatiga === '1' ? true : false);
    $('#escalofrios').prop('checked', escalofrios === '1' ? true : false);
    $('#cefalea').prop('checked', cefalea === '1' ? true : false);
    $('#hemoptisis').prop('checked', hemoptisis === '1' ? true : false);
    $('#diarrea').prop('checked', diarrea === '1' ? true : false);
    $('#tos_seca').prop('checked', tos_seca === '1' ? true : false);
    $('#mialgia_artralgia').prop('checked', mialgia_artralgia === '1' ? true : false);
    $('#dolor_de_garganta').prop('checked', dolor_de_garganta === '1' ? true : false);
    $('#pcr_rt_coronavirus').prop('checked', pcr_rt_coronavirus === '1' ? true : false);
    $('#pcr_pt_influenza').prop('checked', pcr_pt_influenza === '1' ? true : false);
    $('#primer_cultivo_secresion').prop('checked', primer_cultivo_secresion === '1' ? true : false);
    $('#filmarray_respiratorio').prop('checked', filmarray_respiratorio === '1' ? true : false);
    $('#perdida_gusto').prop('checked', perdida_gusto === '1' ? true : false);
    $('#perdida_olfato').prop('checked', perdida_olfato === '1' ? true : false);
    $('#hemocultivo').prop('checked', hemocultivo === '1' ? true : false); $('#prueba_rapida').prop('checked', prueba_rapida === '1' ? true : false);
    $('#prueba_rapida_igg').prop('checked', prueba_rapida_igg === '1' ? true : false);
    $('#prueba_rapida_igm').prop('checked', prueba_rapida_igm === '1' ? true : false); $('#otros_cultivos').prop('checked', otros_cultivos === '1' ? true : false);
    $('#falla_cardiovascular').prop('checked', falla_cardiovascular === '1' ? true : false);
    $('#falla_respiratorio').prop('checked', falla_respiratorio === '1' ? true : false);
    $('#falla_renal').prop('checked', falla_renal === '1' ? true : false);
    $('#falla_hepatico').prop('checked', falla_hepatico === '1' ? true : false);
    $('#falla_neurologico').prop('checked', falla_neurologico === '1' ? true : false);
    $('#falla_coagulacion').prop('checked', falla_coagulacion === '1' ? true : false);
    $('#utilizacion_vmni').prop('checked', utilizacion_vmni === '1' ? true : false);
    $('#utilizacion_canula').prop('checked', utilizacion_canula === '1' ? true : false);
    $('#uso_titular_peep').prop('checked', uso_titular_peep === '1' ? true : false);
    $('#pv_tools').prop('checked', pv_tools === '1' ? true : false);
    $('#open_lung_tools').prop('checked', open_lung_tools === '1' ? true : false);
    $('#peep_in_view').prop('checked', peep_in_view === '1' ? true : false);
    $('#reclutamiento_alveolar').prop('checked', reclutamiento_alveolar === '1' ? true : false);
    $('#hidroxicloroquina').prop('checked', hidroxicloroquina === '1' ? true : false);
    $('#condicion_vivo').prop('checked', condicion_vivo === '1' ? true : false);
    $('#condicion_fallecido').prop('checked', condicion_fallecido === '1' ? true : false);

    $('#procedencia_viajes').val(procedencia_viajes);
    $('#procedencia_extranjeros').val(procedencia_extranjeros);
    $('#disnea_dias').val(disnea_dias);
    $('#fiebre_t_max').val(fiebre_t_max);
    $('#hb').val(hb);
    $('#ldh').val(ldh);
    $('#procalcitonina').val(procalcitonina);
    $('#leucocitos').val(leucocitos);
    $('#tgo').val(tgo);
    $('#dimero_d').val(dimero_d);
    $('#linfocitos').val(linfocitos);
    $('#cpk').val(cpk);
    $('#plaquetas').val(plaquetas);
    $('#bt').val(bt);
    $('#cpk_mb').val(cpk_mb);
    $('#creatinina').val(creatinina);
    $('#pcr').val(pcr);
    $('#troponina_t').val(troponina_t);
    $('#troponina_i').val(troponina_i);
    $('#pcr_rt_coronavirus_resultado').val(pcr_rt_coronavirus_resultado);
    $('#pcr_pt_influenza_resultado').val(pcr_pt_influenza_resultado);
    $('#primer_cultivo_secresion_resultado').val(primer_cultivo_secresion_resultado);
    $('#filmarray_respiratorio_resultado').val(filmarray_respiratorio_resultado);
    $('#hemocultivo_resultado').val(hemocultivo_resultado);
    $('#destino').val(destino);
    $('#otros_cultivos_resultado').val(otros_cultivos_resultado);
    $('#ingreso_hospital_pa').val(ingreso_hospital_pa);
    $('#ingreso_hospital_pam').val(ingreso_hospital_pam);
    $('#ingreso_hospital_fr').val(ingreso_hospital_fr);
    $('#ingreso_hospital_fc').val(ingreso_hospital_fc);
    $('#ingreso_hospital_t').val(ingreso_hospital_t);
    $('#ingreso_hospital_sat02').val(ingreso_hospital_sat02);
    $('#ingreso_hospital_fio2').val(ingreso_hospital_fio2);
    $('#ingreso_hospital_pa02_fio02').val(ingreso_hospital_pa02_fio02);
    $('#ingreso_hospital_glasgow').val(ingreso_hospital_glasgow);
    $('#ingreso_uci_pa').val(ingreso_uci_pa);
    $('#ingreso_uci_pam').val(ingreso_uci_pam);
    $('#ingreso_uci_fr').val(ingreso_uci_fr);
    $('#ingreso_uci_fc').val(ingreso_uci_fc);
    $('#ingreso_uci_t').val(ingreso_uci_t);
    $('#ingreso_uci_sat02').val(ingreso_uci_sat02);
    $('#ingreso_uci_fio2').val(ingreso_uci_fio2);
    $('#ingreso_uci_pa02_fio02').val(ingreso_uci_pa02_fio02);
    $('#ingreso_uci_glasgow').val(ingreso_uci_glasgow);
    $('#utilizacion_vmni_horas').val(utilizacion_vmni_horas);
    $('#utilizacion_canula_horas').val(utilizacion_canula_horas);
    $('#dx_ards').val(dx_ards);
    $('#esquema_prona_supina_horas01').val(esquema_prona_supina_horas01);
    $('#esquema_prona_supina_horas02').val(esquema_prona_supina_horas02);
    $('#otras').val(otras);
    $('#peep_maximo').val(peep_maximo);
    $('#po2_fio2_prepona').val(po2_fio2_prepona);
    $('#pco2preprona').val(pco2preprona);
    $('#po2_fio2_prona_4_horas').val(po2_fio2_prona_4_horas);
    $('#po2_prona_4_horas').val(po2_prona_4_horas);
    $('#po2_fio2_supino_4_horas').val(po2_fio2_supino_4_horas);
    $('#pco2_supono_4_horas').val(pco2_supono_4_horas);
    $('#pam').val(pam);
    $('#gc').val(gc);
    $('#ic').val(ic);
    $('#pvc').val(pvc);
    $('#ccs').val(ccs);
    $('#vpp').val(vpp);
    $('#sat02_venosa_central').val(sat02_venosa_central);
    $('#lactato').val(lactato);
    $('#vasopresor_inotropico').val(vasopresor_inotropico);
    $('#hemodinamia_fevi').val(hemodinamia_fevi);
    $('#hemodinamia_ic').val(hemodinamia_ic);
    $('#hemodinamia_vci').val(hemodinamia_vci);
    $('#hemodinamia_otros_hallazgos').val(hemodinamia_otros_hallazgos);
    $('#hemodinamia_sedacion').val(hemodinamia_sedacion);
    $('#hemodinamia_analgesia').val(hemodinamia_analgesia);
    $('#hemodinamia_relajante').val(hemodinamia_relajante);
    $('#hemodinamia_antibiotico').val(hemodinamia_antibiotico);
    $('#hemodinamia_antiviral').val(hemodinamia_antiviral);
    $('#hidroxicloroquina_dosis').val(hidroxicloroquina_dosis);
    $('#descripcion_rx_torax').val(descripcion_rx_torax); console.log({ pcr_rt_coronavirus_fecha_ }); $('#pcr_rt_coronavirus_fecha').val(pcr_rt_coronavirus_fecha_);
    $('#pcr_pt_influenza_fecha').val(pcr_pt_influenza_fecha_);
    $('#primer_cultivo_secresion_fecha').val(primer_cultivo_secresion_fecha_);
    $('#filmarray_respiratorio_fecha').val(filmarray_respiratorio_fecha_);

    $('#prueba_rapida_fecha').val(prueba_rapida_fecha_);
    $('#hemocultivo_fecha').val(hemocultivo_fecha_);

    $('#otros_cultivos_fecha').val(otros_cultivos_fecha_);
    $('#fecha_intubacion').val(fecha_intubacion_);
    $('#fecha_ingreso_vm').val(fecha_ingreso_vm_);
    $('#fecha_primer_dia_prona').val(fecha_primer_dia_prona_);
    $('#fecha_extubacion').val(fecha_extubacion_);
    $('#fecha_traqueostomia').val(fecha_traqueostomia_);
    $('#fecha_egreso_vm').val(fecha_egreso_vm_);
    $('#fecha_alta_uci').val(fecha_alta_uci_);
  } function toFormatHour(data = "") {
    const dateValue = (data ? data.split(' ') : [''])[0];
    const date = dateValue.split('-');
    return dateValue ? date[2] + '/' + date[1] + '/' + date[0] : dateValue
  }

}