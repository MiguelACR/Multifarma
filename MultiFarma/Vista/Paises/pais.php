<?php include_once ("../../Funciones/sessiones.php"); ?>
<div id="nuevo-editar" class="hide">
    <!-- div para cargar el formulario para una nuevo pais o editar una pais -->
</div>

<div id="pais">
    <div class="box-header">
        <h1 class="alert alert-success" role="alert">PAISES</h1>
        <!--<i class="ion ion-clipboard"></i>-->
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-info btn-sm" id="nuevo" data-toggle="tooltip" title="Nuevo pais"><i
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
                    <th class="text-center">Pais</th>
                    <th class="text-center">Abreviatura</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>

    </div><!-- /.box-body -->
    <script src="./Recursos/js/funcionesPais.js"></script>
</div>