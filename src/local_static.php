<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo de Local y Static - Programación PHP</h1>
<?php

function funcion1() {
  // Definir una variable local e incrementarla
  $varLocal = 0;
  $varLocal++;
  
  // Definir una variable estatica e incrementarla
  static $varStatic = 0;
  $varStatic++;
  
  echo "Variable Local: $varLocal y Estatica: $varStatic </br>";
}

funcion1();
funcion1();
funcion1();
funcion1();
funcion1();

?>

</body>
</html>