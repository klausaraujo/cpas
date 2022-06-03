$(document).ready(function () {
  var data;
  var validate; $(".btn-nuevo").on('click', function (event) {
    $("#formRegistrar")[0].reset();
    $('#anio').removeAttr("disabled");
    $('#almacen').removeAttr("disabled");
    $('#fechaEmision').removeAttr("disabled");
    $('.btn-buscar').removeAttr("disabled");
    initDates();
    data = {};
    tableArticuloIngresos.clear().draw();
    showModal(event, 'Registrar Guía de Ingreso');
  });
});
