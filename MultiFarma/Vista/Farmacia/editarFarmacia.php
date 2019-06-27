<?php include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->
<div id="seccion-farmacia">
    <div class="box-header">
        <i class="fa fa-building" aria-hidden="true">Gestión de Farmacia</i>
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

                    <form class="form-horizontal" role="form" id="ffarmacia">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_farmacia">Codigo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_farmacia" name="id_farmacia"
                                    placeholder="Ingrese Codigo" data-validation="length alphanumeric"
                                    data-validation-length="3-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre_farmacia">Nombre:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_farmacia" name="nombre_farmacia"
                                    placeholder="Ingrese nombre farmacia" data-validation="length alphanumeric"
                                    data-validation-length="3-12" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="direccion_farmacia">Direccion:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion_farmacia"
                                    name="direccion_farmacia" placeholder="Ingrese direccion de la farmacia" value=""
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="telefono_farmacia">Telefono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_farmacia" name="telefono_farmacia"
                                    placeholder="Ingrese telefono de la farmacia" value="" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_pais">Pais:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="id_pais" name="id_pais">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_ciudad">Ciudad:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="id_ciudad" name="id_ciudad">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_propietario">Propietario:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="id_propietario" name="id_propietario">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id_usuario">Administrador de farmacia</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="id_usuario" name="id_usuario">

                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip"
                                        title="Actualizar farmacia">Actualizar</button>
                                    <button type="button" id="cerrar" class="btn btn-success btncerrar2"
                                        data-toggle="tooltip" title="Cancelar">Cancelar</button>
                                </div>
                            </div>

                            <input type="hidden" id="editar" value="editar" name="accion" />
                            </fieldset>

                    </form>
                </div>
                <input type="hidden" id="pagina" value="editar" name="editar" />
            </div>
        </div>
    </div>
</div>