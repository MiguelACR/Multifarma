<?php include_once ("../../Funciones/sessiones.php"); 
usuarioAutenticado(5);
?>
      
      <h1>
        Gestión de
        <small>  Ventas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

         <div class="box" id="box-panel-one">

            <div class="box-header with-border">
              <h3 class="box-title">Generar una venta</h3>
              <div class="box-tools pull-right">
                  <button class="btn btn-primary btn-sm" id="procesar"  data-toggle="tooltip" 
					        title="Procesar venta"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
				          <button class="btn btn-danger btn-sm" id="cancelar"  data-toggle="tooltip" 
                      title="Cancelar venta"><i class="fa fa-ban" aria-hidden="true"></i></button> 
              </div>

              
      <div class="box-body">
        
			<div class="box box-primary" id="box-panel-two">
      
      <div class="box-header with-border">
			<h3 class="box-title">Datos del cliente y el vendedor</h3>
		   <div class="box-tools pull-right">
			  <button class="btn btn-default btn-sm" id="nuevo"  data-toggle="tooltip" 
					  title="Crear cliente"><i class="fa fa-plus" aria-hidden="true"></i></button>
        <button class="btn btn-default btn-sm" id="grabar"  data-toggle="tooltip" 
					  title="Grabar cliente"><i class="fa fa-save" aria-hidden="true"></i></button>	
       </div>
       </div>

			<div class="box-body">

      <form class="AVAST_PAM_nonloginform" role="form"  id="fventa">

      <div class="form-group">
			
        <label class="control-label col-sm-2" for="id_cliente">Identificación:</label>
          <div class="col-sm-3">
            <input type="text" class="form-control" id="id_cliente" name="id_cliente" placeholder="Ingrese la identificación"
            value = ""  data-validation="length alphanumeric" data-validation-length="3-12">
          </div>
		
        <label class="control-label col-sm-2" for="nombre_cliente">Nombres:</label>
         <div class="col-sm-5">
          <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder=""
          value = "">
         </div>
			
      </div>
      <br>
      <br>
      <br>
			<div class="form-group">

          <label class="control-label col-sm-2" for="telefono_cliente">Telefono:</label>
           <div class="col-sm-3">
            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder=""
            value = "">
           </div>
     
          <label class="control-label col-sm-2" for="apellido_cliente">Apellidos:</label>
           <div class="col-sm-5">
            <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder=""
            value = "">
           </div>

      </div>
      <br>
      <br>
      <div class="form-group">

            <label class="control-label col-sm-2" for="id_pais">Pais:</label>
            <div class="col-sm-3">
              <select class="form-control" id="id_pais" name="id_pais">
                            
							</select>	
            </div>
            
  
            <label class="control-label col-sm-2" for="id_ciudad">Ciudad:</label>
            <div class="col-sm-5">
              <select class="form-control" id="id_ciudad" name="id_ciudad">
                            
              </select>	
            </div>
                       
      </div>
      <br>
      <br>
      <div class="form-group">
            <label class="control-label col-sm-2" for="direccion_cliente">Dirección:</label>
             <div class="col-sm-10">
              <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" placeholder=""
              value = "" readonly="true">
             </div>
      </div>
      <br>
      <br>
      <div class="form-group">
            <label class="control-label col-sm-2" for="nombre_empleado">Vendedor:</label>
             <div class="col-sm-10">
              <input type="text" class="form-control" id="nombre_empleado" name="nombre_empleado" placeholder=""
              value = "<?php echo $_SESSION["nombre"]; ?>">
             </div>
      </div>

      <input type="hidden" id="nuevo" value="nuevo" name="accion"/>

      </div>
      <!-- /.box id="box-panel-two" -->
			</div>

      <div class="box box-primary" id="box-panel-three">

      <div class="box-header with-border">
      <h3 class="box-title">Producto</h3>
      <div class="box-tools pull-right">
      <h3 style="color:green" class="box-title">Datos de la venta</h3>
      </div>
      </div>
      <div class="box-body">
      <table id="tablaP" class="table">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Descripción</th>
				          <th>Existencia</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Precio total</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
                <td><input type="text" name="id_producto" id="id_producto" style="width:50px"></td>
                <td id="nombre_producto">-</td>
                <td id="stock">-</td>
                <td><input type="text" name="cantidad_producto" id="cantidad_producto" value="0" min="1"></td>
                <td id="valor_venta" class="textringht">0.00</td>
                <td id="valor_venta_total" class="textringht">0.00</td>
                <td><a href="#" id="add_producto_venta" class="link_add"><i class="fa fa-plus"></i>Agregar</a></td>
                </tbody>
              </table>
      </div>
      <!-- /.box id="box-panel-three" -->
      </div>

      <div class="box box-primary" id="box-panel-four">
      <div class="box-header with-border">
      <h3 class="box-title">Listado de Productos</h3>
      <div class="box-tools pull-right">
      <h3 style="color:green" class="box-title">Datos de la venta</h3>
      </div>
      </div>
      <div class="box-body">
      <table class="table">
                <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Descripción</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Precio total</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody id="tablaD">
                
                </tbody>
      </table>
      <table class="table">
                <thead>
                <tr>
                  <th>SubTotal</th>
                  <th>Iva</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody id="tablaT">
                
                </tbody>
      </table>
      </div>
      <!-- /.box id="box-panel-four" -->
      </div>
      </form>
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

<script src="./Recursos/js/funcionesVenta.js"></script>
<!-- Funciones de Lógica de neogcio -->
<script>
     $("#nombre_cliente").attr('readonly','true');
     $("#telefono_cliente").attr('readonly','true');
     $("#apellido_cliente").attr('readonly','true');
     $("#direccion_cliente").attr('readonly','true');
     $("#nombre_empleado").attr('readonly','true');
     $("#cantidad_producto").attr('disabled','true');

     $("#id_pais").attr('disabled','true');
     $("#id_ciudad").attr('disabled','true');
    
     $("#procesar").attr('disabled','true');
     $('#nuevo').hide();
     $('#grabar').hide();
     $('#add_producto_venta').attr('style','display:none');

    $(document).ready(venta);
</script>
