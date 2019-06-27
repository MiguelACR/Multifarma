<?php include_once ("./Funciones/sessiones.php"); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
     <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
     <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    </ol>
	
    <div class="carousel-inner">
     <div class="carousel-item active" align="center">
      <img src="Recursos/img/Carousel/serral.png" class="d-block w-100" alt="No disponible" style="height: 160px">
    </div>
	  
     <div class="carousel-item" align="center">
      <img src="Recursos/img/Carousel/cilfa.png" class="d-block w-100" alt="No disponible" style="height: 160px">
     </div>
    </div>
	
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
     <span class="sr-only">Previous</span>
    </a>
	
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
     <span class="carousel-control-next-icon" aria-hidden="true"></span>
     <span class="sr-only">Next</span>
    </a>
   </div>	
   <h1 style="font-size: 20px;color: teal;font-family: Constantia, 'Lucida Bright', 'DejaVu Serif', Georgia, 'serif';text-align: center">Menu Productos</h1>
	
   <div class="box box-info">
    <form id="flocalidad" name="flocalidad" method="post" style="line-height: 30px">
     <div style="float:right">
      <button class="fa fa-cart-plus" title="Carrito de compras"></button>
     </div>
     <div style="width: 180px">
      <select id="localidad" name="localidad" class="form-control">
       <option>Seleccione la localidad</option>
      </select>	
     </div>	
    </form>	 
</div>