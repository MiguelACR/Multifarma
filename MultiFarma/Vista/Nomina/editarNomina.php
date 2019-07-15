<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(9);
?>
<!-- quick email widget -->
    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fnomina">
                   <div class="form-group">
                        <label class="control-label col-sm-2" for="id_empleado">Empleado:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <select class="form-control" id="id_empleado" name="id_empleado">
                            <option value="" selected>Seleccione ...</option>
                              
                            </select>
                            <span data-key="id_empleado" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_basico">Salario basico:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            <input type="text" class="form-control" id="salario_basico" name="salario_basico" placeholder="Ingrese el valor del salario basico" 
                            value="">
                            <span data-key="salario_basico" class="label label-danger"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="hextrasd">Horas extras día:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-certificate"></i></span>
                            <input type="text" class="form-control" id="hextrasd" name="hextrasd" placeholder="Ingrese la cantidad de horas extras diurnas" 
                            value="">
                            <span data-key="hextrasd" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="hextrasn">Horas extras noche:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-moon-o"></i></span>
                            <input type="text" class="form-control" id="hextrasn" name="hextrasn" placeholder="Ingrese cantidad de horas extras nocturnas" 
                            value="">
                            <span data-key="hextrasn" class="label label-danger"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="auxilio_transporte">Auxilio de trasporte:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-bus"></i></span>
                            <input type="text" class="form-control" id="auxilio_transporte" name="auxilio_transporte" placeholder="Ingrese el valor del auxilio de trasporte"
                            value="">
                            <span data-key="auxilio_transporte" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_hextrad">Valor extra dia:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control" id="valor_hextrad" name="valor_hextrad" placeholder="Ingrese el valor de la hora extra dia" 
                            value="">
                            <span data-key="valor_hextrad" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_hextran">Valor extra noche:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control" id="valor_hextran" name="valor_hextran" placeholder="Ingrese el valor de la hora extra noche" 
                            value="">
                            <span data-key="valor_hextran" class="label label-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dias_laborados">Dias laborados:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                            <input type="text" class="form-control" id="dias_laborados" name="dias_laborados" placeholder="Ingrese la cantidad de días laborados" 
                            value="">
                            <span data-key="dias_laborados" class="label label-danger"></span>
                        </div>
                    </div>
                   
                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_devengado">Salario devengado:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            <input type="text" class="form-control" id="salario_devengado" name="salario_devengado" placeholder="Salario devengado" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salud">Salud:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-stethoscope"></i></span>
                            <input type="text" class="form-control" id="salud" name="salud" placeholder="salud" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pension">Pension:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-rub"></i></span>
                            <input type="text" class="form-control" id="pension" name="pension" placeholder="Pension" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_neto">Salario neto:</label>
                        <div class="input-group col-sm-9">
                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                            <input type="text" class="form-control" id="salario_neto" name="salario_neto" placeholder="Salario Neto" value=""
                            readonly="true">
                        </div>
                    </div>
                    
					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Nomina">Actualizar Nomina</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

			</fieldset>

		</form>
	</div>
