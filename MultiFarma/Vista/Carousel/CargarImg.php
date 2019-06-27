<?php include_once ("../../Funciones/sessiones.php"); ?>

    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fcarousel" name="fcarousel">

 					<div class="form-group">
                        <label class="control-label col-sm-2" for="id_carousel">Id Carousel:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_carousel" name="id_carousel" placeholder="Automatico"
                            value = "" readonly="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="imagen">Imagen:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Ingrese la Imagen"
                            value = "">
                        </div>
                    </div>
					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar Id Carousel">Grabar Carousel</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>
