<?php include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->
<div id="seccion-presentacion">
    <div class="box-header">
        <i class="fa fa-building" aria-hidden="true">Gestión de Presentacion</i>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <button class="btn btn-info btn-sm btncerrar2" data-toggle="tooltip" title="Cerrar"><i
                    class="fa fa-times"></i></button>
        </div><!-- /. tools -->
    </div>
    <div class="box-body">

        <div align="center">
            <div id="actual">
            </div>
        </div>


        <div class="panel-group">
            <div class="panel panel-primary">
                <div class="panel-heading">Datos</div>
                <div class="panel-body">

                    <form class="form-horizontal" role="form" id="fpresentacion" name="fpresentacion" method="post">


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_presentacion">Codigo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_presentacion" name="id_presentacion"
                                    placeholder="Ingrese Codigo" data-validation="length alphanumeric"
                                    data-validation-length="3-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre_presentacion">Presentacion:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_presentacion" name="nombre_presentacion"
                                    placeholder="Ingrese Presentacion de Medicamento" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip"
                                    title="Grabar Presentacion">Grabar Presentacion</button>
                                <button type="button" id="cerrar" class="btn btn-success btncerrar2"
                                    data-toggle="tooltip" title="Cancelar">Cancelar</button>
                            </div>
                        </div>

                        <input type="hidden" id="nuevo" value="nuevo" name="accion" />
                        </fieldset>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>