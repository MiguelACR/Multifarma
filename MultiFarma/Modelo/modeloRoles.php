<?php
    require_once("modeloAbstractoDB.php");
	
    class Rol extends ModeloAbstractoDB {
		private $id_rol;
		private $nombre_rol;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getId_rol(){
			return $this->id_rol;
		}

		public function getNombre_rol(){
			return $this->nombre_rol;
		}

		public function consultar($id_rol='') {
			if($id_rol !=''):
				$this->query = "
				SELECT id_rol, nombre_rol
				FROM tb_roles
				WHERE id_rol = '$id_rol'
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
			SELECT id_rol, nombre_rol
			FROM tb_roles 
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		public function nuevo($datos=array()) {
			if(array_key_exists('id_rol', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO tb_roles
					(id_rol, nombre_rol, update_at)
					VALUES
					(NULL, '$nombre_rol', NOW())
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			endif;
			
		}
		public function editar($id_rol='',$nombre_rol='') {
		
			$this->query = "
			UPDATE tb_roles
			SET nombre_rol = '$nombre_rol',
			update_at = NOW()
			WHERE id_rol = '$id_rol'
			";
			$resultado = $this->ejecutar_query_simple();
			
			return $resultado;
		}
		
		public function borrar($id_rol='') {
			$this->query = "
			DELETE FROM tb_roles
			WHERE id_rol = '$id_rol'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}

		public function identificarM(){

			$this->query = "
			SELECT MAX(id_rol) id_rol
			FROM tb_roles
			";

			$this->obtener_resultados_query();

			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>