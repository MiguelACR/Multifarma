<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Farmacia.xls");
	
	require_once ('../../../Modelo/modeloFarmacia.php');
	$farmacia = new Farmacia();
	$listado = $farmacia->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="8">Listado de Farmacias</th></tr>
			<tr><th>Codigo</th><th>Nombre</th><th>Direccion</th><th>Telefono</th><th>Pais</th>
			<th>Ciudad</th><th>Propietario</th><th>Administrador</th></tr>
			<?php foreach($listado as $fila){ ?>
					<tr><td><?php echo $fila->id_farmacia ?> </td>
					<td><?php echo $fila->nombre_farmacia; ?></td>
					<td><?php echo $fila->direccion_farmacia; ?></td>
					<td><?php echo $fila->telefono_farmacia; ?></td>
                    <td><?php echo $fila->nombre_pais; ?></td>
                    <td><?php echo $fila->nombre_ciudad; ?></td>
                    <td><?php echo $fila->nombre_propietario; ?></td>
                    <td><?php echo $fila->nickname_usuario; ?></td>
					</tr>
			<?php } ?>
		</table>
	</body>
</html>