<?php
	function conectar(){
		include("config.php");
		$canal = new mysqli($servidor,$usuario,$clave,$db);
		return $canal;
	}

	 
	function consultarFactura($id_factura, $id_cliente){
		$canal = conectar();

		$sql = "SELECT f.id_factura, DATE_FORMAT(f.fecha_factura, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha_factura,'%H:%i:%s') as  hora, f.id_cliente, f.estado_factura,
		CONCAT (v.nombre_empleado, ' ', v.apellido_empleado) as vendedor,
		CONCAT (cl.nombre_cliente, ' ', cl.apellido_cliente) as nombre, cl.telefono_cliente, cl.direccion_cliente, f.iva_factura, f.valor_factura, f.neto_factura
        FROM tb_facturas f
        INNER JOIN tb_empleados v
        ON f.id_empleado = v.id_empleado
        INNER JOIN tb_clientes cl
        ON f.id_cliente = cl.id_cliente
		WHERE f.id_factura = $id_factura AND f.id_cliente = $id_cliente ";

		$resultado = $canal->query($sql) 
		or die(mysqli_errno($canal)." : " 
		.mysqli_error($canal)." | Query=".$sql);

		$canal->close();
		return $resultado->fetch_assoc();
	}
	
	function detalle_prod($id_factura){
		$canal= conectar();

		$sql = "SELECT p.nombre_producto, dt.cantidad, dt.precio, dt.total
		FROM tb_facturas f
		INNER JOIN tb_movimientosfacturas dt
		ON f.id_factura = dt.id_factura
		INNER JOIN tb_productos p
		ON dt.id_producto = p.id_producto
		WHERE f.id_factura = $id_factura";

        $resultado = $canal->query($sql) 
        or die(mysqli_errno($canal)." : " 
        .mysqli_error($canal)." | Query=".$sql);

		$detalle = array();

		while ($fila = $resultado->fetch_assoc()){
			$detalle[] = array_map('utf8_encode',$fila);
		}
		$canal->close();
		return $detalle;
	}
	

	
	
?>