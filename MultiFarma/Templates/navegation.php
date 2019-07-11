<?php include_once ("./Funciones/sessiones.php");?>
<aside class="main-sidebar">
	  
   <section class="sidebar">
	   
    <div class="user-panel">
     <div class="pull-left image">
      <img src="Recursos/img/Homedrug.png" class="img-circle" alt="User Image">
     </div>
     <div class="pull-left info">
      <p>Porque tu salud es:</p>
      <p>lo primero para nosotros.</p>
     </div>   
    </div>

   <ul class="sidebar-menu" data-widget="tree">
    <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Menu</span>
    </a>
    <ul class="treeview-menu">
    <li style="visibility: visible; display: <?php echo $_SESSION["1NA"]; ?>;"><a href="./Vista/Ciudades/ciudad.php"><i class="fa fa-globe"></i> <span>Ciudades</span></a></li>
    <li style="visibility: visible; display: <?php echo $_SESSION["2NA"]; ?>;"><a href="./Vista/Clientes/clientes.php"><i class="fa fa-user"></i> <span>Clientes</span></a></li>  
    <li style="visibility: visible; display: <?php echo $_SESSION["3NA"]; ?>;"><a href="./Vista/Empleados/empleados.php"><i class="fa fa-male"></i> <span>Empleados</span></a></li>
    <li style="visibility: visible; display: <?php echo $_SESSION["4NA"]; ?>;"><a href="./Vista/Factura/factura.php"><i class="fa fa-calculator"></i> <span>Facturas</span></a></li>
	  <li style="visibility: visible; display: <?php echo $_SESSION["5NA"]; ?>;"><a href="./Vista/Venta/venta.php"><i class="fa  fa-money"></i> <span>Ventas</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["6NA"]; ?>;"><a href="./Vista/Farmacia/farmacia.php"><i class="fa fa-hospital-o"></i> <span>Farmacias</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["7NA"]; ?>;"><a href="./Vista/Inventario/inventario.php"><i class="fa fa-table"></i> <span>Inventario</span></a></li>
	  <li style="visibility: visible; display: <?php echo $_SESSION["8NA"]; ?>;"><a href="#"><i class="fa fa-hourglass-2"></i> <span>Ofertas</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["9NA"]; ?>;"><a href="./Vista/Nomina/nomina.php"><i class="fa fa-usd"></i> <span>Nomina</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["10NA"]; ?>;"><a href="./Vista/Paises/pais.php"><i class="fa fa-globe"></i> <span>Paises</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["11NA"]; ?>;"><a href="./Vista/Producto/producto.php"><i class="fa  fa-plus-square"></i> <span>Productos</span></a></li>
    <li style="visibility: visible; display: <?php echo $_SESSION["12NA"]; ?>;"><a href="./Vista/Presentacion/presentacion.php"><i class="fa fa-medkit"></i> <span>Presentaciones</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["13NA"]; ?>;"><a href="./Vista/Propietario/propietario.php"><i class="fa fa-black-tie"></i> <span>Propietarios</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["14NA"]; ?>;"><a href="./Vista/Proveedor/proveedor.php"><i class="fa fa-flask"></i> <span>Proveedores</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["15NA"]; ?>;"><a href="./Vista/Usuarios/usuarios.php"><i class="fa fa-user-plus"></i> <span>Usuarios</span></a></li>
		<li style="visibility: visible; display: <?php echo $_SESSION["16NA"]; ?>;"><a href="./Vista/roles/roles.php"><i class="fa fa-users"></i> <span>Roles</span></a></li>
	  <li style="visibility: visible; display: <?php echo $_SESSION["17NA"]; ?>;"><a href="./Vista/Carousel/Carousel.php"><i class="fa fa-map-o"></i> <span>Carosuel</span></a></li>
	  <li style="visibility: visible; display: <?php echo $_SESSION["18NA"]; ?>;"><a href="#"><i class="fa fa-safari"></i> <span>Logs</span></a></li>


    </ul>  
    </li>
    
  </section>
 </aside>