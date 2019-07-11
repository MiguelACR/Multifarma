<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Inventario.xls");
	
	require_once ('../../../Modelo/modeloInventario.php');
	$inventario = new Inventario();
	$listado = $inventario->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="8">Listado de Inventarios</th></tr>
			<tr><th>Farmacia</th><th>Producto</th><th>Entradas</th><th>Salidas</th><th>Stock</th>
			<th>Valor unitario</th><th>Valor venta</th><th>Fecha</th></tr>
			<?php foreach($listado as $fila){ ?>
					<tr><td><?php echo $fila->nombre_farmacia; ?> </td>
					<td><?php echo $fila->detalle_producto; ?></td>
					<td><?php echo $fila->entradas; ?></td>
					<td><?php echo $fila->salidas; ?></td>
                    <td><?php echo $fila->stock; ?></td>
                    <td><?php echo $fila->valor_unitario; ?></td>
                    <td><?php echo $fila->valor_venta; ?></td>
                    <td><?php echo $fila->fecha_registro; ?></td>
					</tr>
			<?php } ?>
		</table>
	</body>
</html>