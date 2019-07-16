<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(12);
?>
 <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpresentacion">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_presentacion">Descripción:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_presentacion" name="nombre_presentacion" placeholder="Ingrese la descripción de la presentación"
                            value = "">
                            <span data-key="nombre_presentacion" class="label label-danger"></span>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Presentacion">Grabar Presentación</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
</div>