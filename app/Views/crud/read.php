<?= $this->extend('template/plantilla') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crud / Ver registros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crud / Ver registros</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ver registros</h3>
                    </div>
                    <div class="table-responsive">
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="tabla">
                                <thead>
                                    <tr>
                                        <th>nombreIndicador</th>
                                        <th>codigoIndicador</th>
                                        <th>unidadMedidaIndicador</th>
                                        <th>valorIndicador</th>
                                        <th>fechaIndicador</th>
                                        <th>origenIndicador</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script src="<?= BASEURL."plugins/jquery/jquery.min.js"; ?>"></script>
<script src="<?= BASEURL."plugins/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>
<script src="<?= BASEURL."plugins/moment/moment.min.js"; ?>"></script>
<script src="<?= BASEURL."dist/js/adminlte.js"; ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="<?= BASEURL."plugins/datatables-buttons/css/buttons.bootstrap4.min.css" ?>">
<script type="text/javascript" src="https://nightly.datatables.net/buttons/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>

<script type="text/javascript">
    $.ajax({
        url : "/crud/read",
        method : "POST",             
        async : true,
        success: function(data){
            var data_final = JSON.parse(data);
            $('#tabla').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                destroy: true,    
                data : data_final, 
                columns: [
                    { data: 'nombreIndicador', title: "nombreIndicador" },
                    { data: 'codigoIndicador', title: "codigoIndicador" },
                    { data: 'unidadMedidaIndicador', title: "unidadMedidaIndicador" },
                    { data: 'valorIndicador', title: "valorIndicador" },
                    { data: 'fechaIndicador', title: "fechaIndicador" },
                    { data: 'origenIndicador', title: "origenIndicador" }
                ],
            });
        }        
    });
</script>

<!-- Sidebar (menú seleccionado) activo -->
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

<?= $this->endSection() ?>