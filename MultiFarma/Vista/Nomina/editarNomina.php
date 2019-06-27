<?php include_once ("../../Funciones/sessiones.php"); ?>
<!-- quick email widget -->


    <div class="box-body">
        <div class="panel-group"><div class="panel panel-primary">
            <div class="panel-heading">Datos</div>
            <div class="panel-body">    
                <form class="form-horizontal" role="form"  id="fnomina">
                <div class="form-group">
                      
                <div class="form-group">
                        <label class="control-label col-sm-2" for="id_nomina">Id nomina:</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="id_nomina" name="id_nomina" placeholder="Automatico" value=""
                            readonly="true">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id_empleado">Id Empleado</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <select class="form-control" id="id_empleado" name="id_empleado">
                                <option value="" selected>Seleccione ...</option>
                                <?php foreach ($listaNomina as $fila) { ?>
                                    <option value="<?php echo trim($fila['id_empleado']); ?>">
                                        <?php echo utf8_encode(trim($fila['nombre_empleado'])); ?> </option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fecha">Fecha de nomina:</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_basico">Salario basico:</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="salario_basico" name="salario_basico" placeholder="Ingrese el valor del salario basico" value="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="hextrasd">Horas Extras diurnas</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="hextrasd" name="hextrasd" placeholder="Ingrese la cantidad de horas extras diurnas" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="hextrasn">Horas Extras Nocturnas</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="hextrasn" name="hextrasn" placeholder="Ingrese cantidad de horas extras nocturnas" value="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="auxilio_transporte">Auxilio de Trasporte</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="auxilio_transporte" name="auxilio_transporte" placeholder="Ingrese el valor del auxilio de trasporte" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_hextrad">Valor Hora Extra Dia</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="valor_hextrad" name="valor_hextrad" placeholder="Ingrese el valor de la hora extra dia" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="valor_hextran">Valor Hora Extra Noche</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="valor_hextran" name="valor_hextran" placeholder="Ingrese el valor de la hora extra dia" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="dias_laborados;">Dias Laborados</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="dias_laborados" name="dias_laborados" placeholder="Ingrese la cantidad de días laborados" value="">
                        </div>
                    </div>
                   
                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_devengado">Salario Devengdo</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="salario_devengado" name="salario_devengado" placeholder="Auxilio de Trasporte" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salud">Salud</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="salud" name="salud" placeholder="salud" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pension">Pension</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="pension" name="pension" placeholder="Pension" value=""
                            readonly="true">
                        </div>
                    </div>

                    <!-- SE TIENE QUE CALCULAR CON LOS OTROS VALORES  -->
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salario_neto">Salario Neto</label>
                        <div class="input-group col-sm-9" style="width:80%">
                            <input type="text" class="form-control" id="salario_neto" name="salario_neto" placeholder="Salario Neto" value=""
                            readonly="true">
                        </div>
                    </div>
                    
					 <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" id="actualizar" class="btn btn-primary" data-toggle="tooltip" title="Actualizar Comuna">Actualizar Comuna</button>
                            <button type="button" id="cerrar" class="btn btn-success btncerrar" data-toggle="tooltip" title="Cancelar">Cancelar</button>
                        </div>
                    </div>

					<input type="hidden" id="nuevo" value="editar" name="accion"/>
			</fieldset>

		</form>
	</div>
