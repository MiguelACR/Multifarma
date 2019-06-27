<?php include_once ("../../Funciones/sessiones.php"); ?>
<div id="seccion-propietario">
    <div class="box-header">
        <i class="fa fa-building" aria-hidden="true">Gestion de Propietario</i>

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

                    <form class="form-horizontal" role="form" id="fpropietario">


                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_propietario">Codigo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_propietario" name="id_propietario"
                                    placeholder="Ingrese documento propietario" value="" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre_propietario">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_propietario"
                                    name="nombre_propietario" placeholder="Ingrese Nombres del propietario" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="apellido_propietario">Apellido:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="apellido_propietario"
                                    name="apellido_propietario" placeholder="Ingrese Apellidos propietario" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="direccion_propietario">Direccion:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion_propietario"
                                    name="direccion_propietario" placeholder="Ingrese direccion propietario" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="telefono_propietario">Telefono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_propietario"
                                    name="telefono_propietario" placeholder="Ingrese telefono propietario" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="actualizar" data-toggle="tooltip"
                                    title="Actualizar Propietario" class="btn btn-primary">Actualizar</button>
                                <button type="button" id="cancelar" data-toggle="tooltip" title="Cancelar Edición"
                                    class="btn btn-success btncerrar2">Cancelar</button>
                            </div>

                        </div>

                        <input type="hidden" id="editar" value="editar" name="accion" />
                        </fieldset>

                    </form>
                </div>
                <input type="hidden" id="pagina" value="editar" name="editar" />
            </div>