<?php
require_once('view.php');
require_once('Persona.php');
require_once('Empleado.php');

if(isset($_POST['registrar']))
{
$empleado= new Empleado($_POST['cargo'],$_POST['fecha_ingreso'],$_POST['salario_base']);
$salario=$empleado->salario();
$edad=$empleado->edad($_POST['fecha_nacimiento']);
$dias=$empleado->diasproximocumpleanos($_POST['fecha_nacimiento']);
print $_POST['nombre']." " .$_POST['apellido'] ." Su edad es: " .$edad. " faltan " . $dias ." dias para su cumpleaños.<br>";

print "Salario= ".$salario.'<br>';

echo json_encode(['Empleado'=>$_POST['nombre']." ".$_POST['apellido'] ,'edad'=> $edad,'diasproximocumpleanos'=> $dias ,'salario'=> $salario]);
}
