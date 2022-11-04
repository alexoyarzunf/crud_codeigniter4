<?= $this->extend('template/plantilla') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crud / Actualizar registros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Crud / Actualizar registros</li>
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
                        <h3 class="card-title">Actualizar registros</h3>
                    </div>
                    <div class="card-body">
                        <form id="form_update">
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
                                <input type="date" class="form-control" name="fecha" id="fecha" required />
                            </div>
                            <div class="form-group">
                                <label for="valor">Valor actual</label>
                                <input type="number" id="valor_actual" name="valor_actual" id="valor" class="form-control" readonly />
                            </div>
                            <div class="form-group">
                                <label for="valor">Ingresar valor nuevo</label>
                                <input type="number" id="valor_nuevo" name="valor_nuevo" step=".01" class="form-control" required />
                            </div>
                            <button class="btn btn-primary mx-auto d-block" id="actualizar_registro">Ingresar registro</button>
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

<!-- Parseamos el valor a sólo 2 decimales -->
<script type="text/javascript">
    $("#valor_nuevo").blur(function() {
        valor = this.value;
        if(valor != ""){
            this.value = parseFloat(valor).toFixed(2);
        }
    });
</script>

<!-- Mostramos el valor actual del indicador y fecha seleccionado -->
<script type="text/javascript">
    $('#codigoIndicador').change(function(){
        codigoIndicador = $(this).val();
        fecha = $('#fecha').val();
        if(codigoIndicador != "" && fecha != ""){
            $.ajax({
                method: "POST",
                url: "/crud/get_valor_actual",
                data: {'codigoIndicador':codigoIndicador, 'fecha':fecha},
                success: function(response){
                    var data = JSON.parse(response);
                    document.getElementById("valor_actual").value = data[0]['valorIndicador'];
                }
            });
        }
    })
    $('#fecha').change(function(){
        fecha = $(this).val();
        codigoIndicador = $('#codigoIndicador').val();
        if(codigoIndicador != "" && fecha != ""){
            $.ajax({
                method: "POST",
                url: "/crud/get_valor_actual",
                data: {'codigoIndicador':codigoIndicador, 'fecha':fecha},
                success: function(response){
                    var data = JSON.parse(response);
                    document.getElementById("valor_actual").value = data[0]['valorIndicador'];
                }
            });
        }
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#actualizar_registro").click(function(e){
            e.preventDefault();
            if($("#form_update").valid() == true){
                let codigoIndicador     = $('#codigoIndicador').val();
                let fecha               = $('#fecha').val();
                let valor_nuevo         = $('#valor_nuevo').val();
                $.ajax({
                    method: "POST",
                    url: "/crud/update",
                    data: {'codigoIndicador':codigoIndicador, 'fecha':fecha, 'valor_nuevo':valor_nuevo},
                    success: function(){
                        Swal.fire(
                            'Información',
                            'Registro actualizado exitosamente.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
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