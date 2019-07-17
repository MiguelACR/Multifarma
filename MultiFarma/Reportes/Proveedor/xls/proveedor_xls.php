<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Proveedor.xls");
	
	require_once ('../../../Modelo/modeloProveedor.php');
    $model = new Proveedor();
    $detalle_proveedores = $model->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="7">Listado de Proveedores</th></tr>
			<tr>
                    <th>Nit</th>
					<th>Descripcion</th>
                    <th>Pais</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Email</th>
			</tr>
			<?php foreach($detalle_proveedores as $contenido){ ?>
                <tr>
                    <td><?php echo $contenido->id_proveedor; ?></td>
					<td><?php echo $contenido->nombre_proveedor; ?></td>
                    <td><?php echo $contenido->nombre_pais; ?></td>
                    <td><?php echo $contenido->nombre_ciudad; ?></td>
                    <td><?php echo $contenido->direccion_proveedor; ?></td>
                    <td><?php echo $contenido->telefono_proveedor; ?></td>
                    <td><?php echo $contenido->email_proveedor; ?></td>
				</tr> 
			<?php } ?>
		</table>
	</body>
</html>