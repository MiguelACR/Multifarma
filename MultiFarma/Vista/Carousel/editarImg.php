<?php include_once ("../../Funciones/sessiones.php"); ?>

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fcarousel">
 					<div class="form-group">


                        <label class="control-label col-sm-2" for="id_carousel">Id Carousel:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_carousel" name="id_carousel"
                            value = "" readonly="true"  data-validation="length alphanumeric" data-validation-length="3-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="imagen">Imagen:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="imagen" name="imagen"
                            value = "">
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar">Actualizar rol</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>
                    
                    <input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
