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

        public function consultar($id_presentacion = '')
        {
            if ($id_presentacion != ''):
                $this->query = "
				SELECT id_presentacion, nombre_presentacion
				FROM tb_presentaciones
				WHERE id_presentacion = '$id_presentacion'
				";
            $this->obtener_resultados_query();
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
            $this->obtener_resultados_query();

            return $this->rows;
        }

        public function nuevo($datos = array())
        {
            if (array_key_exists('id_presentacion', $datos)):
                foreach ($datos as $campo => $valor):
                    $$campo = $valor;
            endforeach;
            $id_presentacion = utf8_decode($id_presentacion);
            $nombre_presentacion = utf8_decode($nombre_presentacion);
            $this->query = "
				INSERT INTO tb_presentaciones
				(id_presentacion, nombre_presentacion)
				VALUES
				('$id_presentacion', '$nombre_presentacion')
				";
            $resultado = $this->ejecutar_query_simple();

            return $resultado;
            endif;
        }

        public function editar($datos = array())
        {
            foreach ($datos as $campo => $valor):
                $$campo = $valor;
            endforeach;
            $this->query = "
			UPDATE tb_presentaciones
			SET nombre_presentacion='$nombre_presentacion'
			WHERE id_presentacion = '$id_presentacion'
			";
            $resultado = $this->ejecutar_query_simple();

            return $resultado;
        }

        public function borrar($id_presentacion = '')
        {
            $this->query = "
			DELETE FROM tb_presentaciones
			WHERE id_presentacion = '$id_presentacion'
			";
            $resultado = $this->ejecutar_query_simple();

            return $resultado;
        }

        public function __destruct()
        {
        }
    }
