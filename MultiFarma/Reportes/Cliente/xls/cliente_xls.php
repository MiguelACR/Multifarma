<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Cliente.xls");
	
	require_once ('../../../Modelo/modeloCliente.php');
	$cliente = new Cliente();
	$listado = $cliente->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="8">Listado de Clientes</th></tr>
			<tr><th>Identificacion</th><th>Nombres</th><th>Apellidos</th><th>Direccion</th><th>Telefono</th>
			<th>Pais</th><th>Ciudad</th><th>Email</th></tr>
			<?php foreach($listado as $fila){ ?>
					<tr><td><?php echo $fila->id_cliente ?> </td>
					<td><?php echo $fila->nombre_cliente; ?></td>
					<td><?php echo $fila->apellido_cliente; ?></td>
                    <td><?php echo $fila->direccion_cliente; ?></td>
                    <td><?php echo $fila->telefono_cliente; ?></td>
                    <td><?php echo $fila->nombre_pais; ?></td>
                    <td><?php echo $fila->nombre_ciudad; ?></td>
                    <td><?php echo $fila->email_cliente; ?></td>
					</tr>
			<?php } ?>
		</table>
	</body>
</html>