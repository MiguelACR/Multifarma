<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(11);
?>
<!-- quick email widget -->

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fproducto" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_producto">Descripción:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" placeholder="Ingrese la descripción del producto"
                            value = "">
                            <span data-key="nombre_producto" class="label label-danger"></span>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="control-label col-sm-2" for="foto_producto">Imagen:</label>
                        <div class="input-group col-sm-9">
                            <input type="file" id="foto_producto" name="foto_producto" placeholder=""
                            value = "">
                            <span data-key="foto_producto" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_presentacion">Presentación:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
                            <select class="form-control" id="id_presentacion" name="id_presentacion">
                            <option value="" selected>Seleccione ...</option>
							
							</select>	
                            <span data-key="id_presentacion" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_proveedor">Proveedor:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                            <select class="form-control" id="id_proveedor" name="id_proveedor">
                            <option value="" selected>Seleccione ...</option>
							
							</select>
                            <span data-key="id_proveedor" class="label label-danger"></span>	
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Producto">Grabar Producto</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>