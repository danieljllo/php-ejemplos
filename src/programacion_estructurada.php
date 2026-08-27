<!DOCTYPE html>
<html>
<body>

<?php

// Este ejemplo demuestra como en la programacion estructurada
// no existe el encapsulamiento y es mas facil cometer errores

// Estudiantes y calificacion
$estudiantes = array(
    "Juan" => 10,
    "Maria" => 12,
    "Pedro" => 7,
);

// Profesores y sueldos
$profesores = array(
    "Marta" => 30000,
    "Oscar" => 28000,
    "Lucia" => 45000,
);

function imprimirCalificaciones($array) {
    echo "<h1>Calificaciones</h1>";
    foreach( $array as $key => $value ){
    	echo "<p>".$key." : ".$value."</p>";
    }
}

function imprimirSueldos($array) {
    global $estudiantes;
    echo "<h1>Sueldos</h1>";
    foreach( $estudiantes as $key => $value ){
        echo "<p>".$key." : ".$value."</p>";
    }
}

imprimirCalificaciones($estudiantes);
imprimirSueldos($profesores);

?>
</body>
</html>