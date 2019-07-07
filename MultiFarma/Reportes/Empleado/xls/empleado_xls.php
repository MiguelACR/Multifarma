<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Empleado.xls");
	
	require_once ('../../../Modelo/modeloEmpleados.php');
	$empleado = new Empleado();
	$listado = $empleado->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="10">Listado de Empleados</th></tr>
			<tr><th>Identificacion</th><th>Nombres</th><th>Apellidos</th><th>Cargo</th><th>Pais</th>
			<th>Ciudad</th><th>Direccion</th><th>Telefono</th><th>Email</th><th>Farmacia</th></tr>
			<?php foreach($listado as $fila){ ?>
					<tr><td><?php echo $fila->id_empleado ?> </td>
					<td><?php echo $fila->nombre_empleado; ?></td>
					<td><?php echo $fila->apellido_empleado; ?></td>
                    <td><?php echo $fila->cargo_empleado; ?></td>
                    <td><?php echo $fila->nombre_pais; ?></td>
                    <td><?php echo $fila->nombre_ciudad; ?></td>
                    <td><?php echo $fila->direccion_empleado; ?></td>
                    <td><?php echo $fila->telefono_empleado; ?></td>
                    <td><?php echo $fila->email_empleado; ?></td>
                    <td><?php echo $fila->nombre_farmacia; ?></td>
					</tr>
			<?php } ?>
		</table>
	</body>
</html>