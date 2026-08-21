<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo de Global - Programación PHP</h1>
<?php

// Definir una variable global
$varGlobal = 5;

function funcion1() {
  // No es posible usarla en esta funcion...
  echo "Funcion 1: $varGlobal</br>";
}
function funcion2() {
  // Se puede usar en esta funcion, porque explicitamente la importamos con la primitiva 'global'
  global $varGlobal;
  echo "Funcion 2: $varGlobal</br>";
}
function funcion3() {
  // Se puede acceder desde el arreglo asociativo $GLOBALS
  $x = $GLOBALS['varGlobal'];
  echo "Funcion 3: $x</br>";
}

// Se puede acceder desde el contexto global
echo "Variable global: $varGlobal</br>";

funcion1();
funcion2();
funcion3();

?>

</body>
</html>