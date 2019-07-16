<?php
    require_once 'modeloAbstractoDB.php';
    class Presentacion extends ModeloAbstractoDB
    {
        public $id_presentacion;
        public $nombre_presentacion;

        public function __construct()
        {
        }

        public function getId_presentacion()
        {
            return $this->id_presentacion;
        }

        public function getNombre_presentacion()
        {
            return $this->nombre_presentacion;
        }

        public function consultar($id_presentacion = ''){
            if ($id_presentacion != ''):
                $this->query = "
				SELECT id_presentacion, nombre_presentacion
				FROM tb_presentaciones
				WHERE id_presentacion = ?
                ";
            $this->primero = $id_presentacion;    
            $this->obtener_resultados_query(1);
            endif;
            if (count($this->rows) == 1):
                foreach ($this->rows[0] as $propiedad => $valor):
                    $this->$propiedad = $valor;
            endforeach;
            endif;
        }

        public function listar()
        {
            $this->query = '
			SELECT id_presentacion, nombre_presentacion
			FROM tb_presentaciones ORDER BY id_presentacion
			';
            $this->obtener_resultados_query(0);

            return $this->rows;
        }

        public function nuevo_editar($datos=array()){
            $resultado = false;
            foreach ($datos as $campo=>$valor):
                $$campo = $valor;
            endforeach;
            try {
            if($datos['accion'] == 'nuevo'){	
                $this->query = "
				INSERT INTO tb_presentaciones
				(id_presentacion, nombre_presentacion, update_at)
				VALUES
				(NULL, ?, NOW())
				";
                $stm = $this->abrir_preparar_cerrar('abrir');
                $stm->execute([
                    $nombre_presentacion
                ]);
                $this->abrir_preparar_cerrar('cerrar');    
            }
            else if($datos['accion'] == 'editar'){
                $this->query = "
                UPDATE tb_presentaciones
                SET nombre_presentacion = ?,
                update_at = NOW()
                WHERE id_presentacion = ?
                ";
                $stm = $this->abrir_preparar_cerrar('abrir');
                $stm->execute([
                    $nombre_presentacion,
                    $id_presentacion
                  ]);
                $this->abrir_preparar_cerrar('cerrar'); 
            }
            $resultado = true;
            }
            catch(Exception $e) {
                throw new Exception($e->getMessage());
            }
            return $resultado;    
        }

        public function borrar($id_presentacion = '')
        {
            $resultado = false;
			try{
            $this->query = "
            DELETE FROM tb_presentaciones
            WHERE id_presentacion = ?
            ";
			$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
                    $id_presentacion
				  ]);
				$this->abrir_preparar_cerrar('cerrar'); 
                $resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
			return $resultado;
        }

        public function __destruct()
        {
        }
    }
