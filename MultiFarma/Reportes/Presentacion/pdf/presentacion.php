<?php
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Presentacion</title>
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

                    <span class="h1">Presentaciones</span>	
                </div>
			</td>
		</tr>
	</table>
	<table id="detalle_head">
			<thead>
				<tr>
					<th width="50px">Codigo</th>
					<th class="textleft">Descripción</th>
				</tr>
			</thead>
			<tbody id="detalle_body">

			<?php

				if($detalle_presentaciones > 0){

					foreach($detalle_presentaciones as $contenido){
			 ?>
				<tr>
					<td class="textcenter"><?php echo $contenido->id_presentacion; ?></td>
					<td><?php echo $contenido->nombre_presentacion; ?></td>
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