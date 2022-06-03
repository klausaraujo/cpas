let areaId = 0;
$(document).ready(function () {
  $("#Anio_Ejecucion").change(function () {
    anioEjecucion("#formInsertarAreas", $(this));
  });

  $("#Codigo_Sector").change(function () {
    codigoSector("#formInsertarAreas", $(this));
  });

  $("#Codigo_Pliego").change(function () {
    codigoPliego("#formInsertarAreas", $(this));
  });

  $("#Codigo_Ejecutora").change(function () {
    codigoEjecutora("#formInsertarAreas", $(this));
  });

  $("#Codigo_Centro_Costos").change(function () {
    codigoCentroCostos("#formInsertarAreas", $(this));
  });

  $("#Anio_Ejecucion,#Codigo_Sector,#Codigo_Pliego,#Codigo_Ejecutora,#Codigo_Centro_Costos,#Codigo_Sub_Centro_Costos").change(function () {

    $("#tbAreas tbody").html("");
    setTimeout(function () {
      var Anio_Ejecucion = $("#Anio_Ejecucion").val();
      var Codigo_Sector = $("#Codigo_Sector").val();
      var Codigo_Pliego = $("#Codigo_Pliego").val();
      var Codigo_Ejecutora = $("#Codigo_Ejecutora").val();
      var Codigo_Centro_Costos = $("#Codigo_Centro_Costos").val();
      var Codigo_Sub_Centro_Costos = $("#Codigo_Sub_Centro_Costos").val();

      if (Anio_Ejecucion.length > 0 && Codigo_Sector.length > 0 && Codigo_Pliego.length > 0 && Codigo_Ejecutora.length > 0 && Codigo_Centro_Costos.length > 0 &&
        Codigo_Sub_Centro_Costos.length > 0) {
        $("#tbAreas tbody").html("<tr><td colspan='3' align='center'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i></td></tr>");
        areasByUser(Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Usuario);
      }
      else {
        $("#tbAreas tbody").html("");
      }
    }, 500);
  });

  $('#tbAreas tbody').on('click', 'tr', function () {
    var Codigo_Area = $(this).find("#Codigo_Area").html();
    var Siglas_Area = $(this).find("#Siglas_Area").html();
    var Nombre_Area = $(this).find("#Nombre_Area").html();
    var Area_Estado = $(this).find("#Area_Estado input").is(":checked");
    console.log({ Codigo_Area, Siglas_Area })

    $('#Nombre_Area').val(Nombre_Area);
    $('#Codigo_Area').val(Codigo_Area);
    $('#Siglas_Area').val(Siglas_Area);
    if (Area_Estado)
      $('#Area_Estado').attr('checked', true)
  })$("#formInsertarAreas").submit(function (event) {
    var Anio_Ejecucion = $("#Anio_Ejecucion").val();
    var Codigo_Sector = $("#Codigo_Sector").val();
    var Codigo_Pliego = $("#Codigo_Pliego").val();
    var Codigo_Ejecutora = $("#Codigo_Ejecutora").val();
    var Codigo_Centro_Costos = $("#Codigo_Centro_Costos").val();
    var Codigo_Sub_Centro_Costos = $("#Codigo_Sub_Centro_Costos").val();
    var Nombre_Area = $("#Nombre_Area").val();
    var Siglas_Area = $("#Siglas_Area").val();
    var Codigo_Area = $("#Codigo_Area").val();
    var Area_Estado = $("#Area_Estado input").is(":checked"); $.ajax({
      url: URI + 'tablero/procesoIndicador/registrarAreas',
      method: 'post',
      type: 'json',
      data: {
        Anio_Ejecucion,
        Codigo_Sector,
        Codigo_Pliego,
        Codigo_Ejecutora,
        Codigo_Centro_Costos,
        Codigo_Sub_Centro_Costos,
        Codigo_Usuario,
        Nombre_Area,
        Codigo_Area,
        Codigo_Area_Incrementable: '0' + (areaId + 1),
        Siglas_Area,
        Area_Estado: Area_Estado ? '1' : '0'
      },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        $("#tbAreas tbody").html("");
      },
      success: function (data) {
        console.log({ data });
        $("#tbAreas tbody").html("<tr><td colspan='3' align='center'><i class='fa fa-refresh fa-spin fa-3x fa-fw'></i></td></tr>");
        areasByUser(Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Usuario);
      }
    });
    event.preventDefault();
  });
})

function areasByUser(Anio_Ejecucion, Codigo_Sector, Codigo_Pliego, Codigo_Ejecutora, Codigo_Centro_Costos, Codigo_Sub_Centro_Costos, Codigo_Usuario) {

  $.ajax({
    url: URI + 'usuarios/usuario/areasUsuario',
    method: 'post',
    type: 'json',
    data: {
      Anio_Ejecucion: Anio_Ejecucion, Codigo_Sector: Codigo_Sector, Codigo_Pliego: Codigo_Pliego, Codigo_Ejecutora: Codigo_Ejecutora,
      Codigo_Centro_Costos: Codigo_Centro_Costos, Codigo_Sub_Centro_Costos: Codigo_Sub_Centro_Costos, Codigo_Usuario: Codigo_Usuario
    },
    error: function (xhr) { alert(xhr); },
    beforeSend: function () {
      $("#tbAreas tbody").html("");
    },
    success: function (data) {
      data = JSON.parse(data);
      areaId = data.length;
      $.each(data, function (i, e) {
        $check = '<input type="checkbox" name="chk_areas[]" value="' + e.Codigo_Area + '">';
        if (parseInt(e.Codigo_Usuario) > 0) $check = '<input type="checkbox" disabled name="chk_areas[]" value="' + e.Codigo_Area + '" checked="true">';
        $("#tbAreas tbody").append(`
        <tr>
          <td id="Codigo_Area">${e.Codigo_Area}</td>
          <td id="Siglas_Area">${e.Siglas_Area}</td>
          <td id="Nombre_Area">${e.Nombre_Area}</td>
          <td id="Area_Estado">${$check}</td>
        </tr>
        `);
      });
    }
  });

}

