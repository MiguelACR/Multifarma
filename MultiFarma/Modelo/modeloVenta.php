<?php
	require_once('modeloAbstractoDB.php');
	class Venta extends ModeloAbstractoDB {
		public $id_factura;
		public $id_cliente;
		public $id_Usuario;
		public $fecha_factura;
		public $valor_factura;
		public $descuento_total;
		public $iva_factura;
		public $neto_factura;
		public $id_formapago;
		public $online;
		
		function __construct() {
		}
		
		public function getId_factura(){
			return $this->id_factura;
		}

		public function getId_cliente(){
			return $this->id_cliente;
		}

		public function getId_Usuario(){
			return $this->id_Usuario;
		}
		
		public function getFecha_factura(){
			return $this->fecha_factura;
		}

		public function getValor_factura(){
			return $this->valor_factura;
		}

		public function getDescuento_total(){
			return $this->descuento_total;
		}

		public function getIva_factura(){
			return $this->iva_factura;
		}

		public function getNeto_factura(){
			return $this->neto_factura;
		}

		public function getId_formapago(){
			return $this->id_formapago;
		}

		public function getonline(){
			return $this->online;
		}

		public function consultar() {
			
		}

        public function listar(){

		}

		public function identificarM() {
			$this->query = "
			SELECT MAX(id_factura) id_factura
			FROM tb_facturas
			";

			$this->obtener_resultados_query(0);

			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
       
		public function nuevo_editar($datos=array()){
		 $resultado = false;
		 if(array_key_exists('id_cliente', $datos)|| array_key_exists('id_producto', $datos)):
			try {
				if($datos['accion'] == 'nuevo'){
					if($datos['tipoAccion'] == 'factura'){
					session_start();
		            $id_empleado = $_SESSION['id_empleado'];
					foreach ($datos as $campo=>$valor):
						$$campo = $valor;
					endforeach;
					$this->query = "
				    INSERT INTO tb_facturas
				    (id_factura, id_cliente, id_empleado,
				    fecha_factura, iva_factura, valor_factura, neto_factura, estado_factura)
				    VALUES
				    (?, ?, ?, ?, ?, ?, ?, ?)
				    ";
					$stm = $this->abrir_preparar_cerrar('abrir');
					$stm->execute([
					  'NULL',
					  $id_cliente,
					  $id_empleado,
					  'NOW()',
					  $iva,
					  $subTotal,
					  $total_venta,
					  '1',
					]);
					$this->abrir_preparar_cerrar('cerrar'); 
					} 
					else if($datos['tipoAccion'] == 'detalle'){
					foreach ($datos as $campo=>$valor):
						$$campo = $valor;
					endforeach;
					$this->query = "
					INSERT INTO tb_movimientosfacturas
					(id_factura, id_producto, cantidad, precio, total)
					VALUES
				   (?, ?, ?, ?, ?)
				   ";
				   $stm = $this->abrir_preparar_cerrar('abrir');
					$stm->execute([
					  $id_factura,
					  $id_producto,
					  $cantidad,
					  $precio,
					  $total
					]);
					$this->abrir_preparar_cerrar('cerrar'); 
					}  
				}
				$resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
			return $resultado;
		 endif;
		}
		
		public function borrar($id_factura='') {
			
		}
		
		function __destruct() {
		}
	}
?>