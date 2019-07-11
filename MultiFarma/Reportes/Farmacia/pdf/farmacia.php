<?php
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Farmacia</title>
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

                    <span class="h1">Farmacia</span>	
                </div>
			</td>
		</tr>
	</table>
	<table id="detalle_head">
			<thead>
				<tr>
					<th width="50px">Codigo</th>
					<th class="textleft">Nombre</th>
					<th class="textleft">Dirección</th>
                    <th class="textleft">Telefono</th>
                    <th class="textleft">Pais</th>
                    <th class="textleft">Ciudad</th>
                    <th class="textleft">Propietario</th>
                    <th class="textleft">Administrador</th>
				</tr>
			</thead>
			<tbody id="detalle_body">

			<?php

				if($detalle_empleados > 0){

					foreach($detalle_empleados as $contenido){
			 ?>
				<tr>
					<td class="textcenter"><?php echo $contenido->id_farmacia; ?></td>
					<td><?php echo $contenido->nombre_farmacia; ?></td>
					<td><?php echo $contenido->direccion_farmacia; ?></td>
                    <td><?php echo $contenido->telefono_farmacia; ?></td>
                    <td><?php echo $contenido->nombre_pais; ?></td>
                    <td><?php echo $contenido->nombre_ciudad; ?></td>
                    <td><?php echo $contenido->nombre_propietario; ?></td>
                    <td><?php echo $contenido->nickname_usuario; ?></td>
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