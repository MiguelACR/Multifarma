<?php
	abstract class modeloAbstractoDB {
		
		private static $db_host ="localhost";
		private static $db_user = "root";
		private static $db_pass = "";
		protected $db_name = "db_proyectofarmacia";
		protected $query;
		protected $primero;
		protected $segundo;
		protected $rows = array();
		private $conexion;
		
		# metodos abstractos para Gestion de clases que hereden
		abstract protected function consultar();
		abstract protected function nuevo_editar();
		abstract protected function borrar();
		abstract protected function listar();
		
		
		# los siguientes metodos pueden definirse con exactitud y no son abstractos
		# Conectar a la base de datos
		private function abrir_conexion() {
			$db_host = self::$db_host;
			$db_user = self::$db_user;
			$db_pass = self::$db_pass;
			$db_name = $this->db_name;
			$this->conexion = 
			new PDO (
                "mysql:host=$db_host;dbname=$db_name;charset=utf8",
                $db_user,
                $db_pass
			);
			$this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		}

		# Desconectar la base de datos
		private function cerrar_conexion() {
			$this->conexion = null;
		}
		
		# Funcion para abrir conexion y preparar el Insert,update o delete
	    protected function abrir_preparar_cerrar(String $peticion){
		try {
        if($peticion == 'abrir'){
		$this->abrir_conexion();	
		$stm = $this->conexion->prepare($this->query);
        return $stm;
		}
		else if($peticion == 'cerrar'){
		$this->cerrar_conexion();
		}
		} catch(Exception $e) {
			echo "Error! : " . $e->getMessage();
		}
		}
		
		# Traer resultados de una consulta en un Array
		protected function obtener_resultados_query(int $tipo) {
			try {
				$this->abrir_conexion();
				$stm = $this->conexion->prepare($this->query);
				if($tipo == 0){
					$stm->execute();	
				}
				else if($tipo == 1){
					$stm->execute([$this->primero]);
				}
				else if($tipo == 2){
					$stm->execute([
						$this->primero,
					    $this->segundo]);
				}
				$this->rows = $stm->fetchAll();
				$stm = null;
				$this->cerrar_conexion();
			} catch(Exception $e) {
		        echo "Error! : " . $e->getMessage();
		        return false;
		    }
		}
	}
?>