function anioEjecucion(form, object) {

  var anio = object.val();
  if (anio.length > 0) {

    $.ajax({
      url: URI + 'general/cargarSectores',
      method: 'post',
      type: 'json',
      data: { anio: anio },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        $(form).find("select[name=Codigo_Sector]").html('<option value="">Cargando...</option>');
      },
      success: function (data) {
        $(form).find("select[name=Codigo_Sector]").html('<option value="">[Seleccione...]</option>');

        data = JSON.parse(data);
        $.each(data, function (i, e) {
          $(form).find("select[name=Codigo_Sector]").append('<option value="' + e.Codigo_Sector + '">' + e.Codigo_Sector + ' - ' + e.Nombre_Sector + '</option>');
        });
      }
    });
  }
}
function codigoSector(form, object) {

  var anio = $(form).find("select[name=Anio_Ejecucion]").val();
  var sector = object.val();
  var select = $(form).find("select[name=Codigo_Pliego]");
  if (sector.length > 0) {

    $.ajax({
      url: URI + 'general/cargarPliegos',
      method: 'post',
      type: 'json',
      data: { anio: anio, sector: sector },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        select.html('<option value="">Cargando...</option>');
      },
      success: function (data) {
        select.html('<option value="">[Seleccione...]</option>');

        data = JSON.parse(data);
        $.each(data, function (i, e) {
          select.append('<option value="' + e.Codigo_Pliego + '">' + e.Codigo_Pliego + ' - ' + e.Nombre_Pliego + '</option>');
        });
      }
    });
  }

}

function codigoPliego(form, object) {

  var anio = $(form).find("select[name=Anio_Ejecucion]").val();
  var sector = $(form).find("select[name=Codigo_Sector]").val();
  var pliego = object.val();
  var select = $(form).find("select[name=Codigo_Ejecutora]");
  if (sector.length > 0) {

    $.ajax({
      url: URI + 'general/cargarEjecutoras',
      method: 'post',
      type: 'json',
      data: { anio: anio, sector: sector, sector: sector, pliego: pliego },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        select.html('<option value="">Cargando...</option>');
      },
      success: function (data) {
        select.html('<option value="">[Seleccione...]</option>');

        data = JSON.parse(data);
        $.each(data, function (i, e) {
          select.append('<option value="' + e.Codigo_Ejecutora + '">' + e.Codigo_Ejecutora + ' - ' + e.Nombre_Ejecutora + '</option>');
        });
      }
    });
  }
}
function codigoEjecutora(form, object) {

  var anio = $(form).find("select[name=Anio_Ejecucion]").val();
  var sector = $(form).find("select[name=Codigo_Sector]").val();
  var pliego = $(form).find("select[name=Codigo_Pliego]").val();
  var ejecutora = object.val();
  var select = $(form).find("select[name=Codigo_Centro_Costos]");
  if (ejecutora.length > 0) {

    $.ajax({
      url: URI + 'general/cargarCentroCostos',
      method: 'post',
      type: 'json',
      data: { anio: anio, sector: sector, sector: sector, pliego: pliego, ejecutora: ejecutora },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        select.html('<option value="">Cargando...</option>');
      },
      success: function (data) {
        select.html('<option value="">[Seleccione...]</option>');

        data = JSON.parse(data);
        $.each(data, function (i, e) {
          select.append('<option value="' + e.Codigo_Centro_Costos + '">' + e.Codigo_Centro_Costos + ' - ' + e.Nombre_Centro_Costos + '</option>');
        });
      }
    });
  }

}

function codigoCentroCostos(form, object) {

  var anio = $(form).find("select[name=Anio_Ejecucion]").val();
  var sector = $(form).find("select[name=Codigo_Sector]").val();
  var pliego = $(form).find("select[name=Codigo_Pliego]").val();
  var ejecutora = $(form).find("select[name=Codigo_Ejecutora]").val();
  var centroCostos = object.val();
  var select = $(form).find("select[name=Codigo_Sub_Centro_Costos]");
  if (centroCostos.length > 0) {

    $.ajax({
      url: URI + 'general/cargarSubCentroCostos',
      method: 'post',
      type: 'json',
      data: { anio: anio, sector: sector, sector: sector, pliego: pliego, ejecutora: ejecutora, centroCostos: centroCostos },
      error: function (xhr) { alert(xhr); },
      beforeSend: function () {
        select.html('<option value="">Cargando...</option>');
      },
      success: function (data) {
        select.html('<option value="">[Seleccione...]</option>');

        data = JSON.parse(data);
        $.each(data, function (i, e) {
          select.append('<option value="' + e.Codigo_Sub_Centro_Costos + '">' + e.Codigo_Sub_Centro_Costos + ' - ' + e.Nombre_Sub_Centro_Costos + '</option>');
        });
      }
    });
  }

}