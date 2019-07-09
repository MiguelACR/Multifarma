<?php
	require_once('modeloAbstractoDB.php');
	class Inventario extends ModeloAbstractoDB {
		private $id_farmacia;
		private $id_producto;
		private $entradas;
		private $salidas;
		private $stock;
        private $valor_unitario;
        private $valor_venta;
        private $fecha_registro;
       
		function __construct() {
		}

		public function getId_farmacia(){
			return $this->id_farmacia;
		}

		public function getId_producto(){
			return $this->id_producto;
		}

		public function getEntradas(){
			return $this->entradas;
		}

		public function getSalidas(){
			return $this->salidas;
		}
		
		public function getStock(){
			return $this->stock;
		}

        public function getValor_unitario(){
			return $this->valor_unitario;
		}

        public function getValor_venta(){
			return $this->valor_venta;
		}

        public function getFecha_registro(){
			return $this->fecha_registro;
		}

		public function consultar($id_farmacia='', $id_producto='') {
			if($id_farmacia != '' && $id_producto != ''):
				$this->query = "
				SELECT id_farmacia, id_producto, entradas, salidas,
				stock, valor_unitario, valor_venta, fecha_registro
				FROM tb_inventario
				WHERE id_farmacia = ? AND id_producto = ?
				";
				$this->primero = $id_farmacia;
				$this->segundo = $id_producto;
				$this->obtener_resultados_query(2);
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function listar() {
			$this->query = "
			SELECT CONCAT (p.nombre_producto, ' ',pe.nombre_presentacion, ' ',pr.nombre_proveedor)as detalle_producto, f.nombre_farmacia, entradas, salidas, stock, valor_unitario, valor_venta, fecha_registro, i.id_farmacia, i.id_producto
			FROM tb_inventario AS i 
			INNER JOIN tb_productos AS p ON (i.id_producto = p.id_producto) 
			INNER JOIN tb_farmacias AS f ON (i.id_farmacia = f.id_farmacia)
			INNER JOIN tb_presentaciones AS pe ON (p.id_presentacion = pe.id_presentacion)
			INNER JOIN tb_proveedores AS pr ON (p.id_proveedor = pr.id_proveedor)
			";
			$this->obtener_resultados_query(0);
			return $this->rows;
		}
		
        public function nuevo_editar($datos=array()){
			$resultado = false;
			if((array_key_exists('id_farmacia', $datos) && array_key_exists('id_producto', $datos))||
			(array_key_exists('id_producto', $datos) && array_key_exists('cantidad', $datos))):
			try {
            if($datos['accion'] == 'nuevo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_clientes
				(id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, id_pais, id_ciudad, email_cliente, update_at)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?)
				";
			    $stm = $this->abrir_preparar_cerrar('abrir');
			    $stm->execute([
				  $id_cliente,
				  $nombre_cliente,
				  $apellido_cliente,
				  $direccion_cliente,
				  $telefono_cliente,
				  $id_pais,
				  $id_ciudad,
				  $email_cliente,
				  'NOW()'
			    ]);
				$this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				UPDATE tb_clientes
				SET nombre_cliente = ?, 
				apellido_cliente = ?,
				direccion_cliente = ?, 
				telefono_cliente = ?, 
				id_pais = ?, 
				id_ciudad = ?,
				email_cliente = ?,
				update_at = ?
				WHERE id_cliente = ?
				";
				$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
					$nombre_cliente,
					$apellido_cliente,
					$direccion_cliente,
					$telefono_cliente,
					$id_pais,
					$id_ciudad,
					$email_cliente,
					'NOW()',
					$id_cliente
				  ]);
				$this->abrir_preparar_cerrar('cerrar'); 
			}
			# Archivos js que utilizan esta función: funcionesFactura y funcionesVenta
		    else if($datos['accion'] == 'editar_autonomo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
			    session_start();
				$id_farmacia = $_SESSION['id_farmacia'];
				$this->consultar($id_farmacia,$id_producto);
				$salidas = $this->getSalidas();
				$stock = $this->getStock();
				if($datos['tipoAccion'] == 'devolucion'){
				$salidas = $salidas - $cantidad;
				$stock = $stock + $cantidad;
				}
				else if($datos['tipoAccion'] == 'factura'){
				$salidas = $salidas + $cantidad;
				$stock = $stock - $cantidad;
				}
				$this->query = "
			    UPDATE tb_inventario
			    SET salidas = ?,
			    stock = ?
			    WHERE id_farmacia = ?
			    AND id_producto = ?
			    ";
				$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
					$salidas,
					$stock,
					$id_farmacia,
					$id_producto
    				]);
				$this->abrir_preparar_cerrar('cerrar'); 
				unset($this->rows);
			}
			$resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
			return $resultado;
			endif;		
		}

		public function nuevo() {
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_inventario
				(id_farmacia, id_producto, entradas, salidas, stock, valor_unitario, valor_venta, fecha_registro)
				VALUES
				('$id_farmacia', '$id_producto', '$entradas', 0, '$entradas', '$valor_unitario', '$valor_venta', '$fecha_registro')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
		}
		
		public function editar($datos=array()) {
			$stock = $stock + $entradas;
			$this->query = "
			UPDATE tb_inventario
			SET entradas='$entradas', 
			salidas='$salidas', 
			stock='$stock', 
			valor_unitario='$valor_unitario', 
			valor_venta='$valor_venta', 
			fecha_registro='$fecha_registro'
			WHERE id_farmacia = '$id_farmacia'
			AND id_producto = '$id_producto'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_farmacia='', $id_producto='') {
			$this->query = "
			DELETE FROM tb_inventario
			WHERE id_farmacia = '$id_farmacia'
			AND id_producto = '$id_producto'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		function __destruct() {
		}
	}
?>