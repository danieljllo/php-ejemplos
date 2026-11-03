<?php
namespace excepciones;
?>
<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo de Excepciones en PHP</h1>
<?php
use mysqli;
use Exception;
use DivisionByZeroError;
use TypeError;

function dividir(int $x, int $y) {
  return $x / $y;
}
$c = false;
$a = 5;
$b = 2;
try {
  echo "Division: " . dividir($a, $b) . "</br>";
}
catch (DivisionByZeroError $e) {
  echo "<h2>Excepcion DivisionByZeroError!!!</h2>";
  echo "Mensaje: " . $e->getMessage() . "</br>";
  echo "Codigo: " . $e-> getCode() . "</br>";
  echo "Archivo: " . $e->getFile() . "</br>";
  echo "Linea: " . $e->getLine() . "</br>";
}
catch (TypeError $e) {
  echo "<h2>Excepcion TypeError!!!</h2>";
  echo "Mensaje: " . $e->getMessage() . "</br>";
  echo "Codigo: " . $e-> getCode() . "</br>";
  echo "Archivo: " . $e->getFile() . "</br>";
  echo "Linea: " . $e->getLine() . "</br>";
}

echo "<hr/>";

$conexion = null;
try {
  echo "Comienza el try <br/>";
  // Conexion
  $conexion = new mysqli("localhost", "root", /*"password"*/);

  // Crear base de datos
  $baseDeDatos = "db_prueba";
  $sql = "CREATE DATABASE $baseDeDatos";
  $conexion->query($sql);

  // Seleccionar base de datos
  $conexion->select_db($baseDeDatos);

  // Crear tabla
  $tabla = "Alumnos";
  $sql = "CREATE TABLE $tabla (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    edad INT
  )";
  $conexion->query($sql);

  // Insertar valores
  $sql = "INSERT INTO $tabla (nombre, apellido, email, edad)
    VALUES ('Juan', 'Perez', 'juanperez@gmail.com', 20),
    ('Maria', 'Rojas', 'maria.rojas@hotmail.com', 25),
    ('Luis', 'Tejada', 'ltejada@gmail.com', 19),
    ('Camila', 'Ruiz', 'camila.ruiz@gmail.com', 32)";
  $conexion->query($sql);

  // Eliminar la base de datos para poder volver a ejecutar todo el codigo
  $sql = "DROP DATABASE IF EXISTS $baseDeDatos";
  $conexion->query($sql);
  echo "Finaliza el try <br/>";
}
catch (Exception $e) {
  echo "<h2>Excepcion!!!</h2>";
  echo "Mensaje: " . $e->getMessage() . "</br>";
  echo "Codigo: " . $e-> getCode() . "</br>";
  echo "Archivo: " . $e->getFile() . "</br>";
  echo "Linea: " . $e->getLine() . "</br>";
}
finally {
  echo "Ejecuta el finally <br/>";
  // Cerrar la conexión MySQLi
  if ($conexion != null) {
    $conexion->close();
  }
}

?>

</body>
</html>