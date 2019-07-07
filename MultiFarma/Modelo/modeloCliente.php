<?php
	require_once('modeloAbstractoDB.php');
	class Cliente extends ModeloAbstractoDB {
		private $id_cliente;
		private $nombre_cliente;
		private $apellido_cliente;
		private $direccion_cliente;
		private $telefono_cliente;
		private $id_pais;
		private $id_ciudad;
		private $email_cliente;

		function __construct() {
			
		}
		
		public function getId_cliente(){
			return $this->id_cliente;
		}

		public function getNombre_cliente(){
			return $this->nombre_cliente;
		}

		public function getApellido_cliente(){
			return $this->apellido_cliente;
		}

		public function getDireccion_cliente(){
			return $this->direccion_cliente;
		}
		
		public function getTelefono_cliente(){
			return $this->telefono_cliente;
		}

		public function getId_pais(){
			return $this->id_pais;
		}

		public function getId_ciudad(){
			return $this->id_ciudad;
		}

		public function getEmail_cliente(){
			return $this->email_cliente;
		}

		public function consultar($id_cliente='') {
			if($id_cliente !=''):
				$this->query = "
                SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, id_pais, id_ciudad, email_cliente 
                FROM tb_clientes 
				WHERE id_cliente = ? order by id_cliente
				";
				$this->primero = $id_cliente;
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
			SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, s.nombre_pais, p.nombre_ciudad, email_cliente
                FROM tb_clientes AS pr
				INNER JOIN tb_paises AS s ON (pr.id_pais = s.id_pais) 
				INNER JOIN tb_ciudades AS p ON (pr.id_ciudad  = p.id_ciudad)
			";
			$this->obtener_resultados_query(0);
			return $this->rows;
		}
	
		public function listarC() {
			$this->query = "
			SELECT id_cliente, nombre_cliente, apellido_cliente
            FROM tb_clientes
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}

		public function nuevo_editar($datos=array()){
			$resultado = false;
			if(array_key_exists('id_cliente', $datos)):
			try {
            if($datos['accion'] == 'nuevo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$this->query = "
				INSERT INTO tb_clientes
				(id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, id_pais, id_ciudad, email_cliente, update_at)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, ?, ?)
				";
			    $stm = $this->abrir_preparar_cerrar('abrir');
			
			    $stm->execute([
				  $id_cliente,
				  $nombre_cliente,
				  $apellido_cliente,
				  $direccion_cliente,
				  $telefono_cliente,
				  $id_pais,
				  $id_ciudad,
				  $email_cliente,
				  'NOW()'
			    ]);

				$this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				UPDATE tb_clientes
				SET nombre_cliente = ?, 
				apellido_cliente = ?,
				direccion_cliente = ?, 
				telefono_cliente = ?, 
				id_pais = ?, 
				id_ciudad = ?,
				email_cliente = ?,
				update_at = ?
				WHERE id_cliente = ?
				";
				$stm = $this->abrir_preparar_cerrar('abrir');
				
				$stm->execute([
					$nombre_cliente,
					$apellido_cliente,
					$direccion_cliente,
					$telefono_cliente,
					$id_pais,
					$id_ciudad,
					$email_cliente,
					'NOW()',
					$id_cliente
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

		public function borrar($id_cliente='') {
			$resultado = false;
			try{
			$this->query = "
			DELETE FROM tb_clientes
			WHERE id_cliente = ?
			";

			$stm = $this->abrir_preparar_cerrar('abrir');
	
				$stm->execute([
					$id_cliente
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

		}

	}
?>