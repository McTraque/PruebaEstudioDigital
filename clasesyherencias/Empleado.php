<?php
class Empleado extends Persona
{
    private $cargo;
    private $fechaingreso;
    private $salariobase;
    public function __construct($cargo, $fecha_ingreso, $salario_base)
    {
        $this->cargo=$cargo;
        $this->fechaingreso=$fecha_ingreso;
        $this->salariobase=$salario_base;
    }



    public function salario(){
      $edad=$this->edad($_POST['fecha_nacimiento']);
      $fecha_actual=date('Y-m-d');
      $fecha_ingreso=new DateTime($this->fechaingreso);
      $fecha_actual=new DateTime($fecha_actual);
      $resultado=$fecha_ingreso->diff($fecha_actual);
      $laborados=$resultado->y;
      if($laborados < 3)
      {
        $this->salariobase=$this->salariobase+($this->salariobase*0.2);
      }else if($laborados >= 3)
      {
        $this->salariobase=$this->salariobase+($this->salariobase*0.4);
      }
      if($edad>=30)
      {
        $this->salariobase=$this->salariobase+100000;
      }
      return json_encode($this->salariobase);
    }
}

?>
