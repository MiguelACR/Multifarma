<?php
	require_once('modeloAbstractoDB.php');
	class Producto extends ModeloAbstractoDB {
		private $id_producto;
		private $nombre_producto;
		private $foto_producto;
		private $id_presentacion;
		private $id_proveedor;
        private $id_farmacia;
		private $detalle_producto;
		private $stock;
		private $valor_venta;
		
		function __construct() {
		}
		
		public function getId_producto(){
			return $this->id_producto;
		}

		public function getNombre_producto(){
			return $this->nombre_producto;
		}

		public function getFoto_producto(){
			return $this->foto_producto;
		}
		
		public function getId_presentacion(){
			return $this->id_presentacion;
		}

		public function getId_proveedor(){
			return $this->id_proveedor;
		}

		public function getId_farmacia(){
			return $this->id_farmacia;
		}

		public function getDetalle_producto(){
			return $this->detalle_producto;
		}

		public function getStock(){
			return $this->stock;
		}

		public function getValor_venta(){
			return $this->valor_venta;
		}

		public function consultar($id_producto='') {

			session_start();
			$id_farmacia = $_SESSION['id_farmacia'];
			if($id_producto != ''):
				$this->query = "
				SELECT id_producto, nombre_producto, foto_producto,
	            id_presentacion, id_proveedor
	            FROM tb_productos 
	            WHERE id_producto = '$id_producto'  
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
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
	
		public function listar() {
			$this->query = "
			SELECT id_producto, nombre_producto, a.nombre_presentacion, p.nombre_proveedor 
			FROM tb_productos as pb 
			INNER JOIN tb_presentaciones AS a ON (pb.id_presentacion = a.id_presentacion)
			INNER JOIN tb_proveedores AS p ON (pb.id_proveedor = p.id_proveedor)
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function nuevo($datos=array()) {
			 if(array_key_exists('id_producto', $datos)):
			 	foreach ($datos as $campo=>$valor):
			 		$$campo = $valor;
			 	endforeach;
			 	$carpeta = "../Recursos/img/Productos/";
			 	opendir($carpeta);
			 	$destino = $carpeta.$_FILES['foto_producto']['name'];
			 	copy($_FILES['foto_producto']['tmp_name'],$destino);
				 $foto_producto = $_FILES['foto_producto']['name'];
			 	$this->query = "
			 	INSERT INTO tb_productos
			 	(id_producto, nombre_producto, foto_producto,
                 id_presentacion, id_proveedor, update_at)
			 	VALUES
			 	(NULL, '$nombre_producto', '$foto_producto',
			 	'$id_presentacion', '$id_proveedor', NOW())
			 	";
			 	$resultado = $this->ejecutar_query_simple();
			 	return $resultado;
			 endif;
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			session_start();
		if($_FILES['foto_producto']['name']==""){
			$foto_producto = $_SESSION['producto'];	
			$this->query = "
			UPDATE tb_productos
            SET nombre_producto='$nombre_producto', foto_producto='$foto_producto', 
            id_presentacion='$id_presentacion', id_proveedor = '$id_proveedor', update_at = NOW()
			WHERE id_producto = '$id_producto'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		else{
			 unlink("../Recursos/img/Productos/".$_SESSION['producto']);
			 $carpeta = "../Recursos/img/Productos/";
			 	opendir($carpeta);
			 	$destino = $carpeta.$_FILES['foto_producto']['name'];
			 	copy($_FILES['foto_producto']['tmp_name'],$destino);
				 $foto_producto = $_FILES['foto_producto']['name'];
				 $this->query = "
				 UPDATE tb_productos
				 SET nombre_producto='$nombre_producto', foto_producto='$foto_producto', 
				 id_presentacion='$id_presentacion', id_proveedor = '$id_proveedor', update_at = NOW()
				 WHERE id_producto = '$id_producto'
				 ";
				 $resultado = $this->ejecutar_query_simple();
				 return $resultado;	 
		}
		}
		
		public function borrar($id_producto='') {
			session_start();
			unlink("../Recursos/img/Productos/".$_SESSION['producto']);
			$this->query = "
			DELETE FROM tb_productos
			WHERE id_producto = '$id_producto'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
		}
	}
?>