<?php

class Persona
{
    protected $nombre;
    protected $apellidos;
    protected $fecha_actual;
    private $edad;
    public function __construct($nombre,$apellidos)
    {
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        date_default_timezone_set("America/Bogota");
        $this->fecha_actual=date('Y-m-d H:i:s');
        $this->edad=0;
    }


    public function diasproximocumpleanos($fecha_nacimiento)
    {
    $proximo_cumple = strtotime ( '+'.$this->edad+1 .' year' , strtotime ( $fecha_nacimiento ) ) ;
    $proximo_cumple = date ( 'Y-m-d' , $proximo_cumple );
    $fecha_actual=new DateTime($this->fecha_actual);
    $fecha_nacimiento=new DateTime($proximo_cumple);
    $resultado=$fecha_actual->diff($fecha_nacimiento);
    return $resultado->days;
    }

    public function edad($fecha_nacimiento){
      $this->edad= date('Y-m-d') - $fecha_nacimiento;
      return $this->edad;
    }
}


?>
