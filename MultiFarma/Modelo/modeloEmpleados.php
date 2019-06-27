<?php
    require_once("modeloAbstractoDB.php");
	
    class Empleado extends ModeloAbstractoDB {
		private $id_empleado;
		private $nombre_empleado;
        private $apellido_empleado;
        private $cargo_empleado;
        private $id_pais;
        private $id_ciudad;
        private $direccion_empleado;
        private $telefono_empleado;
        private $email_empleado;
		private $id_farmacia;

		function __construct() {
			//$this->db_name = '';
		}

		public function getId_empleado(){
			return $this->id_empleado;
		}

		public function getNombre_empleado(){
			return $this->nombre_empleado;
		}
		
		public function getApellido_empleado(){
			return $this->apellido_empleado;
		}

        public function getCargo_empleado(){
			return $this->cargo_empleado;
        }
        
        public function getId_pais(){
			return $this->id_pais;
        }
        
        public function getId_ciudad(){
			return $this->id_ciudad;
        }
        
        public function getDireccion_empleado(){
			return $this->direccion_empleado;
		}

        public function getTelefono_empleado(){
			return $this->telefono_empleado;
		}

        public function getEmail_empleado(){
			return $this->email_empleado;
		}

		public function getId_farmacia(){
			return $this->id_farmacia;
        }

		public function consultar($id_empleado='') {
			if($id_empleado !=''):
				$this->query = "
                SELECT id_empleado, nombre_empleado, apellido_empleado, cargo_empleado, id_pais, id_ciudad,
                direccion_empleado, telefono_empleado, email_empleado, id_farmacia
				FROM tb_empleados
				WHERE id_empleado = '$id_empleado' order by id_empleado
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
			SELECT id_empleado, nombre_empleado, apellido_empleado, cargo_empleado, p.nombre_pais, 
			c.nombre_ciudad, direccion_empleado, telefono_empleado, email_empleado, f.nombre_farmacia
            FROM tb_empleados as e inner join tb_paises as p
			ON (e.id_pais = p.id_pais) inner join tb_ciudades as c ON (e.id_ciudad = c.id_ciudad) 
			inner join tb_farmacias as f ON (e.id_farmacia = f.id_farmacia) order by id_empleado
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}

		public function listarE() {
			$this->query = "
			SELECT id_empleado, nombre_empleado, apellido_empleado
            FROM tb_empleados
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('id_empleado', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
					INSERT INTO tb_empleados
                    (id_empleado,nombre_empleado,apellido_empleado,cargo_empleado,id_pais,id_ciudad,direccion_empleado,telefono_empleado,email_empleado,id_farmacia)
					VALUES
                    ('$id_empleado','$nombre_empleado','$apellido_empleado','$cargo_empleado','$id_pais','$id_ciudad','$direccion_empleado','$telefono_empleado','$email_empleado','$id_farmacia')
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
			UPDATE tb_empleados
			SET nombre_empleado ='$nombre_empleado',
			apellido_empleado ='$apellido_empleado',
            cargo_empleado = '$cargo_empleado',
            id_pais = '$id_pais',
            id_ciudad = '$id_ciudad',
            direccion_empleado = '$direccion_empleado',
            telefono_empleado = '$telefono_empleado',
			email_empleado = '$email_empleado',
			id_farmacia = '$id_farmacia'
			WHERE id_empleado = '$id_empleado'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_empleado='') {
			$this->query = "
			DELETE FROM tb_empleados
			WHERE id_empleado = '$id_empleado'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {
			//unset($this);
		}
	}
?>