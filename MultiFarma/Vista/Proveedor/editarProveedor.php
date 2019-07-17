<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(14);
?>
<div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fproveedor">
 					<div class="form-group">
                        <label class="control-label col-sm-2" for="id_proveedor">Nit:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <input type="text" class="form-control" id="id_proveedor" name="id_proveedor" placeholder="Ingrese el nit del proveedor"
                            value = "" readonly="true">
                            <span data-key="id_proveedor" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_proveedor">Descripción:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" placeholder="Ingrese la descripción del proveedor"
                            value = "">
                            <span data-key="nombre_proveedor" class="label label-danger"></span>
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
                        <label class="control-label col-sm-2" for="direccion_proveedor">Dirección:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-map-signs"></i></span>
                            <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor" placeholder="Ingrese la dirección del proveedor"
                            value = "">
                            <span data-key="direccion_proveedor" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="telefono_proveedor">Telefono:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tty"></i></span>
                            <input type="text" class="form-control" id="telefono_proveedor" name="telefono_proveedor" placeholder="Ingrese el telefono del proveedor"
                            value = "">
                            <span data-key="telefono_proveedor" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email_proveedor">Email:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                            <input type="text" class="form-control" id="email_proveedor" name="email_proveedor" placeholder="Ingrese el email del proveedor"
                            value = "">
                            <span data-key="email_proveedor" class="label label-danger"></span>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar proveedor">Actualizar proveedor</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>