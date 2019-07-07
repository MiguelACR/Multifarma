<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Ciudad.xls");
	
	require_once ('../../../Modelo/modeloCiudad.php');
	$ciudad = new Ciudad();
	$listado = $ciudad->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="3">Listado de Ciudades</th></tr>
			<tr><th>Codigo</th><th>Descripcion</th><th>Pais</th></tr>
			<?php foreach($listado as $fila){ ?>
					<tr><td><?php echo $fila->id_ciudad ?> </td>
					<td><?php echo $fila->nombre_ciudad ?> </td>
					<td><?php echo $fila->nombre_pais ?> </td> 
					</tr>
			<?php } ?>
		</table>
	</body>
</html>
	