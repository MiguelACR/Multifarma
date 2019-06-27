<?php include_once ("../../Funciones/sessiones.php"); ?>

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="frol" name="frol">

 					<div class="form-group">
                        <label class="control-label col-sm-2" for="id_rol">Identificador:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_rol" name="id_rol" placeholder="Automatico"
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_rol">Descripción:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre_rol" name="nombre_rol" placeholder="Ingrese la descripcion del rol"
                            value = "">
                        </div>
                    </div>
					 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_rolxpermiso">Permisos:</label>
                        <div class="col-sm-10">
                        <input type="checkbox" name="1"     value="1"     id="1R"> Ciudades<br>
                        <input type="checkbox" name="2"     value="2"     id="2R"> Clientes<br>
                        <input type="checkbox" name="3"     value="3"     id="3R"> Empleados<br>
                        <input type="checkbox" name="4"     value="4"     id="4R"> Facturas<br>
                        <input type="checkbox" name="5"     value="5"     id="5R"> Ventas<br>
                        <input type="checkbox" name="6"     value="6"     id="6R"> Farmacias<br>
                        <input type="checkbox" name="7"     value="7"     id="7R"> Inventario<br>
                        <input type="checkbox" name="8"     value="8"     id="8R"> Ofertas<br>
                        <input type="checkbox" name="9"     value="9"     id="9R"> Nomina<br>
                        <input type="checkbox" name="10"    value="10"    id="10R"> Paises<br>
                        <input type="checkbox" name="11"    value="11"    id="11R"> Productos<br>
                        <input type="checkbox" name="12"    value="12"    id="12R"> Presentaciones<br>
                        <input type="checkbox" name="13"    value="13"    id="13R"> Propietarios<br>
                        <input type="checkbox" name="14"    value="14"    id="14R"> Proveedores<br>
                        <input type="checkbox" name="15"    value="15"    id="15R"> Usuarios<br>
                        <input type="checkbox" name="16"    value="16"    id="16R"> Roles<br>
                        <input type="checkbox" name="17"    value="17"    id="17R"> Carousel<br>
                        <input type="checkbox" name="18"    value="18"    id="18R"> Logs<br>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar rol">Grabar rol</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
