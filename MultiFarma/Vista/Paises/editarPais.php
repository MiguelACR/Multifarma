<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(10);
?>
<div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fpais">
                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_pais">Codigo:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                            <input type="text" class="form-control" id="id_pais" name="id_pais" placeholder="Ingrese el codigo del pais"
                            value = "" readonly="true">
                            <span data-key="id_pais" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="abreviatura_pais">Abreviatura:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="abreviatura_pais" name="abreviatura_pais" placeholder="Ingrese la abreviatura del pais"
                            value = "">
                            <span data-key="abreviatura_pais" class="label label-danger"></span>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="nombre_pais">Nombre:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                            <input type="text" class="form-control" id="nombre_pais" name="nombre_pais" placeholder="Ingrese el nombre del pais"
                            value = "">
                            <span data-key="nombre_pais" class="label label-danger"></span>
                        </div>
                    </div>

					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar pais">Actualizar pais</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

            </fieldset>	

		</form>
	</div>