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
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <input type="text" class="form-control" id="id_cliente" name="id_cliente" placeholder="Ingrese la identificación"
                            value = "">
                            <span data-key="id_cliente" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_cliente">Nombres:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Ingrese los nombres del cliente"
                            value = "">
                            <span data-key="nombre_cliente" class="label label-danger"></span>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="apellido_cliente">Apellidos:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder="Ingrese los apellidos del cliente"
                            value = "">
                            <span data-key="apellido_cliente" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="direccion_cliente">Dirección:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                            <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" placeholder="Ingrese la dirección del cliente"
                            value = "">
                            <span data-key="direccion_cliente" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_cliente">Telefono:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Ingrese el telefono del cliente"
                            value = "">
                            <span data-key="telefono_cliente" class="label label-danger"></span>
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

                    <div class="form-group">
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
                        <label class="control-label col-sm-2" for="email_cliente">Email:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="text" class="form-control" id="email_cliente" name="email_cliente" placeholder="Ingrese el email del cliente"
                            value = "">
                            <span data-key="email_cliente" class="label label-danger"></span>
                        </div>
                    </div>
                    
					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar cliente">Grabar cliente</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
		

		</form>
	</div>