<?= $this->extend('template/plantilla') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crud / Crear registros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crud / Crear registros</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 d-blok mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Crear registros</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_create">
                            <div class="form-group">
                                <label for="codigoIndicador">Seleccionar indicador</label>
                                <select class="form-control" name="codigoIndicador" id="codigoIndicador" required>
                                    <option selected value="">Seleccionar indicador</option>
                                    <?php 
                                        foreach ($data as $row) {                              
                                            $codigoIndicador = $row['codigoIndicador'];
                                            $nombreIndicador = $row['nombreIndicador'];
                                            echo "<option value=".$codigoIndicador.">".$nombreIndicador."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Seleccionar fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" min="<?= date("Y-m-d") ?>" required />
                            </div>
                            <div class="form-group">
                                <label for="valor">Ingresar valor</label>
                                <input type="number" name="valor" id="valor" step=".01" class="form-control" required />
                            </div>
                            <button class="btn btn-primary mx-auto d-block" id="ingresar_registro">Ingresar registro</button>
                        </form>
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
<script src="<?= BASEURL."dist/js/jquery.validate.min.js"; ?>"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#ingresar_registro").click(function(e){
            e.preventDefault();
            if($("#form_create").valid() == true){
                let codigoIndicador     = $('#codigoIndicador').val();
                let fecha               = $('#fecha').val();
                let valor               = $('#valor').val();
                $.ajax({
                    method: "POST",
                    url: "/crud/create",
                    data: {'codigoIndicador':codigoIndicador, 'fecha':fecha, 'valor':valor},
                    success: function(response){
                        if(response == 'error'){
                            Swal.fire(
                                'Información',
                                'El indicador seleccionado ya posee un registro en la fecha seleccionada.',
                                'error'
                            );
                            return false;
                        }else{
                            Swal.fire(
                                'Información',
                                'Registro agregado exitosamente.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
</script>

<!-- Parseamos el valor a sólo 2 decimales -->
<script type="text/javascript">
    $("#valor").blur(function() {
        valor = this.value;
        if(valor != ""){
            this.value = parseFloat(valor).toFixed(2);
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