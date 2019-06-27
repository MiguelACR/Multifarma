<?php
    require_once("modeloAbstractoDB.php");
	
    class Estado extends ModeloAbstractoDB {
        
        function __construct() {
		}

        public function consultar() {
		
        }
        
        public function nuevo() {
		
        }

        public function editar() {
		
        }

        public function borrar() {
		
        }

		public function listar() {
			$this->query = "
			SELECT id_estado, nombre_estado	FROM tb_estados order by id_estado
			";
			
			$this->obtener_resultados_query();
			return $this->rows;
			
        }
        
		
        

	}
?>