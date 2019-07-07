<?php

 //print_r($configuracion); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
<?php echo $anulada; ?>
<div id="page_pdf">
	<table id="html_head">
		<tr>
			<td class="logo_empresa">
				<div>
					<img src="img/logo.png">
				</div>
			</td>
			<td class="info_empresa">
				<?php
					//if($result_config > 0){
						//$iva = $configuracion['iva'];
				 ?>
				<div>
					<span class="h2">Multifarma</span>
					<!--<p><?php //echo $configuracion['razon_social']; ?></p>-->
					<p>Sede principal: cra 88 # 10 - 13 Bogota</p>
					<p>NIT: 58-15963251256</p>
					<p>Teléfono: +57 1 7449405</p>
					<p>Email: multifarma@gmail.com</p>
				</div>
				<?php
				 ?>
			</td>
			<td class="info_reporte">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?php echo $noFactura; ?></strong></p>
					<p>Fecha: <?php echo $registroFactura->fecha; ?></p>
					<p>Hora: <?php echo $registroFactura->hora; ?></p>
					<p>Vendedor: <?php echo $registroFactura->vendedor; ?></p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Identificación:</label><p><?php echo $registroFactura->id_cliente; ?></p></td>
							<td><label>Teléfono:</label> <p><?php echo $registroFactura->telefono_cliente; ?></p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p><?php echo $registroFactura->nombre; ?></p></td>
							<td><label>Dirección:</label> <p><?php echo $registroFactura->direccion_cliente; ?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="detalle_head">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_body">

			<?php

				if($detalle_productos > 0){

					foreach($detalle_productos as $contenido){
			 ?>
				<tr>
					<td class="textcenter"><?php echo $contenido->cantidad; ?></td>
					<td><?php echo $contenido->nombre_producto; ?></td>
					<td class="textright"><?php echo $contenido->precio; ?></td>
					<td class="textright"><?php echo $contenido->total; ?></td>
				</tr>
			<?php
					}
				}

				
			?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>Subtotal:</span></td>
					<td class="textright"><span><?php echo $registroFactura->valor_factura; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>Iva (19 %):</span></td>
					<td class="textright"><span><?php echo $registroFactura->iva_factura; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>Total:</span></td>
					<td class="textright"><span><?php echo $registroFactura->neto_factura; ?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<p class="nota">Esta factura y todo aquello que se presenta en este software es totalmente ficticio
            y tiene un solo fin el cual es educar y aprender.

		</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>