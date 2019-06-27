<?php
    require_once("modeloAbstractoDB.php");
	
    class Usuarioxempleado extends ModeloAbstractoDB {
		private $id_usuarioxempleado;
		private $id_empleado;
		private $id_usuario;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getId_usuarioxempleado(){
			return $this->id_usuarioxempleado;
		}

		public function getId_empleado(){
			return $this->id_empleado;
		}
		
		public function getId_usuario(){
			return $this->id_usuario;
		}

		public function consultar($id_usuario='') {
			if($id_usuario !=''):
				$this->query = "
				SELECT id_usuarioxempleado, id_empleado
				FROM tb_usuarioxempleado
				WHERE id_usuario = '$id_usuario'
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
		
			
		}
		
		public function nuevo($id_empleado='',$id_usuario='') {
			
				$this->query = "
					INSERT INTO tb_usuarioxempleado
					(id_usuarioxempleado, id_empleado, id_usuario, update_at)
					VALUES
					(NULL, '$id_empleado', '$id_usuario', NOW())
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
	
			
		}
		
		public function editar($id_usuarioxempleado='',$id_empleado='',$id_usuario='') {
		  
			$this->query = "
			UPDATE tb_usuarioxempleado
			SET id_empleado ='$id_empleado',
			id_usuario ='$id_usuario',
			update_at = NOW()
			WHERE id_usuarioxempleado = '$id_usuarioxempleado'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_usuarioxempleado='') {
			$this->query = "
			DELETE FROM tb_usuarioxempleado
			WHERE id_usuarioxempleado = '$id_usuarioxempleado'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>