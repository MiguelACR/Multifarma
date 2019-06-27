<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(7);
?>
      
      <h1>
        Gestión de
        <small>  Inventarios</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inventario</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Listado de Inventario</h3>
              <div class="box-tools pull-right">
              <button class="btn btn-info btn-sm" id="nuevo"  data-toggle="tooltip" 
                      title="Nuevo inventario"><i class="fa fa-plus" aria-hidden="true"></i></button> 
              </div>
            </div>
           
        
            <!-- /.box-header -->
            <div class="box-body">
            <div id="editar"></div>
            <div id="listado">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Farmacia</th>
                  <th>Producto</th>
				          <th>Entradas</th>
                  <th>Salidas</th>
                  <th>Stock</th>
                  <th>Valor unitario</th>
                  <th>Valor venta</th>
                  <th>Fecha</th>
                  <th>Acciones</th>       
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                <tfoot>
                <tr>
                  <th>Farmacia</th>
                  <th>Producto</th>
				          <th>Entradas</th>
                  <th>Salidas</th>
                  <th>Stock</th>
                  <th>Valor unitario</th>
                  <th>Valor venta</th>
                  <th>Fecha</th>
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

<script src="./Recursos/js/funcionesInventario.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
    $(document).ready(inventario);
</script>

