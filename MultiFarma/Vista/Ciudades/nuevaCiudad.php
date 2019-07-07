<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(1);
?>
<!-- quick email widget -->
<div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fciudad">
 					
                <div class="form-group">
                            <label class="control-label col-sm-2" for="id_ciudad">Codigo:</label>
                            <div class="input-group col-sm-9">
                                <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                <input type="text" class="form-control" id="id_ciudad" name="id_ciudad"
                                    placeholder="Ingrese Codigo" value="">
                                <span data-key="id_ciudad" class="label label-danger"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nombre_ciudad">Nombre:</label>
                            <div class="input-group col-sm-9">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" class="form-control" id="nombre_ciudad" name="nombre_ciudad"
                                    placeholder="Ingrese nombre de la ciudad" value="">
                                <span data-key="nombre_ciudad" class="label label-danger"></span>
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
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="grabar" class="btn btn-primary" data-toggle="tooltip" title="Grabar ciudad">Grabar ciudad</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="nuevo" name="accion"/>
			</fieldset>

		</form>
	</div>