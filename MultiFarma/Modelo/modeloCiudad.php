<?php
	require_once('modeloAbstractoDB.php');
	class Ciudad extends ModeloAbstractoDB {
		public $id_ciudad;
		public $nombre_ciudad;
		public $id_pais;
		public $nombre_pais;
		
		function __construct() {
		}
		
		public function getId_ciudad(){
			return $this->id_ciudad;
		}

		public function getNombre_ciudad(){
			return $this->nombre_ciudad;
		}

		public function getId_pais(){
			return $this->id_pais;
		}

		public function getNombre_pais(){
			return $this->nombre_pais;
		}
		
		public function consultar($id_ciudad='') {
			if($id_ciudad != ''):
				$this->query = "
				SELECT id_ciudad, nombre_ciudad, id_pais
				FROM tb_ciudades
				WHERE id_ciudad = '$id_ciudad'
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
			SELECT id_ciudad, nombre_ciudad, p.nombre_pais
			FROM tb_ciudades as c
			INNER JOIN tb_paises as p
			ON (c.id_pais = p.id_pais)
			ORDER BY nombre_ciudad
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}
		
		public function listarC($id_pais='') {
			$this->query = "
			SELECT id_ciudad, nombre_ciudad
			FROM tb_ciudades
			WHERE id_pais = '$id_pais' ORDER BY nombre_ciudad
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('id_ciudad', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$id_ciudad= utf8_decode($id_ciudad);
				$nombre_ciudad= utf8_decode($nombre_ciudad);
				$id_pais= utf8_decode($id_pais);
				$this->query = "
				INSERT INTO tb_ciudades
				(id_ciudad, nombre_ciudad, id_pais)
				VALUES
				('$id_ciudad', '$nombre_ciudad', '$id_pais')
				";
				$resultado = $this->ejecutar_query_simple();
				return $resultado;
			endif;
		}

		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$this->query = "
			UPDATE tb_ciudades
			SET nombre_ciudad='$nombre_ciudad', id_pais='$id_pais'
			WHERE id_ciudad = '$id_ciudad'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_ciudad='') {
			$this->query = "
			DELETE FROM tb_ciudades
			WHERE id_ciudad = '$id_ciudad'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
		}
	}
?>