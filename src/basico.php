<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplos básicos de Programación PHP</h1>
<?php

// Variables
$texto1 = 'Hola mundo!';
$texto2 = "Hola mundo!";
$numeroEntero = -56789;
$pi = 3.14159265;
$accesoPermitido = false;

// Operadores de comparación
$x = 100;  
$y = "100";
$z = 100.0;

var_dump($x == $y); // true
var_dump($x == $z); // true 
var_dump($x === $y); // false
var_dump($x === $z); // false

// Condicionales
// if...else
$edad = 20;
$tieneCredencialCivica = true;
if ($edad >= 18 && $tieneCredencialCivica) {
  echo "Puede votar :)";
} else {
  echo "NO puede votar :(";
}

// if...else forma abreviada
$nota = 10;
$juicio = $nota > 6 ? "Aprueba" : "A examen";

// if...elseif...else
$temperatura = 20;
if ($temperatura < 16) {
   echo "Me quedo en casa y prendo la estufa!";
} elseif ($temperatura < 26) {
   echo "Vamos al parque!";
} elseif ($temperatura < 36) {
   echo "Vamos a la playa!";
} else {
   echo "Me quedo en casa y prendo el aire!";
}

// switch...case
$pais = "Uruguay";
switch ($pais) {
  case "Argentina":
  case "Brasil":
  case "Bolivia":
  case "Paraguay":
  case "Uruguay":
    echo "Miembro Mercosur";
    break;
  case "Chile":
  case "Colombia": // ecuador y peru también
    echo "Miembro Asociado Mercosur";
    break;
  default:
    echo "No pertenece a Mercosur";
}

// Bucles
// for
for ($x = 0; $x <= 10; $x++) {
  echo "Numero es: $x <br>";
}

// foreach
$colores = array("rojo", "verde", "azul", "amarillo");
foreach ($colores as $color) {
  echo "$color <br>";
}

// Funciones
function sumar($x, $y) {
  $z = $x + $y;
  return $z;
}
echo sumar(4, 5);

// Arrelgos indexados
$carros = array("Volvo", "BMW", "Toyota");
echo $carros[0];
echo $carros[1];
echo $carros[2];

$lista = array("Hola", 55, true);
echo $lista[0];
echo $lista[1];
echo $lista[2];

// Arreglos asociativos
$estudiante = array("Nombre"=>"Juan", "Edad"=>25, "Casado"=>true);
echo $estudiante["Edad"];
echo $estudiante["Nombre"];

// Arreglos multidimensionales
$ticTacToe = array(
   array("X","O"," "),
   array("O","X","X"),
   array("O","O"," "),
);
$ticTacToe[2][2] = "X"; // gana X!

$estudiantes = array(
   array("Nombre"=>"Juan", "Edad"=>25, "Casado"=>true),
   array("Nombre"=>"Maria", "Edad"=>20, "Casado"=>false),
   array("Nombre"=>"Luisa", "Edad"=>35, "Casado"=>true),
);
echo $estudiantes[0]["Edad"];
echo $estudiantes[1]["Nombre"];

// Conversiones de tipos de datos: casting
$a = 5;       // entero
$b = 5.34;    // decimal
$c = "hello"; // cadena de texto
$d = true;    // booleano

$a = (string) $a;
$b = (string) $b;
$c = (string) $c;
$d = (string) $d;
$e = (string) 3.141592;

echo $a . "<br>";
echo $b . "<br>";
echo $c . "<br>";
echo $d . "<br>";
echo $e . "<br>";


$numeroEntero = (int) 5.99999; // resulta en 5
echo $numeroEntero . "<br>";
$numeroEntero = (int) round(5.99999); // resulta en 6
echo $numeroEntero . "<br>";

?>

</body>
</html>