<?= $this->extend('template/plantilla') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Valor de indicadores por fecha</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-xs-2 mx-auto">
                                Seleccionar rango de fechas <input type="text" class="form-control" name="filtro_fechas" id="fechas" placeholder="Seleccionar fecha">
                            </div>
                        </div>
                        <button class="btn btn-primary d-block mx-auto" id="btn_generar_grafico">Generar gráfico</button>
                        <br>
                        <div class="row">
                            <div class="col-lg-8 mx-auto d-block">
                                <canvas id="grafico1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= site_url("plugins/jquery/jquery.min.js"); ?>"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url("dist/js/adminlte.js"); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    var url = window.location;
    $('ul.nav-sidebar a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).addClass('active');
    $('ul.nav-treeview a').filter(function() {
        if (this.href) {
            return this.href == url || url.href.indexOf(this.href) == 0;
        }
    }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
</script>

<!-- Script para inicializar DateRangePicker -->
<script type="text/javascript">
    $('input[name="filtro_fechas"]').daterangepicker({
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "Até",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sáb"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Outubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        }
    });
    $('input[name="vac_sol"]').on('apply.daterangepicker', function(ev, picker) { 
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });
</script>

<script type="text/javascript">
    function getChartColorsArray(chartId) {
        if (document.getElementById(chartId) !== null) {
            let colors = document.getElementById(chartId).getAttribute("data-colors");
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf(",") === -1) {
                    let color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                    if (color) return color; else return newValue;;
                } else {
                    let val = value.split(',');
                    if(val.length == 2){
                        let rgbaColor = getComputedStyle(document.documentElement).getPropertyValue(val[0]);
                        rgbaColor = "rgba("+rgbaColor+","+val[1]+")";
                        return rgbaColor;
                    } else {
                        return newValue;
                    }
                }
            });
        }
    }

    Chart.defaults.borderColor= "rgba(133, 141, 152, 0.1)";
    Chart.defaults.color= "#858d98";
</script>

<!-- Colores RGB random para gráficos -->
<script type="text/javascript">
    const array_colores = [
        'rgb(2, 117, 216)',
        'rgb(92, 184, 92)',
        'rgb(91, 192, 222)',
        'rgb(240, 173, 78)',
        'rgb(217, 83, 79)',
        'rgb(41, 43, 44)',
        'rgb(163, 117, 84)'
    ];
</script>

<!-- Funcion para cargar gráfico -->
<script type="text/javascript">
    let myChart;
    $(document).ready(function (){
        $(document).on('click','#btn_generar_grafico', function () {
            //Reseteamos
            if(typeof myChart !== 'undefined'){
                myChart.destroy();
            }
            let fecha_ini = $('#fechas').data('daterangepicker').startDate.format('YYYY-MM-DD');
            let fecha_fin = $('#fechas').data('daterangepicker').endDate.format('YYYY-MM-DD');
            $.ajax({
                method: "POST",
                url: "grafico/get_data",
                data: {'fecha_ini':fecha_ini, 'fecha_fin':fecha_fin},
                success: function(response){

                    if(response == '[]'){
                        Swal.fire(
                            'Información',
                            'No se encuentran registros para el periodo seleccionado.',
                            'info'
                        );
                        return false;
                    }

                    response = JSON.parse(response);
                    fechas = response.reduce((acc, val)=>[...acc, val.fechaIndicador], []);
                    fechas_final = [...new Set(fechas)];
                    
                    //Agrupamos por nombreIndicador
                    const result = response.reduce((r, { nombreIndicador, ...rest }) => {
                    if(!r[nombreIndicador]) r[nombreIndicador] = { 
                        nombreIndicador, data: [rest]}
                    else r[nombreIndicador].data.push(rest);
                    return r;
                    }, {});

                    let json_datasets = [];
                    let valores = [];
                    let colores = [];

                    let j = 0;

                    for (let key in result) {

                        largo_data = Object.keys(result[key].data).length;

                        for (i=0; i<largo_data; i++) {
                            valores.push(result[key].data[i].valorIndicador);
                            colores.push(array_colores[j]);
                        }

                        j++;

                        json_datasets.push({
                            label: result[key].nombreIndicador,
                            data: valores,
                            backgroundColor: colores,
                            borderWidth: 1
                        });

                        valores = [];
                        colores = [];
                        
                    }

                    let ctx = document.getElementById('grafico1').getContext('2d');
                    myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: fechas_final,
                            datasets: json_datasets
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
        });
    });

</script>

<?= $this->endSection() ?>