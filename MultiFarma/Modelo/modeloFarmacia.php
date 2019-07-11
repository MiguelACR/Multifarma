<?php
    require_once 'modeloAbstractoDB.php';
    class Farmacia extends ModeloAbstractoDB
    {
        private $id_farmacia;
        private $nombre_farmacia;
        private $direccion_farmacia;
        private $telefono_farmacia;
        private $id_ciudad;
        private $id_pais;
        private $id_propietario;
        private $id_rol;
        private $id_usuario;
       
        public function __construct()
        {
        }

        public function getId_farmacia()
        {
            return $this->id_farmacia;
        }

        public function getNombre_farmacia()
        {
            return $this->nombre_farmacia;
        }

        public function getDireccion_farmacia()
        {
            return $this->direccion_farmacia;
        }

        public function getTelefono_farmacia()
        {
            return $this->telefono_farmacia;
        }

        public function getId_ciudad()
        {
            return $this->id_ciudad;
        }

        public function getId_pais()
        {
            return $this->id_pais;
        }

        public function getId_propietario()
        {
            return $this->id_propietario;
        }

        public function getId_rol()
        {
            return $this->id_rol;
        }

        public function getId_usuario()
        {
            return $this->id_usuario;
        }

        public function consultar($id_farmacia = '')
        {
            if ($id_farmacia != ''):
                $this->query = "
				SELECT id_farmacia, nombre_farmacia, direccion_farmacia, telefono_farmacia, id_ciudad, id_pais, id_propietario, r.id_rol, f.id_usuario 
                FROM tb_farmacias f
                INNER JOIN tb_usuarios u ON u.id_usuario = f.id_usuario
			    INNER JOIN tb_roles r ON u.id_rol = r.id_rol 
				WHERE id_farmacia = ?
                ";
            $this->primero = $id_farmacia;    
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
			SELECT id_farmacia, nombre_farmacia, direccion_farmacia, telefono_farmacia, CONCAT(p.nombre_propietario," ",p.apellido_propietario) nombre_propietario, u.nickname_usuario, c.nombre_ciudad, pa.nombre_pais
			FROM tb_farmacias AS f
			INNER JOIN tb_ciudades AS c ON (c.id_ciudad=f.id_ciudad)
			INNER JOIN tb_propietarios AS p ON (p.id_propietario=f.id_propietario)
			INNER JOIN tb_usuarios AS u ON (u.id_usuario=f.id_usuario)
			INNER JOIN tb_paises AS pa ON (pa.id_pais=f.id_pais)
			ORDER BY nombre_farmacia
			';
            $this->obtener_resultados_query(0);
            return $this->rows;
        }

        public function nuevo_editar($datos=array()){
            $resultado = false;
			try {
            if($datos['accion'] == 'nuevo'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
				INSERT INTO tb_farmacias
				(id_farmacia, nombre_farmacia, direccion_farmacia, 
                telefono_farmacia, id_pais, id_ciudad, id_propietario, id_usuario, update_at)
				VALUES
				(NULL, ?, ?, ?, ?, ?, ?, ?, NOW())
				";
			    $stm = $this->abrir_preparar_cerrar('abrir');
			    $stm->execute([
				  $nombre_farmacia,
				  $direccion_farmacia,
				  $telefono_farmacia,
				  $id_pais,
				  $id_ciudad,
                  $id_propietario,
                  $id_usuario
			    ]);
				$this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
				$this->query = "
			    UPDATE tb_farmacias
                SET nombre_farmacia = ?, 
                direccion_farmacia = ?, 
                telefono_farmacia = ?,
                id_pais = ?, 
                id_ciudad = ?,
                id_propietario = ?,
                id_usuario = ?,
                update_at = NOW()
			    WHERE id_farmacia = ?
			";
				$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
					$nombre_farmacia,
					$direccion_farmacia,
					$telefono_farmacia,
                    $id_pais,
					$id_ciudad,
					$id_propietario,
                    $id_usuario,
                    $id_farmacia
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

        public function borrar($id_farmacia = '')
        {
            $resultado = false;
            try{
            $this->query = "
			DELETE FROM tb_farmacias
			WHERE id_farmacia = ?
			";
            $stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
                    $id_farmacia
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
