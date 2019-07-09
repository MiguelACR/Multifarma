<?php
 ?>
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
					<img src="../../logo.png">
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">Multifarma</span>
					<p>Sede principal: cra 88 # 10 - 13 Bogota</p>
					<p>NIT: 58-15963251256</p>
					<p>Teléfono: +57 1 7449405</p>
					<p>Email: multifarma@gmail.com</p>
				</div>
			</td>
			<td class="info_reporte">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?php echo $noFactura; ?></strong></p>
					<p>Fecha: <?php echo $fecha; ?></p>
					<p>Hora: <?php echo $hora; ?></p>
					<p>Vendedor: <?php echo $vendedor; ?></p>
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
							<td><label>Identificación:</label><p><?php echo $id_cliente; ?></p></td>
							<td><label>Teléfono:</label> <p><?php echo $telefono_cliente; ?></p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p><?php echo $nombre; ?></p></td>
							<td><label>Dirección:</label> <p><?php echo $direccion_cliente; ?></p></td>
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
					<td class="textright"><span><?php echo $valor_factura; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>Iva (19 %):</span></td>
					<td class="textright"><span><?php echo $iva_factura; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>Total:</span></td>
					<td class="textright"><span><?php echo $neto_factura; ?></span></td>
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