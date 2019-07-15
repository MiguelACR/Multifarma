<?php
    require_once 'modeloAbstractoDB.php';
    class Proveedor extends ModeloAbstractoDB
    {
        public $id_proveedor;
        public $nombre_proveedor;
        public $direccion_proveedor;
        public $telefono_proveedor;
        public $id_ciudad;
        public $id_pais;

        public function __construct()
        {
        }

        public function getId_proveedor()
        {
            return $this->id_proveedor;
        }

        public function getNombre_proveedor()
        {
            return $this->nombre_proveedor;
        }

        public function getDireccion_proveedor()
        {
            return $this->direccion_proveedor;
        }

        public function getTelefono_proveedor()
        {
            return $this->telefono_proveedor;
        }

        public function getId_ciudad()
        {
            return $this->id_ciudad;
        }

        public function getId_pais()
        {
            return $this->id_pais;
        }

        public function consultar($id_proveedor = '')
        {
            if ($id_proveedor != ''):
                $this->query = "
				SELECT id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, id_ciudad, id_pais
				FROM tb_proveedores
				WHERE id_proveedor = '$id_proveedor'
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
			SELECT id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, ci.nombre_ciudad, pa.nombre_pais
			FROM tb_proveedores AS pr
			INNER JOIN tb_paises AS pa ON (pr.id_pais = pa.id_pais)
			INNER JOIN tb_ciudades AS ci ON (pr.id_ciudad = ci.id_ciudad)
			ORDER BY nombre_proveedor
			';
            $this->obtener_resultados_query(0);

            return $this->rows;
        }

        public function nuevo_editar(){
            
        }

        public function nuevo($datos = array())
        {
            if (array_key_exists('id_proveedor', $datos)):
                foreach ($datos as $campo => $valor):
                    $$campo = $valor;
            endforeach;
            $id_proveedor = utf8_decode($id_proveedor);
            $nombre_proveedor = utf8_decode($nombre_proveedor);
            $direccion_proveedor = utf8_decode($direccion_proveedor);
            $telefono_proveedor = utf8_decode($telefono_proveedor);
            $id_ciudad = utf8_decode($id_ciudad);
            $id_pais = utf8_decode($id_pais);
            $this->query = "
				INSERT INTO tb_proveedores
				(id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, id_ciudad, id_pais)
				VALUES
				(NULL, '$nombre_proveedor', '$direccion_proveedor', '$telefono_proveedor', '$id_ciudad', '$id_pais')
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
			UPDATE tb_proveedores
			SET nombre_proveedor='$nombre_proveedor', direccion_proveedor='$direccion_proveedor', telefono_proveedor='$telefono_proveedor', id_ciudad='$id_ciudad', id_pais='$id_pais'
			WHERE id_proveedor = '$id_proveedor'
			";
            $resultado = $this->ejecutar_query_simple();

            return $resultado;
        }

        public function borrar($id_proveedor = '')
        {
            $this->query = "
			DELETE FROM tb_proveedores
			WHERE id_proveedor = '$id_proveedor'
			";
            $resultado = $this->ejecutar_query_simple();

            return $resultado;
        }

        public function __destruct()
        {
        }
    }
