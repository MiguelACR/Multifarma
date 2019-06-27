<?php include_once ("../../Funciones/sessiones.php"); ?>
<div id="nuevo-editar" class="hide">
    <!-- div para cargar el formulario para una nueva ciudad o editar una ciudad -->
</div>

<div id="ciudad">
    <div class="box-header">
        <!--<i class="ion ion-clipboard"></i>-->
        <h1 class="alert alert-success" role="alert">CIUDADES</h1>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-info btn-sm" id="nuevo" data-toggle="tooltip" title="Nueva ciudad"><i
                    class="fa fa-plus" aria-hidden="true"></i></button>
            <button class="btn btn-info btn-sm btncerrar" data-toggle="tooltip" title="Ocultar"><i
                    class="fa fa-times"></i></button>

        </div><!-- /. tools -->

    </div><!-- /.box-header -->

    <div class="box-body">

        <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th class="text-center">Codigo</th>
                    <th class="text-center">Ciudad</th>
                    <th class="text-center">Pais</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

    </div><!-- /.box-body -->
    <script src="./Recursos/js/funcionesCiudad.js"></script>
</div>