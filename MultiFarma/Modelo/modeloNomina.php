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
				pension, salud, salario_neto FROM tb_nominas WHERE id_nomina = '$id_nomina'";
				$this->obtener_resultados_query();
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
			
			$this->obtener_resultados_query();
			return $this->rows;
			
		}
		
		public function nuevo($datos=array()) {
			if(array_key_exists('id_nomina', $datos)):
				foreach ($datos as $campo=>$valor):
					$$campo = $valor;
				endforeach;
					
				   $salud = $salario_basico*0.04;
				   $pension = $salud;
				   $salario_neto = (($valor_hextrad*$hextrasd)+($valor_hextran*$hextrasn)+
				   (($salario_basico/30)*$dias_laborados))-($salud+$pension);
                   $salario_devengado = (($valor_hextrad*$hextrasd)+($valor_hextran*$hextrasn)+
				   (($salario_basico/30)*$dias_laborados));

         			$this->query = "
					INSERT INTO tb_nominas
					(id_nomina, id_empleado,fecha,salario_basico,hextrasd,
					hextrasn,auxilio_transporte,valor_hextrad,valor_hextran,
					dias_laborados,salario_devengado,pension,salud,salario_neto)
					VALUES
					(NULL, '$id_empleado', '$fecha','$salario_basico','$hextrasd','$hextrasn',
					'$auxilio_transporte','$valor_hextrad','$valor_hextran',
					'$dias_laborados','$salario_devengado','$pension','$salud','$salario_neto')
					";
					$resultado = $this->ejecutar_query_simple();
					return $resultado;
			endif;
			
		}
		
		public function editar($datos=array()) {
			foreach ($datos as $campo=>$valor):
				$$campo = $valor;
			endforeach;

			$salud = $salario_basico*0.04;
			$pension = $salud;
			$salario_neto = (($valor_hextrad*$hextrasd)+($valor_hextran*$hextrasn)+
			(($salario_basico/30)*$dias_laborados))-($salud+$pension);
            $salario_devengado = (($valor_hextrad*$hextrasd)+($valor_hextran*$hextrasn)+
			(($salario_basico/30)*$dias_laborados));

			$this->query = "
			UPDATE tb_nominas
			SET id_empleado ='$id_empleado',
			fecha ='$fecha',
			salario_basico ='$salario_basico',
			hextrasd ='$hextrasd',
			hextrasn ='$hextrasn',
			auxilio_transporte ='$auxilio_transporte',
			valor_hextrad ='$valor_hextrad',
			valor_hextran ='$valor_hextran',
			dias_laborados ='$dias_laborados',
			pension ='$pension',
			salud ='$salud',
			salario_neto ='$salario_neto'
			WHERE id_nomina = '$id_nomina'
			";
			$resultado = $this->ejecutar_query_simple();
			return $resultado;
		}
		
		public function borrar($id_nomina ='') {
			$this->query = "
			DELETE FROM tb_nominas
			WHERE id_nomina = '$id_nomina'
			";
			$resultado = $this->ejecutar_query_simple();

			return $resultado;
		}
		
        
		function __destruct() {
			//unset($this);
		}
	}
?>