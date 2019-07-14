<?php
    require_once("modeloAbstractoDB.php");
	
    class Nomina extends ModeloAbstractoDB {
		
		private $id_nomina;
		private $id_empleado;
		private $fecha;
		private $salario_basico;
		private $hextrasd;
		private $hextrasn;
		private $auxilio_transporte;
		private $valor_hextrad;
		private $valor_hextran;
		private $dias_laborados;
		private $salario_devengado;
		private $pension;
		private $salud;
		private $salario_neto;


		function __construct() {
			//$this->db_name = '';
		}

		public function getId_nomina(){
			return $this->id_nomina;
		}

		public function getId_empleado(){
			return $this->id_empleado;
		}
		
		public function getFecha(){
			return $this->fecha;
		}
		public function getSalario_basico(){
			return $this->salario_basico;
		}
		public function getHextrasd(){
			return $this->hextrasd;
		}
		public function getHextrasn(){
			return $this->hextrasn;
		}
		public function getAuxilio_transporte(){
			return $this->auxilio_transporte;
		}
		public function getValor_hextrad(){
			return $this->valor_hextrad;
		}
		public function getValor_hextran(){
			return $this->valor_hextran;
		}
		public function getDias_laborados(){
			return $this->dias_laborados;
		}
		public function getSalario_devengado(){
			return $this->salario_devengado;
		}
		public function getPension(){
			return $this->pension;
		}
		public function getSalud(){
			return $this->salud;
		}
		public function getSalario_neto(){
			return $this->salario_neto;
		}


		public function consultar($id_nomina='') {
			if($id_nomina !=''):
				$this->query = "
				SELECT id_nomina, id_empleado, fecha, salario_basico, hextrasd, hextrasn,
				auxilio_transporte, valor_hextrad, valor_hextran, dias_laborados, salario_devengado,
				pension, salud, salario_neto FROM tb_nominas WHERE id_nomina = ?";
				$this->primero = $id_nomina;
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
			SELECT id_nomina, CONCAT (e.nombre_empleado,'',e.apellido_empleado) as nombre, fecha, salario_basico, hextrasd, 
			hextrasn, auxilio_transporte , valor_hextrad, valor_hextran, dias_laborados, salario_devengado, 
			pension, salud, salario_neto FROM tb_nominas as n 
			INNER JOIN tb_empleados as e on (n.id_empleado = e.id_empleado) ORDER BY id_nomina
			";
			$this->obtener_resultados_query(0);
			return $this->rows;
		}
		
        public function nuevo_editar($datos=array()){
			$resultado = false;
			try {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;
			$retorno = $this->calculos($salario_basico, $valor_hextrad, $valor_hextran, $hextrasd, $hextrasn, 
			$dias_laborados);
            if($datos['accion'] == 'nuevo'){
         		 $this->query = "
				 INSERT INTO tb_nominas
				 (id_nomina, id_empleado,fecha,salario_basico,hextrasd,
				 hextrasn,auxilio_transporte,valor_hextrad,valor_hextran,
				 dias_laborados,salario_devengado,pension,salud,salario_neto)
				 VALUES
				 (NULL, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				 ";
			     $stm = $this->abrir_preparar_cerrar('abrir');
			     $stm->execute([
				 	$id_empleado,
				 	$salario_basico,
				 	$hextrasd,
				 	$hextrasn,
				 	$auxilio_transporte,
				 	$valor_hextrad,
				 	$valor_hextran,
				 	$dias_laborados,
				 	$retorno['salario_devengado'],
				 	$retorno['pension'],
				 	$retorno['salud'],
				 	$retorno['salario_neto']
			     ]);
				 $this->abrir_preparar_cerrar('cerrar');    
			}
			else if($datos['accion'] == 'editar'){
			    $this->query = "
			    UPDATE tb_nominas
			    SET id_empleado = ?,
			    fecha = NOW(),
			    salario_basico = ?,
			    hextrasd = ?,
			    hextrasn = ?,
			    auxilio_transporte = ?,
			    valor_hextrad = ?,
			    valor_hextran = ?,
				dias_laborados = ?,
				salario_devengado = ?,
			    pension = ?,
			    salud = ?,
			    salario_neto = ?
			    WHERE id_nomina = ?
			 ";
				$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
					$id_empleado,
					$salario_basico,
					$hextrasd,
                    $hextrasn,
					$auxilio_transporte,
					$valor_hextrad,
                    $valor_hextran,
					$dias_laborados,
					$retorno['salario_devengado'],
					$retorno['pension'],
					$retorno['salud'],
					$retorno['salario_neto'],
                    $id_nomina
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

		public function borrar($id_nomina ='') {
			$resultado = false;
			try{
			$this->query = "
			DELETE FROM tb_nominas
			WHERE id_nomina = ?
			";
			$stm = $this->abrir_preparar_cerrar('abrir');
				$stm->execute([
                    $id_nomina
				  ]);
				$this->abrir_preparar_cerrar('cerrar'); 
                $resultado = true;
			}
			catch(Exception $e) {
				throw new Exception($e->getMessage());
			}
			return $resultado;
		}
		
		private function calculos($basico, $val_hextrad, $val_hextran, $can_hextrasd, $can_hextrasn, $dias_lab){
		$descuento = $basico * 0.04;
		$salud = ($basico*0.085) + $descuento;
		$pension = ($basico*0.12) + $descuento;
		$salario_devengado = (($val_hextrad*$can_hextrasd)+($val_hextran*$can_hextrasn)+
		(($basico/30)*$dias_lab));
		$salario_neto =  $salario_devengado - ($descuento+$descuento);
		$resul = array(
			'salud' => $salud,
			'pension' => $pension,
			'salario_devengado' => $salario_devengado,
			'salario_neto' => $salario_neto 
		);
		return $resul;
		}
        
		function __destruct() {
			//unset($this);
		}
	}
?>