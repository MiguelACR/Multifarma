<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(15);
?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fusuario">
 					<div class="form-group">
                        <label class="control-label col-sm-1" for="id_usuario">Codigo:</label>
                        <div class="input-group col-sm-10">
                            <input type="text" class="form-control " id="id_usuario" name="id_usuario" placeholder="Automatico"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="nickname_usuario">Nickname:</label>
                        <div class="input-group col-sm-10">
                            <input type="text" class="form-control" id="nickname_usuario" name="nickname_usuario" placeholder="Ingrese Nickname"
                            value = "">
                        </div>                    
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-1" for="clave_usuario">Clave:</label>
                        <div class="input-group col-sm-10">
                            <input type="password" readonly="true" class="form-control" id="clave_usuario" name="clave_usuario" placeholder="Ingrese Clave"
                            value = "">
                            <span class="input-group-btn">
                            <button class="btn btn-info btn-flat ocultarC" type="button"><i class="fa fa-eye"></i></button>  
                            </span> 
                            <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="button" id="desbloqueo"><i class="fa fa-unlock-alt"></i></button>  
                            </span> 
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="id_estado">Estado:</label>
                        <div class="input-group col-sm-10">
                            <select class="form-control" id="id_estado" name="id_estado">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="id_rol">Rol:</label>
                        <div class="input-group col-sm-10">
                            <select class="form-control" id="id_rol" name="id_rol">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="fechacreacion_usuario">Fecha creacion:</label>
                        <div class="input-group col-sm-10">
                            <input type="date" readonly="true" class="form-control" id="fechacreacion_usuario" name="fechacreacion_usuario"
                            value = "">
                        </div>                    
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-1" for="id_empleado">Empleado:</label>
                        <div class="input-group col-sm-10">
                            <select class="form-control" id="id_empleado" name="id_empleado">
                            <option value="" selected>Seleccione ...</option>
								
							</select>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Usuario">Actualizar Usuario</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
