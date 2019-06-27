<?php
	require_once('modeloAbstractoDB.php');
	class Cliente extends ModeloAbstractoDB {
		public $id_cliente;
		public $nombre_cliente;
		public $apellido_cliente;
		public $direccion_cliente;
		public $telefono_cliente;
		public $id_pais;
		public $id_ciudad;
		
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


		public function consultar($id_cliente='') {
			if($id_cliente !=''):
				$this->query = "
                SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, id_pais, id_ciudad 
                FROM tb_clientes 
				WHERE id_cliente = '$id_cliente' order by id_cliente
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
			SELECT id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, s.nombre_pais, p.nombre_ciudad
                FROM tb_clientes AS pr
				INNER JOIN tb_paises AS s ON (pr.id_pais = s.id_pais) 
				INNER JOIN tb_ciudades AS p ON (pr.id_ciudad  = p.id_ciudad)
			";
			$this->obtener_resultados_query();
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

		public function nuevo($datos=array()) {
			if(array_key_exists('id_cliente', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$this->query = "
				INSERT INTO tb_clientes
				(id_cliente, nombre_cliente, apellido_cliente, direccion_cliente, 
                telefono_cliente, id_pais, id_ciudad)
				VALUES
				('$id_cliente', '$nombre_cliente', '$apellido_cliente' ,'$direccion_cliente',
				'$telefono_cliente', '$id_pais', '$id_ciudad')
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
			UPDATE tb_clientes
			SET nombre_cliente='$nombre_cliente', 
			apellido_cliente='$apellido_cliente',
			direccion_cliente='$direccion_cliente', 
			telefono_cliente='$telefono_cliente', 
			id_pais='$id_pais', 
			id_ciudad='$id_ciudad'
			WHERE id_cliente = '$id_cliente'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_cliente='') {
			$this->query = "
			DELETE FROM tb_clientes
			WHERE id_cliente = '$id_cliente'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
		function __destruct() {

		}

	}
?>