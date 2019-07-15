<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Producto.xls");
	
	require_once ('../../../Modelo/modeloProducto.php');
    $model = new Producto();
    $detalle_productos = $model->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="4">Listado de Productos</th></tr>
			<tr>
                    <th>Codigo</th>
					<th>Descripcion</th>
					<th>Presentacion</th>
                    <th>Proveedor</th>
			</tr>
			<?php foreach($detalle_productos as $contenido){ ?>
                <tr>
                    <td><?php echo $contenido->id_producto; ?></td>
                    <td><?php echo $contenido->nombre_producto; ?></td>
					<td><?php echo $contenido->nombre_presentacion; ?></td>
                    <td><?php echo $contenido->nombre_proveedor; ?></td>
				</tr> 
			<?php } ?>
		</table>
	</body>
</html>