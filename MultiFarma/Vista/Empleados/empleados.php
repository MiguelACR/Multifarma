<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(3);
?>
      
      <h1>
        Gestión de
        <small>  Empleados</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Empleado</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Empleados</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nueva Empleado"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                  <button class="btn btn-danger btn-sm" id="reportes"  data-toggle="modal" 
                  data-target="#modal-reportes" title="Nuevo reporte"><i class="fa fa-file-text" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body bg-info">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cargo</th>
                  <th>Pais</th>
                  <th>Ciudad</th>
                  <th>Dirección</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Farmacia</th>
                  <th>&nbsp;</th>
                  <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cargo</th>
                  <th>Pais</th>
                  <th>Ciudad</th>
                  <th>Dirección</th>
                  <th>Telefono</th>
                  <th>Email</th>
                  <th>Farmacia</th>
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

<script src="./Recursos/js/funcionesEmpleado.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(empleado);
</script>


