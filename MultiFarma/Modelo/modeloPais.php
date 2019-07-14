<?php
	require_once('modeloAbstractoDB.php');
	class Pais extends ModeloAbstractoDB {
		public $id_pais;
		public $nombre_pais;
		public $abreviatura_pais;
		
		function __construct() {
		}
		
		public function getId_pais(){
			return $this->id_pais;
		}

		public function getNombre_pais(){
			return $this->nombre_pais;
		}

		public function getAbreviatura_pais(){
			return $this->abreviatura_pais;
		}
		
		public function consultar($id_pais='') {
			if($id_pais != ''):
				$this->query = "
				SELECT id_pais, nombre_pais, abreviatura_pais
				FROM tb_paises
				WHERE id_pais = ?
				";
				$this->primero = $id_pais;
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
			SELECT id_pais, abreviatura_pais, nombre_pais
			FROM tb_paises ORDER BY nombre_pais
			";
			$this->obtener_resultados_query(0);
			return $this->rows;
		}

        public function nuevo_editar($datos=array()){
			if(array_key_exists('id_pais', $datos)):
				$resultado = false;
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				try {
				if($datos['accion'] == 'nuevo'){	
					$this->query = "
				   INSERT INTO tb_paises
				   (id_pais, abreviatura_pais, nombre_pais, update_at)
				   VALUES
				   (?, ?, ?, now())
				   ";
					$stm = $this->abrir_preparar_cerrar('abrir');
					$stm->execute([
						$id_pais,
						$abreviatura_pais,
						$nombre_pais
					]);
					$this->abrir_preparar_cerrar('cerrar');    
				}
				else if($datos['accion'] == 'editar'){
					$this->query = "
					UPDATE tb_paises
					SET nombre_pais = ?,
					abreviatura_pais = ?,
					update_at = NOW()
					WHERE id_pais = ?
					";

					$stm = $this->abrir_preparar_cerrar('abrir');
					$stm->execute([
						$nombre_pais,
						$abreviatura_pais,
						$id_pais
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

		public function borrar($id_pais='') {
			$resultado = false;
			try{
			$this->query = "
			DELETE FROM tb_paises
			WHERE id_pais = ?
			";
			$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
                    $id_pais
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