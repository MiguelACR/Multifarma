<?php
	require_once ('modeloAbstractoDB.php');
	class Ciudad extends ModeloAbstractoDB {
		private $id_ciudad;
		private $nombre_ciudad;
		private $id_pais;
	
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

		public function consultar($id_ciudad='') {
			if($id_ciudad != ''):
				$this->query = "
				SELECT id_ciudad, nombre_ciudad, id_pais
				FROM tb_ciudades
				WHERE id_ciudad = ?
				";
				$this->primero = $id_ciudad;
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
			SELECT id_ciudad, nombre_ciudad, p.nombre_pais
			FROM tb_ciudades as c
			INNER JOIN tb_paises as p
			ON (c.id_pais = p.id_pais)
			ORDER BY nombre_ciudad
			";
			$this->obtener_resultados_query(0);
			return $this->rows;
		}
		
		public function nuevo_editar($datos=array()){
			$resultado = false;
			if(array_key_exists('id_ciudad', $datos)):
			try {
            if($datos['accion'] == 'nuevo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;

				$this->query = "
				INSERT INTO tb_ciudades
				(id_ciudad, nombre_ciudad, id_pais, update_at) 
				VALUES 
				(?, ?, ?, ?)";
			    $stm = $this->abrir_preparar_cerrar('abrir');
			
			    $stm->execute([
				  $id_ciudad,
				  $nombre_ciudad,
				  $id_pais,
				  'NOW()'
			    ]);

				$this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				UPDATE tb_ciudades
				SET nombre_ciudad = ?, 
				id_pais = ?,
				update_at = ?
				WHERE id_ciudad = ?
				";
				$stm = $this->abrir_preparar_cerrar('abrir');
				
				$stm->execute([
					$nombre_ciudad,
					$id_pais,
					'NOW()',
					$id_ciudad
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
	
		public function borrar($id_ciudad='') {
		$resultado = false;
			try{
				$this->query = "
				DELETE FROM tb_ciudades
				WHERE id_ciudad = ?
				";
	
				$stm = $this->abrir_preparar_cerrar('abrir');
	
				$stm->execute([
					$id_ciudad
				  ]);
		
				$this->abrir_preparar_cerrar('cerrar'); 

                $resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
		    
			return $resultado;
		}
		
		public function listarCiudadespaises($id_pais='') {
			if($id_pais != ''):
			$this->query = "
			SELECT id_ciudad, nombre_ciudad
			FROM tb_ciudades
			WHERE id_pais = ? ORDER BY nombre_ciudad
			";
			$this->primero = $id_pais;
			$this->obtener_resultados_query(1);
			return $this->rows;
		    endif;
		}

		function __destruct() {
		}
	}
?>