<?php
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nomina</title>
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

                    <span class="h1">Nominas</span>	
                </div>
			</td>
		</tr>
	</table>
	<table id="detalle_head">
			<thead>
				<tr>
					<th width="50px">Cod</th>
					<th class="textleft">Empleado</th>
					<th class="textleft">Fecha</th>
                    <th class="textleft">Salario basico</th>
                    <th class="textleft">Horas extras días</th>
                    <th class="textleft">Horas extras noche</th>
                    <th class="textleft">Auxilio transporte</th>
                    <th class="textleft">Valor extras día</th>
                    <th class="textleft">Valor extras noche</th>
                    <th class="textleft">Días laborados</th>
                    <th class="textleft">Salario devengado</th>
                    <th class="textleft">Pensión</th>
                    <th class="textleft">Salud</th>
                    <th class="textleft">Salario neto</th>
				</tr>
			</thead>
			<tbody id="detalle_body">

			<?php

				if($detalle_nominas > 0){

					foreach($detalle_nominas as $contenido){
			 ?>
				<tr>
					<td class="textcenter"><?php echo $contenido->id_nomina; ?></td>
					<td><?php echo $contenido->nombre; ?></td>
					<td><?php echo $contenido->fecha; ?></td>
                    <td><?php echo $contenido->salario_basico; ?></td>
                    <td><?php echo $contenido->hextrasd; ?></td>
                    <td><?php echo $contenido->hextrasn; ?></td>
                    <td><?php echo $contenido->auxilio_transporte; ?></td>
                    <td><?php echo $contenido->valor_hextrad; ?></td>
                    <td><?php echo $contenido->valor_hextran; ?></td>
                    <td><?php echo $contenido->dias_laborados; ?></td>
                    <td><?php echo $contenido->salario_devengado; ?></td>
                    <td><?php echo $contenido->pension; ?></td>
                    <td><?php echo $contenido->salud; ?></td>
                    <td><?php echo $contenido->salario_neto; ?></td>
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