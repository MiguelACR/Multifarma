<?php
	require_once('modeloAbstractoDB.php');
	class Propietario extends ModeloAbstractoDB {
		public $id_propietario;
		public $nombre_propietario;
		public $apellido_propietario;
		public $direccion_propietario;
		public $telefono_propietario;

		function __construct() {
		}
		
		public function getId_propietario(){
			return $this->id_propietario;
		}

		public function getNombre_propietario(){
			return $this->nombre_propietario;
		}

		public function getApellido_propietario(){
			return $this->apellido_propietario;
		}
		public function getDireccion_propietario(){
			return $this->direccion_propietario;
		}
		public function getTelefono_propietario(){
			return $this->telefono_propietario;
		}

		
		public function consultar($id_propietario='') {
			if($id_propietario != ''):
				$this->query = "
				SELECT id_propietario, nombre_propietario, apellido_propietario, direccion_propietario, telefono_propietario
				FROM tb_propietarios
				WHERE id_propietario = '$id_propietario'
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
			SELECT id_propietario, nombre_propietario, apellido_propietario, direccion_propietario, telefono_propietario
			FROM tb_propietarios 
			ORDER BY nombre_propietario
			";
			$this->obtener_resultados_query();
			return $this->rows;
		}

		public function nuevo($datos=array()) {
			if(array_key_exists('id_propietario', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$id_propietario= utf8_decode($id_propietario);
				$nombre_propietario= utf8_decode($nombre_propietario);
				$apellido_propietario= utf8_decode($apellido_propietario);
				$direccion_propietario= utf8_decode($direccion_propietario);
				$telefono_propietario= utf8_decode($telefono_propietario);
				$this->query = "
				INSERT INTO tb_propietarios
				(id_propietario, nombre_propietario, apellido_propietario, direccion_propietario, telefono_propietario)
				VALUES
				('$id_propietario', '$nombre_propietario', '$apellido_propietario', '$direccion_propietario', '$telefono_propietario')
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
			UPDATE tb_propietarios
			SET nombre_propietario='$nombre_propietario', apellido_propietario='$apellido_propietario', direccion_propietario='$direccion_propietario', telefono_propietario='$telefono_propietario'
			WHERE id_propietario = '$id_propietario'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_propietario='') {
			$this->query = "
			DELETE FROM tb_propietarios
			WHERE id_propietario = '$id_propietario'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
		}
	}
?>