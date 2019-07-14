<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(6);
?>
<div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="ffarmacia">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_farmacia">Nombre:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_farmacia" name="nombre_farmacia" placeholder="Ingrese el nombre de la farmacia"
                            value = "">
                            <span data-key="nombre_farmacia" class="label label-danger"></span>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion_farmacia">Dirección:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                            <input type="text" class="form-control" id="direccion_farmacia" name="direccion_farmacia" placeholder="Ingrese la dirección de la farmacia"
                            value = "">
                            <span data-key="direccion_farmacia" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_farmacia">Telefono:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                            <input type="text" class="form-control" id="telefono_farmacia" name="telefono_farmacia" placeholder="Ingrese el telefono de la farmacia"
                            value = "">
                            <span data-key="telefono_farmacia" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_pais">Pais:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map"></i></span>
                            <select class="form-control" id="id_pais" name="id_pais">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                            <span data-key="id_pais" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group" id="id_ciudad_group">
                        <label class="control-label col-sm-2" for="id_ciudad">Ciudad:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map"></i></span>
                            <select class="form-control" id="id_ciudad" name="id_ciudad">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                            <span data-key="id_ciudad" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_propietario">Propietario:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                            <select class="form-control" id="id_propietario" name="id_propietario">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                            <span data-key="id_propietario" class="label label-danger"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_rol">Rol:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                            <select class="form-control" id="id_rol" name="id_rol">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                            <span data-key="id_rol" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group" id="id_usuario_group">
                        <label class="control-label col-sm-2" for="id_usuario">Usuario:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa  fa-user"></i></span>
                            <select class="form-control" id="id_usuario" name="id_usuario">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                            <span data-key="id_usuario" class="label label-danger"></span>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar farmacia">Actualizar farmacia</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

            </fieldset>
            
        </form>
</div>