<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Presentacion.xls");
	
	require_once ('../../../Modelo/modeloPresentacion.php');
    $model = new Presentacion();
    $detalle_presentaciones = $model->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="2">Listado de Presentaciones</th></tr>
			<tr>
                    <th>Codigo</th>
					<th>Descripcion</th>
			</tr>
			<?php foreach($detalle_presentaciones as $contenido){ ?>
                <tr>
                    <td><?php echo $contenido->id_presentacion; ?></td>
					<td><?php echo $contenido->nombre_presentacion; ?></td>
				</tr> 
			<?php } ?>
		</table>
	</body>
</html>