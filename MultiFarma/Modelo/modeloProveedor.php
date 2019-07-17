<?php
    require_once 'modeloAbstractoDB.php';
    class Proveedor extends ModeloAbstractoDB
    {
        private $id_proveedor;
        private $nombre_proveedor;
        private $direccion_proveedor;
        private $telefono_proveedor;
        private $id_ciudad;
        private $id_pais;
        private $email_proveedor;

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

        public function getEmail_proveedor()
        {
            return $this->email_proveedor;
        }

        public function consultar($id_proveedor = '')
        {
            if ($id_proveedor != ''):
                $this->query = "
                SELECT id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, 
                id_ciudad, id_pais, email_proveedor
				FROM tb_proveedores
				WHERE id_proveedor = ?
                ";
            $this->primero = $id_proveedor;    
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
            SELECT id_proveedor, nombre_proveedor, direccion_proveedor, telefono_proveedor, 
            ci.nombre_ciudad, pa.nombre_pais, email_proveedor
			FROM tb_proveedores AS pr
			INNER JOIN tb_paises AS pa ON (pr.id_pais = pa.id_pais)
			INNER JOIN tb_ciudades AS ci ON (pr.id_ciudad = ci.id_ciudad)
			ORDER BY id_proveedor
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
				INSERT INTO tb_proveedores
                (id_proveedor, nombre_proveedor, id_pais, id_ciudad, direccion_proveedor,
                telefono_proveedor, email_proveedor, update_at)
				VALUES
				(?, ?, ?, ?, ?, ?, ?, NOW())
				";
                $stm = $this->abrir_preparar_cerrar('abrir');
                $stm->execute([
                    $id_proveedor,
                    $nombre_proveedor,
                    $id_pais,
                    $id_ciudad,
                    $direccion_proveedor,
                    $telefono_proveedor,
                    $email_proveedor
                ]);
                $this->abrir_preparar_cerrar('cerrar');    
            }
            else if($datos['accion'] == 'editar'){
                $this->query = "
                UPDATE tb_proveedores
                SET nombre_proveedor = ?,  
                id_pais = ?,
                id_ciudad = ?,
                direccion_proveedor = ?, 
                telefono_proveedor = ?,
                email_proveedor = ?,
                update_at = NOW()
                WHERE id_proveedor = ?
                ";
                $stm = $this->abrir_preparar_cerrar('abrir');
                $stm->execute([
                    $nombre_proveedor,
                    $id_pais,
                    $id_ciudad,
                    $direccion_proveedor,
                    $telefono_proveedor,
                    $email_proveedor,
                    $id_proveedor
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

        public function borrar($id_proveedor = '')
        {
            $resultado = false;
			try{
            $this->query = "
            DELETE FROM tb_proveedores
            WHERE id_proveedor = ?
            ";
			$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
                    $id_proveedor
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
