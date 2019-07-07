<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(3);
?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fempleado">
                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_empleado">Identificación:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <input type="text" class="form-control" id="id_empleado" name="id_empleado" placeholder="Ingrese la identificación"
                            value = "" readonly="true">
                            <span data-key="id_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_empleado">Nombres:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" placeholder="Ingrese los nombres del empleado"
                            value = "">
                            <span data-key="nombre_empleado" class="label label-danger"></span>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="apellido_empleado">Apellidos:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="apellido_empleado" name="apellido_empleado" placeholder="Ingrese los apellidos del empleado"
                            value = "">
                            <span data-key="apellido_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cargo_empleado">Cargo:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                            <input type="text" class="form-control" id="cargo_empleado" name="cargo_empleado" placeholder="Ingrese el cargo del empleado"
                            value = "">
                            <span data-key="cargo_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_pais">Pais:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map"></i></span>
                            <select class="form-control" id="id_pais" name="id_pais">
                            
							</select>
                            <span data-key="id_pais" class="label label-danger"></span>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_ciudad">Ciudad:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map"></i></span>
                            <select class="form-control" id="id_ciudad" name="id_ciudad">
                            
							</select>
                            <span data-key="id_ciudad" class="label label-danger"></span>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion_empleado">Dirección:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                            <input type="text" class="form-control" id="direccion_empleado" name="direccion_empleado" placeholder="Ingrese la dirección del empleado"
                            value = "">
                            <span data-key="direccion_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_empleado">Telefono:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                            <input type="text" class="form-control" id="telefono_empleado" name="telefono_empleado" placeholder="Ingrese el telefono del empleado"
                            value = "">
                            <span data-key="telefono_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email_empleado">Email:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="text" class="form-control" id="email_empleado" name="email_empleado" placeholder="Ingrese el email del empleado"
                            value = "">
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_farmacia">Farmacia:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                            <select class="form-control" id="id_farmacia" name="id_farmacia">
                            
							</select>	
                            <span data-key="id_farmacia" class="label label-danger"></span>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar empleado">Actualizar empleado</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

			</fieldset>

		</form>
	</div>