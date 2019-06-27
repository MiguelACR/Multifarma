<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(2);
?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fcliente">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="id_cliente">Identificación:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_cliente" name="id_cliente" placeholder="Ingrese la identificación"
                            value = ""  data-validation="length alphanumeric" data-validation-length="3-12" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_cliente">Nombres:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingrese los nombres del cliente"
                            value = "">
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="apellido_cliente">Apellidos:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder="Ingrese los apellidos del cliente"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion_cliente">Dirección:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" placeholder="Ingrese la dirección del cliente"
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_cliente">Telefono:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Ingrese el telefono del cliente"
                            value = "">
                        </div>
                    </div>

            <!--        <div class="form-group">
                        <label class="control-label col-sm-2" for="email_empleado">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email_empleado" name="email_empleado" placeholder="Ingrese el email del empleado"
                            value = "">
                        </div>
                    </div>-->

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_pais">Pais:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_pais" name="id_pais">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaPais as $fila){ ?>
								<option value="<?php echo trim($fila['id_pais']); ?>" >
								<?php echo utf8_encode(trim($fila['nombre_pais'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_ciudad">Ciudad:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_ciudad" name="id_ciudad">
                            <option value="" selected>Seleccione ...</option>
								<?php foreach($listaPais as $fila){ ?>
								<option value="<?php echo trim($fila['id_ciudad']); ?>" >
								<?php echo utf8_encode(trim($fila['nombre_ciudad'])); ?> </option>

								<?php } ?>
							</select>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Cliente">Actualizar Cliente</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>