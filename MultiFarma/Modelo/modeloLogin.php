<?php
    require_once('modeloAbstractoDB.php');
	
    class Login extends ModeloAbstractoDB {
        private $id_usuario;
        private $clave_usuario;
		private $id_estado;
		private $id_rol;
        private $nickname_usuario;
		private $id_empleado;
        private $id_farmacia;
        private $nombre_completo;
		private $id_usuarioxempleado;
	

		function __construct() {
			//$this->db_name = '';
		}

        public function getId_usuario(){
			return $this->id_usuario;
		}

        public function getClave_usuario(){
			return $this->clave_usuario;
		}

        public function getId_estado(){
			return $this->id_estado;
		}

		public function getId_rol(){
			return $this->id_rol;
		}


        public function getNickname_usuario(){
			return $this->nickname_usuario;
		}

        public function getId_empleado(){
			return $this->id_empleado;
		}

		public function getId_farmacia(){
			return $this->id_farmacia;
		}

        public function getNombre_completo(){
			return $this->nombre_completo;
		}

        public function getId_usuarioxempleado(){
			return $this->id_usuarioxempleado;
		}
	
		public function consultar($datos = array()) {
			
            $nickname_usuario = $datos['usuario'];
            
            $this->query = "
            SELECT id_usuario, nickname_usuario, clave_usuario, id_estado, id_rol
			FROM tb_usuarios
			WHERE nickname_usuario = '$nickname_usuario'
            ";
            
            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
            endif;
        }
		
		public function consultarA($nickname_usuario = '') {
			
            $this->query = "
            SELECT id_usuario, nickname_usuario, clave_usuario, id_rol, fechacreacion_usuario
			FROM tb_usuarios
			WHERE nickname_usuario = '$nickname_usuario'
            ";
            
            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
            endif;
        }

        public function consultarIE($id_usuario='') {
			
            $this->query = "
            SELECT id_usuarioxempleado, id_empleado
			FROM tb_usuarioxempleado
			WHERE id_usuario = '$id_usuario'
            ";
            
            $this->obtener_resultados_query();
			
			if(count($this->rows) == 1):
				foreach ($this->rows[0] as $propiedad=>$valor):
					$this->$propiedad = $valor;
				endforeach;
            endif;
        }
        
        public function consultarNE($id_empleado='') {
			
            $this->query = "
            SELECT id_empleado, CONCAT (nombre_empleado, ' ',apellido_empleado)as nombre_completo, id_farmacia FROM tb_empleados WHERE id_empleado = '$id_empleado'
            ";
            
            $this->obtener_resultados_query();
			
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
        
		public function nuevo() {
			
			
		}
		
		public function editar($id_usuario='',$id_estado='') {
			
			$this->query = "
			UPDATE tb_usuarios
			SET id_estado = '$id_estado'
			WHERE id_usuario = '$id_usuario'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar() {
			
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>