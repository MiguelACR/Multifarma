<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(7);
?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="finventario">
                
                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_farmacia">Farmacia:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_farmacia" name="id_farmacia">
                            <option value="" selected>Seleccione ...</option>
							
							</select>	
                        </div>
                </div>

                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_producto">Producto:</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_producto" name="id_producto">
                            <option value="" selected>Seleccione ...</option>
							
							</select>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="entradas">Entradas:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="entradas" name="entradas" placeholder=""
                            value = "">
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="salidas">Salidas:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="salidas" name="salidas" placeholder=""
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="stock">Stock:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stock" name="stock" placeholder=""
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_unitario">Valor unitario:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" placeholder=""
                            value = "">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_venta">Valor venta:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="valor_venta" name="valor_venta" placeholder=""
                            value = "">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fecha_registro">Fecha:</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" placeholder=""
                            value = "">
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Inventario">Actualizar Inventario</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>