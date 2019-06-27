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

		public function identificarM() {
			$this->query = "
			SELECT MAX(id_factura) id_factura
			FROM tb_facturas
			";

			$this->obtener_resultados_query();

			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
      
		public function listar($id_factura='') {
			$this->query = "
			SELECT id_producto, cantidad
			FROM tb_movimientosfacturas 
			WHERE id_factura = '$id_factura'
			";
			
			$this->obtener_resultados_query();
			return $this->rows;	
		}
		
		public function nuevo($id_cliente='', $subTotal='', $iva='', $total='') {
		
		session_start();
		$id_empleado = $_SESSION['id_empleado'];
				$this->query = "
				INSERT INTO tb_facturas
				(id_factura, id_cliente, id_empleado,
				fecha_factura, iva_factura, valor_factura, neto_factura, estado_factura)
				VALUES
				(NULL, '$id_cliente', '$id_empleado', NOW(), '$iva',
				'$subTotal', '$total', 1)
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
		}
		
		public function nuevoD($datos=array(), $id_factura='') {
			  
			foreach ($datos['datos'] as $campo=>$valor){
			
			  	 $id_producto = $valor['id'];
			 	 $cantidad = $valor['cantidad'];
			 	 $precio = $valor['precio'];
			 	 $total = $valor['total'];
			 	 $this->query = "
			  	 INSERT INTO tb_movimientosfacturas
			  	 (id_factura, id_producto, cantidad, precio, total)
			  	 VALUES
			 	 ('$id_factura', '$id_producto', '$cantidad', '$precio', '$total')
			 	 ";
			 	  $resultado = $this->ejecutar_query_simple();
			 
		}
		    
			    return $resultado;
			 
		}

		public function editar($datos=array()) {
			
		}
		
		public function borrar($id_factura='') {
			
		}
		
		function __destruct() {
		}
	}
?>