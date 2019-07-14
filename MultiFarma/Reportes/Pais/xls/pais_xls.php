<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Pais.xls");
	
	require_once ('../../../Modelo/modeloPais.php');
    $model = new Pais();
    $detalle_paises = $model->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="3">Listado de Paises</th></tr>
			<tr>
                    <th>Codigo</th>
					<th>Abreviatura</th>
					<th>Nombre</th>
			</tr>
			<?php foreach($detalle_paises as $contenido){ ?>
                <tr>
                    <td><?php echo $contenido->id_pais; ?></td>
					<td><?php echo $contenido->abreviatura_pais; ?></td>
					<td><?php echo $contenido->nombre_pais; ?></td>
				</tr> 
			<?php } ?>
		</table>
	</body>
</html>