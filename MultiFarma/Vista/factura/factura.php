<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(4);
?>

<h1>
        Gestión de
        <small>  Facturas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Factura</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Facturas</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Codigo factura</th>
                  <th>Cliente</th>
				          <th>Empleado</th>
                  <th>Fecha</th>
                  <th>Subtotal</th>
                  <th>Iva</th>
                  <th>Total</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Codigo factura</th>
                  <th>Cliente</th>
				          <th>Empleado</th>
                  <th>Fecha</th>
                  <th>Subtotal</th>
                  <th>Iva</th>
                  <th>Total</th>
                  <th>Estado</th>
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

<script src="./Recursos/js/funcionesFactura.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(factura);
</script>