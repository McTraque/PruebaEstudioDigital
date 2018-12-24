<?php

$pronostico = simplexml_load_file("http://xml.tutiempo.net/xml/70140.xml");
$tiempo=$pronostico->pronostico_dias->dia;
$pais=$pronostico->localidad->pais;
$ciudad=$pronostico->localidad->nombre;

print "<h3> Pronóstico para el día de hoy en: </h3>";
print $ciudad." - ".$pais ."<br>";

echo '<ul>';
echo '<li> Fecha: '.$tiempo->fecha_larga.'</li>';
echo '<li> Temperatura máxima: '.$tiempo->temp_maxima.'</li>';
echo '<li> Temperatura minima: '.$tiempo->temp_minima.'</li>';
echo '<li> Pronóstico: '.$tiempo->texto.'</li>';
echo '<li> Humedad: '.$tiempo->humedad.'</li>';
echo '<li> Salida del sol: '.$tiempo->salida_sol.'</li>';
echo '<li> Puesta del sol: '.$tiempo->puesta_sol.'</li>';
echo '</ul>';
