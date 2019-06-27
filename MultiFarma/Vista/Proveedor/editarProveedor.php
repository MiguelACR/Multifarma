<?php include_once ("../../Funciones/sessiones.php"); ?>
<div id="seccion-proveedor">
    <div class="box-header">
        <i class="fa fa-building" aria-hidden="true">Gestion de Proveedor</i>

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

                    <form class="form-horizontal" role="form" id="fproveedor">


                    <div class="form-group">
                            <label class="control-label col-sm-2" for="id_proveedor">Codigo:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_proveedor" name="id_proveedor"
                                    placeholder="Ingrese Codigo" value="" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre_proveedor">Proveedor:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor"
                                    placeholder="Ingrese Nombre del Proveedor" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="direccion_proveedor">Direccion:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor"
                                    placeholder="Ingrese Direccion del Proveedor" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="telefono_proveedor">Telefono:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="telefono_proveedor" name="telefono_proveedor"
                                    placeholder="Ingrese Telefono del Proveedor" value="">
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
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" id="actualizar" data-toggle="tooltip" title="Actualizar Proveedor"
                                    class="btn btn-primary">Actualizar</button>
                                <button type="button" id="cancelar" data-toggle="tooltip" title="Cancelar Edición"
                                    class="btn btn-success btncerrar2"> Cancelar </button>
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