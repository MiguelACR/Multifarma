<?php
	require_once('modeloAbstractoDB.php');
	class Factura extends ModeloAbstractoDB {
		private $id_factura;
		private $id_cliente;
		private $id_empleado;
		private $fecha_factura;
		private $iva_factura;
        private $valor_factura;
		private $neto_factura;
		private $estado_factura;
		
		function __construct() {
		}
        
		public function getId_factura()
		{
				return $this->id_factura;
		}

		public function getId_cliente()
		{
				return $this->id_cliente;
		}
 
		public function getId_empleado()
		{
				return $this->id_empleado;
		}

		public function getFecha_factura()
		{
				return $this->fecha_factura;
		}
 
		public function getIva_factura()
		{
				return $this->iva_factura;
		}

        public function getValor_factura()
        {
                return $this->valor_factura;
        }

		public function getNeto_factura()
		{
				return $this->neto_factura;
		}

		public function getEstado_factura()
		{
				return $this->estado_factura;
        }
        
		public function consultar(String $id_factura = '', String $id_cliente = '') {

			if($id_factura != '' && $id_cliente != ''):

				$this->query = "SELECT f.id_factura, DATE_FORMAT(f.fecha_factura, '%d/%m/%Y') as fecha, DATE_FORMAT(f.fecha_factura,'%H:%i:%s') as  hora, f.id_cliente, f.estado_factura,
				CONCAT (v.nombre_empleado, ' ', v.apellido_empleado) as vendedor,
				CONCAT (cl.nombre_cliente, ' ', cl.apellido_cliente) as nombre, cl.telefono_cliente, cl.direccion_cliente, f.iva_factura, f.valor_factura, f.neto_factura
				FROM tb_facturas f
				INNER JOIN tb_empleados v
				ON f.id_empleado = v.id_empleado
				INNER JOIN tb_clientes cl
				ON f.id_cliente = cl.id_cliente
				WHERE f.id_factura = ? 
				AND f.id_cliente = ? ";
	
				$this->primero = $id_factura;
				$this->segundo = $id_cliente;
	
				$this->obtener_resultados_query(2);
			endif;
				return $this->rows;
		}

		public function consultar_prod_venta($id_producto='') {

			session_start();
			$id_farmacia = $_SESSION['id_farmacia'];
			if($id_producto != ''):
				$this->query = "
				SELECT p.id_producto, f.id_farmacia, CONCAT (p.nombre_producto, ' ',pe.nombre_presentacion, ' ',pr.nombre_proveedor)as detalle_producto,
	            i.stock, i.valor_venta
	            FROM tb_productos AS p 
                INNER JOIN tb_presentaciones AS pe ON (p.id_presentacion = pe.id_presentacion)
                INNER JOIN tb_proveedores AS pr ON (p.id_proveedor = pr.id_proveedor)
                INNER JOIN tb_inventario AS i ON (i.id_producto = p.id_producto)
                INNER JOIN tb_farmacias AS f ON (i.id_farmacia = f.id_farmacia)
	            WHERE i.id_producto = '$id_producto' AND i.id_farmacia = '$id_farmacia' 
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
	
		public function consultar_detalle(String $id_factura=''){
			if($id_factura != ''):
	
				$this->query = "SELECT p.nombre_producto, dt.cantidad, dt.precio, dt.total
				FROM tb_facturas f
				INNER JOIN tb_movimientosfacturas dt
				ON f.id_factura = dt.id_factura
				INNER JOIN tb_productos p
				ON dt.id_producto = p.id_producto
				WHERE f.id_factura = ?";
	
				$this->primero = $id_factura;
	
				$this->obtener_resultados_query(1);
			endif;
				return $this->rows;
		}

		public function listar() {
			$this->query = "
            SELECT id_factura, cl.id_cliente, CONCAT (cl.nombre_cliente, ' ',cl.apellido_cliente) nombre_completo_cliente,
            CONCAT (v.nombre_empleado,' ',v.apellido_empleado) nombre_completo_empleado, fecha_factura, iva_factura,
            valor_factura, neto_factura, estado_factura
			FROM tb_facturas as f 
			INNER JOIN tb_clientes AS cl ON (f.id_cliente = cl.id_cliente)
			INNER JOIN tb_empleados AS v ON (f.id_empleado = v.id_empleado)
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo_editar() {
		
		}
		

		public function borrar() {
			
		}

		public function anular($id_factura='') {
		$this->query ="
		UPDATE tb_facturas
		SET estado_factura = 0
		WHERE id_factura = '$id_factura'
		";	
		$resultado = $this->ejecutar_query_simple();
		return $resultado;
		}

		function __destruct() {
		}

	}
?>