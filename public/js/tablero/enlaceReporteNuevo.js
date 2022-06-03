function enlazar(URI) {
  $(document).ready(function () {
    $("#textSearch").change(function () {
      console.log('text search for: ' + $(this).val());
      tbTablero.search($(this).val()).draw();
    });

    $("select[name=Anio]").on("change", function () {

      var anio = $(this).val();

      if (anio.length > 0) {
        $("#reportContent").empty();

        $.ajax({
          url: URI + 'tablero/procesoIndicador/recargarCombosEnlace',
          method: 'post',
          type: 'json',
          data: { anio: anio },
          error: function (xhr) { },
          beforeSend: function () {
            $("select[name=Codigo_Area]").html('<option value="">Cargando...</option>');
            $("select[name=cboActividadPOI]").html('<option value="">-- Seleccione --</option>');
          },
          success: function (data) {
            data = JSON.parse(data);

            $htmlArea = '<option value="">-- Seleccione --</option>';
            $htmlPOI = '<option value="">-- Seleccione --</option>';
            $.each(data.listaAreas, function (i, e) {
              $htmlArea += '<option value="' + e.Codigo_Area + '">' + e.Nombre_Area + '</option>'

            });
            $("select[name=Codigo_Area]").html($htmlArea);
          }

        });

      }
    });

    $("select[name=Codigo_Area]").on("change", function () {

      var Anio_Ejecucion = $("#Anio").val();
      var Codigo_Area = $(this).val();

      if (Anio_Ejecucion.length > 0 && Codigo_Area.length > 0) {
        $("#reportContent").empty();

        $.ajax({
          url: URI + 'tablero/procesoIndicador/listarEnlace',
          method: 'post',
          dataType: 'json',
          data: { Anio_Ejecucion: Anio_Ejecucion, Codigo_Area: Codigo_Area },
          error: function (xhr) { },
          beforeSend: function () {
            $("select[name=cboActividadPOI]").html('<option value="">Cargando...</option>');
          },
          success: function (data) {
            const { data: operativeArray = [] } = data;

            operativeArray.forEach(element => {
              const { Id_Actividad_POI, Descripcion_Actividad, Anio_Ejecucion } = element;
              generateTemplate({ title: Descripcion_Actividad, code: Id_Actividad_POI })
              generateCardsBySection(URI, Id_Actividad_POI)
            });

          }

        });

      }
    });

    $("#mes").on("change", function () {

      var id = $(this).val();
      if (id.length > 0) {
        semaforo(parseInt(id));
      }

    });

  });

}
function generateCardsBySection(URI, idActivityPoi) {
  let Anio_Ejecucion = $("#Anio").val();
  let Codigo_Area = $("#Codigo_Area").val();
  let Id_Actividad_POI = idActivityPoi;

  if (Anio_Ejecucion.length > 0 && Codigo_Area.length > 0 && Id_Actividad_POI.length > 0) {

    $.ajax({
      url: URI + 'tablero/procesoIndicador/cargarReporteEnlace',
      method: 'post',
      dataType: 'json',
      data: { Anio_Ejecucion: Anio_Ejecucion, Codigo_Area: Codigo_Area, Id_Actividad_POI: Id_Actividad_POI },
      error: function (xhr) {
        $("#modalCargaGeneral").css("display", "none");
      },
      beforeSend: function () {

      },
      success: function (data) {
        generateBars(data.grafico1, { name: 'semesterOne', code: Id_Actividad_POI, semester: 1 })
        generateBars(data.grafico2, { name: 'semesterTwo', code: Id_Actividad_POI, semester: 2 })

      }

    })

    $.ajax({
      url: URI + 'tablero/procesoIndicador/cargarListarEnlace',
      method: 'post',
      dataType: 'json',
      data: { Anio_Ejecucion: Anio_Ejecucion, Codigo_Area: Codigo_Area, Id_Actividad_POI: Id_Actividad_POI },
      error: function (xhr) {
        $("#modalCargaGeneral").css("display", "none");
      },
      beforeSend: function () {

      },
      success: function (data) {
        const { data: items } = data;
        const tableTemp = $(`#tbDetail${Id_Actividad_POI}`).DataTable();
        tableTemp.clear();
        tableTemp.rows.add(items).draw();
      }

    });

  }
}

