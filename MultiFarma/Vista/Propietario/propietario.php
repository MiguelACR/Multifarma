<?php include_once ("../../Funciones/sessiones.php"); ?>
<div id="nuevo-editar" class="hide">
    <!-- div para cargar el formulario para una nuevo propietario o editar un propietario -->
</div>

<div id="propietario">
    <div class="box-header">
        <!--<i class="ion ion-clipboard"></i>-->
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-info btn-sm" id="nuevo" data-toggle="tooltip" title="Nuevo propietario"><i
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
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellido</th>
                    <th class="text-center">Direccion</th>
                    <th class="text-center">Telefono</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

    </div><!-- /.box-body -->
    <script src="./Recursos/js/funcionesPropietario.js"></script>
</div>