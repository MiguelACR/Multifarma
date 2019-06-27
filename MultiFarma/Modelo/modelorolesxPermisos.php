<?php
    require_once("modeloAbstractoDB.php");
	
    class Rolxpermiso extends ModeloAbstractoDB {

		private $id_rolxpermiso;
        private $id_rol;
        private $modulo_rolxpermiso;
        private $estado_rolxpermiso;
		
		function __construct() {
			//$this->db_name = '';
		}

		public function getId_rolxpermiso(){
			return $this->id_rolxpermiso;
		}

		public function getId_rol(){
			return $this->id_rol;
		}

        public function getModulo_rolxpermiso(){
			return $this->modulo_rolxpermiso;
        }
        
        public function getEstado_rolxpermiso(){
			return $this->estado_rolxpermiso;
		}

		public function consultar($id_rol='') {
			if($id_rol !=''):
				$this->query = "
				SELECT id_rolxpermiso
				FROM tb_rolesxpermisos
				WHERE id_rol = '$id_rol' AND modulo_rolxpermiso = 1
				";
				$this->obtener_resultados_query();
			endif;
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
			endif;
		}
		
		public function listar($id_rol='') {
	   if($id_rol != ''){
			$this->query = "
			SELECT estado_rolxpermiso
			FROM tb_rolesxpermisos 
			WHERE id_rol = '$id_rol'
			";	
			$this->obtener_resultados_query();
			return $this->rows;
	   }	
		}
		public function nuevo($id_rol=''){

				$this->query = "
					INSERT INTO tb_rolesxpermisos
					(id_rolxpermiso, id_rol, modulo_rolxpermiso, estado_rolxpermiso)
					VALUES
                    (NULL,'$id_rol',1,0),(NULL,'$id_rol',2,0),(NULL,'$id_rol',3,0),
                    (NULL,'$id_rol',4,0),(NULL,'$id_rol',5,0),(NULL,'$id_rol',6,0),
                    (NULL,'$id_rol',7,0),(NULL,'$id_rol',8,0),(NULL,'$id_rol',9,0),
                    (NULL,'$id_rol',10,0),(NULL,'$id_rol',11,0),(NULL,'$id_rol',12,0),
                    (NULL,'$id_rol',13,0),(NULL,'$id_rol',14,0),(NULL,'$id_rol',15,0),
                    (NULL,'$id_rol',16,0),(NULL,'$id_rol',17,0),(NULL,'$id_rol',18,0) 
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			
		}
		public function editar($id_rol='',$id_rolxpermiso='',$modulo_rolxpermiso='',$estado_rolxpermiso='') {

			$this->query = "
			UPDATE tb_rolesxpermisos
			SET id_rol ='$id_rol',
			modulo_rolxpermiso = '$modulo_rolxpermiso',
			estado_rolxpermiso = '$estado_rolxpermiso'
			WHERE id_rolxpermiso = '$id_rolxpermiso'
			";
			$resultado = $this->ejecutar_query_simple();
			
			return $resultado;
	
		}
		
		public function borrar($id_rol='') {
			$this->query = "
			DELETE FROM tb_rolesxpermisos
			WHERE id_rol = '$id_rol'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>