<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(9);
?>

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
                      title="Nueva nomina"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                  <button class="btn btn-danger btn-sm" id="reportes"  data-toggle="modal" 
                  data-target="#modal-reportes" title="Nuevo reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button> 
              </div>
              </div>
            </div>


        <!-- /.box-header -->
        <div class="box-body bg-info">
          <div id="editar"></div>
          <div id="listado">
            <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Cod</th>
                  <th>Empleado</th>
                  <th>Fecha</th>
                  <th>Salario basico</th>
                  <th>Horas extras día</th>
                  <th>Horas extras noche</th>
                  <th>Auxilio transporte</th>
                  <th>Valor extras día</th>
                  <th>Valor extras noche</th>
                  <th>Días Laborados</th>
                  <th>Salario Devengado</th>
                  <th>Pensión</th>
                  <th>Salud</th>
                  <th>Salario Neto</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>


              </tbody>
                <tfoot>
                <tr>
                  <th>Cod</th>
                  <th>Empleado</th>
                  <th>Fecha</th>
                  <th>Salario basico</th>
                  <th>Horas extras día</th>
                  <th>Horas extras noche</th>
                  <th>Auxilio transporte</th>
                  <th>Valor extras día</th>
                  <th>Valor extras noche</th>
                  <th>Días Laborados</th>
                  <th>Salario Devengado</th>
                  <th>Pensión</th>
                  <th>Salud</th>
                  <th>Salario Neto</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
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