function generateTemplate(params) {
  let template = `
  <div class="col-sm-12">
    <div class="iq-card">
      <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">${params.title}</h4>
            </div>
      </div>
      <div class="iq-card-body">
          <div class="row">
            <div class="col-sm-6">
                <h4 class="card-title"><p><center>Primer Semestre</center></p></h4>
                <div class="iq-card-body" style="position: relative;height: 100px;">
                  <div id="semesterOne${params.code}"></div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4 class="card-title"><p><center>Segundo Semestre</center></p></h4>
                <div class="iq-card-body" style="position: relative;height: 400px;">
                  <div id="semesterTwo${params.code}"></div>
                </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="tbDetail${params.code}" class="table table-striped table-bordered">
                <thead>
                <tr>
                  <th>A&ntilde;o</th>
                  <th>Tarea</th>
                  <th>N&deg; Documento</th>
                  <th>Observaciones</th>
                  <th>Actividad</th>
                  <th>&Aacute;rea</th>
                  <th>Unidad Medida</th>
                  <th>Cant.</th>
                  <th>Mes</th>
                  <th>C. Act. Proyecto</th>
                  <th>C. Actividad</th>
                  <th>C. Prog. Presupuestal</th>
                  <th>C. Finalidad</th>
                  <th>Archivo</th>
                  <th>Nombre Documento</th>
                  <th>Estado</th>
                </tr>
                </thead>
            </table>
          </div>
      </div>
    </div>
  </div>
  `

  $('#reportContent').append(template);
  $(`#tbDetail${params.code}`).DataTable({
    dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
    language: languageDatatable,
    autoWidth: true,
    columns: [
      { "data": "Anio_Ejecucion" },
      { "data": "Id_Actividad_POI" },
      { "data": "Numero_Documento" },
      { "data": "Observaciones" },
      { "data": "descripcion_actividad" },
      { "data": "Nombre_Area" },
      { "data": "nombre_unidad_medida" },
      { "data": "Cantidad" },
      { "data": "nombre_mes" },
      { "data": "Codigo_Actividad_proyecto" },
      { "data": "codigo_actividad" },
      { "data": "Codigo_Programa_presupuestal" },
      { "data": "Codigo_Finalidad" },
      { "data": "Archivo" },
      { "data": "Nombre_Archivo" },
      { "data": "estado" },

    ],
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
    columnDefs: [
      {
        "targets": [0, 4, 5, 9, 10, 11, 12, 14],
        "visible": false,
        "searchable": true
      },
      {
        width: "20%",
        targets: 2
      },
      {
        width: "5%",
        targets: [7, 13]
      },
      {
        targets: [0, 1, 4, 5, 6, 7, 8, 11, 13, 14, 15],
        className: 'text-center'
      },
      {
        targets: 3,
        className: 'text-left'
      }
    ],
    data: [],
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
      buttons: [
        { extend: 'copy', text: 'Copiar', title: `${params.title}`, exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
        { extend: 'csv', title: `${params.title}`, exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
        { extend: 'excel', title: `${params.title}`, exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
        { extend: 'pdf', title: `${params.title}`, orientation: 'landscape', exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] } },
        {
          extend: 'print',
          text: 'Imprimir',
          title: `${params.title}`,
          exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12] },
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
        }
      ]
    }
  });
}

function generateBars(graphicData = [], params) {
  const fObj = graphicData && graphicData[0] ? graphicData[0] : {};
  const semestersType = { 1: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'], 2: ["Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"] }
  const series = [
    {
      name: 'Meta Programada',
      data: params.semester === 1 ? [fObj.P_ENE, fObj.P_FEB, fObj.P_MAR, fObj.P_ABR, fObj.P_MAY, fObj.P_JUN] : [fObj.P_JUL, fObj.P_AGO, fObj.P_SEP, fObj.P_OCT, fObj.P_NOV, fObj.P_DIC]
    },
    {
      name: 'Meta Ejecutada',
      data: params.semester === 1 ? [fObj.E_ENE, fObj.E_FEB, fObj.E_MAR, fObj.E_ABR, fObj.E_MAY, fObj.E_JUN] : [fObj.E_JUL, fObj.E_AGO, fObj.E_SEP, fObj.E_OCT, fObj.E_NOV, fObj.E_DIC]
    }
  ]

  let options = {
    chart: {
      height: 350,
      type: 'bar',
    },
    colors: ['#0000FF', '#00FF00'],
    plotOptions: {
      bar: {
        vertical: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    series,
    xaxis: {
      categories: semestersType[params.semester],
      title: {
        text: ''
      }
    },
    yaxis: {
      title: {
        text: 'Total Meta Física'
      }
    },
  }

  let chart = new ApexCharts(
    document.querySelector(`#${params.name}${params.code}`),
    options
  );

  chart.render();

}