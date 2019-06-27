<?php include_once ("../../Funciones/sessiones.php"); ?>

<h1>
        Gestión de
        <small>  Nominas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nomina</li>
      </ol>
    </section>

 <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Nominas</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva Nomina"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>


        <!-- /.box-header -->
        <div class="box-body">
          <div id="editar"></div>
          <div id="listado">
            <table id="tabla" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id Nomina</th>
                  <th>Id Empleado</th>
                  <th>Fecha</th>
                  <th>salario Basico</th>
                  <th>Horas Ext. Dia</th>
                  <th>Horas Ext. Noche</th>
                  <th>Auxilio transporte</th>
                  <th>Val. H. Ext. Dia</th>
                  <th>Val. H. Ext. Noche</th>
                  <th>Dias Laborados</th>
                  <th>Salario Devengado</th>
                  <th>Pension</th>
                  <th>Salud</th>
                  <th>Salario Neto</th>
                  <th>Acciones</th>

                </tr>
              </thead>
              <tbody>


              </tbody>
                <tfoot>
                <tr>
                  <th>Id Nomina</th>
                  <th>Id Empleado</th>
                  <th>Fecha</th>
                  <th>salario Basico</th>
                  <th>Horas Ext. Dia</th>
                  <th>Horas Ext. Noche</th>
                  <th>Auxilio transporte</th>
                  <th>Val. H. Ext. Dia</th>
                  <th>Val. H. Ext. Noche</th>
                  <th>Dias Laborados</th>
                  <th>Salario Devengado</th>
                  <th>Pension</th>
                  <th>Salud</th>
                  <th>Salario Neto</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<script src="./Recursos/js/funcionesNomina.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(nomina);
</script>