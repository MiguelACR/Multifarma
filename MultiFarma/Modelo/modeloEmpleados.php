<?php
    require_once ("modeloAbstractoDB.php");
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
				WHERE id_empleado = ? order by id_empleado
				";
				$this->primero = $id_empleado;
				$this->obtener_resultados_query(1);
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
			$this->obtener_resultados_query(0);
			return $this->rows;
		}

        public function nuevo_editar($datos=array()){
			$resultado = false;
			if(array_key_exists('id_empleado', $datos)):
			try {
            if($datos['accion'] == 'nuevo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_empleados
				(id_empleado,nombre_empleado,apellido_empleado,cargo_empleado,id_pais,id_ciudad,
				direccion_empleado,telefono_empleado,email_empleado,id_farmacia, update_at)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				";
			    $stm = $this->abrir_preparar_cerrar('abrir');
			    $stm->execute([
				  $id_empleado,
				  $nombre_empleado,
				  $apellido_empleado,
				  $cargo_empleado,
				  $id_pais,
				  $id_ciudad,
				  $direccion_empleado,
				  $telefono_empleado,
				  $email_empleado,
				  $id_farmacia,
				  'NOW()'
			    ]);

				$this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				UPDATE tb_empleados
				SET nombre_empleado = ?, 
				apellido_empleado = ?,
				cargo_empleado = ?,
				id_pais = ?, 
				id_ciudad = ?,
				direccion_empleado = ?, 
				telefono_empleado = ?, 
				email_empleado = ?,
				id_farmacia = ?,
				update_at = ?
				WHERE id_empleado = ?
				";
				$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
					$nombre_empleado,
					$apellido_empleado,
					$cargo_empleado,
					$id_pais,
					$id_ciudad,
					$direccion_empleado,
					$telefono_empleado,
					$email_empleado,
					$id_farmacia,
					'NOW()',
					$id_empleado
				  ]);
				$this->abrir_preparar_cerrar('cerrar'); 
			}
			$resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
			return $resultado;
			endif;	
        }

		public function borrar($id_empleado='') {
			$resultado = false;
		try{
			$this->query = "
			DELETE FROM tb_empleados
			WHERE id_empleado = ?
			";
			$stm = $this->abrir_preparar_cerrar('abrir');
			$stm->execute([
				$id_empleado
			  ]);
			$this->abrir_preparar_cerrar('cerrar');
			$resultado = true;
		}
		catch(Exception $e) {
		throw new Exception($e->getMessage());
		}
			return $resultado;
		}

		function __destruct() {
			//unset($this);
		}
	}
?>