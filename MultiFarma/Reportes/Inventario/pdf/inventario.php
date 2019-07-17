<?php
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inventario</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<div id="page_pdf">
	<table id="html_head">
	<tr>
			<td class="logo_empresa">
				<div>
					<img src="../../logo.png">
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">Multi_farma</span>
					<p>Cra 97 # 45 - 57</p>
					<p>Teléfono: +(572) 385-3433</p>
					<p>Email: multifarma@gmail.com</p>
				</div>
			</td>
			<td class="info_reporte">
				<div class="round">
                    <span class="h3">Reporte de:</span>	

                    <span class="h1">Inventario</span>	
                </div>
			</td>
		</tr>
	</table>
	<table id="detalle_head">
			<thead>
				<tr>
					<th width="50px">Farmacia</th>
					<th class="textleft">Producto</th>
					<th class="textleft">Entradas</th>
                    <th class="textleft">Salidas</th>
                    <th class="textleft">Stock</th>
                    <th class="textleft">Valor unitario</th>
                    <th class="textleft">Valor venta</th>
                    <th class="textleft">Fecha</th>
				</tr>
			</thead>
			<tbody id="detalle_body">

			<?php

				if($detalle_inventarios > 0){

					foreach($detalle_inventarios as $contenido){
			 ?>
				<tr>
					<td class="textcenter"><?php echo $contenido->nombre_farmacia; ?></td>
					<td><?php echo $contenido->detalle_producto; ?></td>
					<td><?php echo $contenido->entradas; ?></td>
                    <td><?php echo $contenido->salidas; ?></td>
                    <td><?php echo $contenido->stock; ?></td>
                    <td><?php echo $contenido->valor_unitario; ?></td>
                    <td><?php echo $contenido->valor_venta; ?></td>
                    <td><?php echo $contenido->fecha_registro; ?></td>
				</tr> 
				
			<?php
					}
				}

				
			?>
			</tbody>
	</table>
	<div>
		<h4 class="label_gracias">¡Vuelva pronto!</h4>
	</div>
</div>
</body>
</html>