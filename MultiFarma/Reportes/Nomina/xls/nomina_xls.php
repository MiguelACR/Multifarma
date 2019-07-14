<?php
	header("Content-Type: application/vnd.ms-excel");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("content-disposition: attachment;filename=Nomina.xls");
	
	require_once ('../../../Modelo/modeloNomina.php');
    $model = new Nomina();
    $detalle_nominas = $model->listar();
?>
<html>
	<head>
	</head>
	<body>
		<table id="tabla" border = '1' width='60%' align='center'>
			<tr><th colspan="14">Listado de Nominas</th></tr>
			<tr>
					<th>Cod</th>
					<th>Empleado</th>
					<th>Fecha</th>
                    <th>Salario basico</th>
                    <th>Horas extras dias</th>
                    <th>Horas extras noche</th>
                    <th>Auxilio transporte</th>
                    <th>Valor extras dia</th>
                    <th>Valor extras noche</th>
                    <th>Días laborados</th>
                    <th>Salario devengado</th>
                    <th>Pension</th>
                    <th>Salud</th>
                    <th>Salario neto</th>
			</tr>
			<?php foreach($detalle_nominas as $contenido){ ?>
                <tr>
					<td><?php echo $contenido->id_nomina; ?></td>
					<td><?php echo $contenido->nombre; ?></td>
					<td><?php echo $contenido->fecha; ?></td>
                    <td><?php echo $contenido->salario_basico; ?></td>
                    <td><?php echo $contenido->hextrasd; ?></td>
                    <td><?php echo $contenido->hextrasn; ?></td>
                    <td><?php echo $contenido->auxilio_transporte; ?></td>
                    <td><?php echo $contenido->valor_hextrad; ?></td>
                    <td><?php echo $contenido->valor_hextran; ?></td>
                    <td><?php echo $contenido->dias_laborados; ?></td>
                    <td><?php echo $contenido->salario_devengado; ?></td>
                    <td><?php echo $contenido->pension; ?></td>
                    <td><?php echo $contenido->salud; ?></td>
                    <td><?php echo $contenido->salario_neto; ?></td>
				</tr> 
			<?php } ?>
		</table>
	</body>
</html>