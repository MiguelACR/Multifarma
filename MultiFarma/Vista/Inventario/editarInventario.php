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
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                            <select class="form-control" id="id_farmacia" name="id_farmacia">
                            <option value="" selected>Seleccione ...</option>
							
							</select>
                            <span data-key="id_farmacia" class="label label-danger"></span>	
                        </div>
                </div>

                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_producto">Producto:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-plus-square"></i></span>
                            <select class="form-control" id="id_producto" name="id_producto">
                            <option value="" selected>Seleccione ...</option>
							
							</select>
                            <span data-key="id_producto" class="label label-danger"></span>	
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="entradas">Entradas:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>
                            <input type="text" class="form-control" id="entradas" name="entradas" placeholder="Ingrese las entradas"
                            value = "">
                            <span data-key="entradas" class="label label-danger"></span>	
                        </div>
                    </div>

					<div class="form-group">
                        <label class="control-label col-sm-2" for="salidas">Salidas:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-arrow-left"></i></span>
                            <input type="text" class="form-control" id="salidas" name="salidas" placeholder="Automatico"
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="stock">Stock:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                            <input type="text" class="form-control" id="stock" name="stock" placeholder="Automatico"
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_unitario">Valor unitario:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" placeholder="Ingrese el valor unitario"
                            value = "">
                            <span data-key="valor_unitario" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_venta">Valor venta:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-money"></i></span>
                            <input type="text" class="form-control" id="valor_venta" name="valor_venta" placeholder="Ingrese el valor venta"
                            value = "">
                            <span data-key="valor_venta" class="label label-danger"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fecha_registro">Fecha:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>
                            <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" placeholder="Automatico"
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