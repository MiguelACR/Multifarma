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
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_empleado" name="id_empleado" placeholder="Ingrese la identificación"
                            value = "" readonly="true" data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_empleado">Nombre:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" placeholder="Ingrese el nombre del empleado"
                            value = "">
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="apellido_empleado">Apellido:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apellido_empleado" name="apellido_empleado" placeholder="Ingrese el apellido del empleado"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cargo_empleado">Cargo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="cargo_empleado" name="cargo_empleado" placeholder="Ingrese el cargo del empleado"
                            value = "">
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
                        <label class="control-label col-sm-2" for="direccion_empleado">Dirección:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direccion_empleado" name="direccion_empleado" placeholder="Ingrese el cargo del empleado"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_empleado">Telefono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono_empleado" name="telefono_empleado" placeholder="Ingrese el cargo del empleado"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email_empleado">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email_empleado" name="email_empleado" placeholder="Ingrese el cargo del empleado"
                            value = "">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_farmacia">Farmacia:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_farmacia" name="id_farmacia">
                            
							</select>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Comuna">Actualizar Comuna</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>