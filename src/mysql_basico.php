<?php
namespace mysql_basico;
?>
<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo conexión a MySQL en PHP</h1>
<?php
use mysqli;
use Exception;
use PDO;

// Conexion a MySQL sin definir una base de datos
$conexion = new mysqli("localhost", "root", /*"password"*/);
// la contraseña se define en php.ini -> mysqli.default_pw
// !!! Este NO es un metodo seguro de almacenar la contraseña !!!
//    Un usuario puede ejecutar este codigo y ver la contraseña:
//    echo ini_get("mysqli.default_pw");

// Verificar que la conexión se realizo
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a MySQL.</br>";
    echo $conexion->host_info . "</br>";
}
echo "<hr/>";

// Validar si la base de datos existe
// Metodo 1:
$baseDeDatos = "db_prueba";
$sql = "SHOW DATABASES LIKE '$baseDeDatos'";
$result = $conexion->query($sql);
echo "Metodo 1: Validar si la base de datos $baseDeDatos existe: </br>";
if ($result->fetch_row() != null) {
  echo "Existe!</br>";
  echo $result->fetch_row();
}
else {
  echo "La base de datos $baseDeDatos no existe </br>";
}
echo "<hr/>";

// Metodo 2:
echo "Metodo 2: Validar si la base de datos $baseDeDatos existe: </br>";
try {
  $db_selected = $conexion->select_db($baseDeDatos);
  if (!$db_selected) {
    echo "Error seleccionando la base de datos: " . $conexion->error . "</br>";
  }
  else {
    echo "Base de datos seleccionada exitosamente.</br>" ;
  }
}
catch (Exception $e) {
  echo "Exception seleccionando la base de datos: " . $conexion->error . "</br>";
}
echo "<hr/>";

// Crear la base de datos
$sql = "CREATE DATABASE $baseDeDatos";
//$sql = "CREATE DATABASE IF NOT EXISTS $baseDeDatos";
if ($conexion->query($sql) === TRUE) {
  echo "Base de datos $baseDeDatos creada exitosamente. </br>";
} else {
  echo "Error creando la base de datos $baseDeDatos: " . $conexion->error;
}
echo "<hr/>";

try {
  $db_selected = $conexion->select_db($baseDeDatos);
  if (!$db_selected) {
    echo "Error seleccionando la base de datos: " . $conexion->error . "</br>";
  }
  else {
    echo "Base de datos seleccionada exitosamente.</br>" ;
  }
}
catch (Exception $e) {
  echo "Exception seleccionando la base de datos: " . $conexion->error . "</br>";
}
echo "<hr/>";

// Crear una tabla para pruebas
$tabla = "Alumnos";
//$sql = "CREATE TABLE IF NOT EXISTS $tabla (
$sql = "CREATE TABLE $tabla (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL,
  apellido VARCHAR(50) NOT NULL,
  email VARCHAR(50),
  edad INT
)";
if ($conexion->query($sql) === TRUE) {
  echo "Tabla $tabla creada exitosamente. </br>";
} else {
  echo "Error creando la tabla $tabla: " . $conexion->error;
}
echo "<hr/>";

$sql = "INSERT INTO $tabla (nombre, apellido, email, edad)
VALUES ('Juan', 'Perez', 'juanperez@gmail.com', 20),
('Maria', 'Rojas', 'maria.rojas@hotmail.com', 25),
('Luis', 'Tejada', 'ltejada@gmail.com', 19),
('Camila', 'Ruiz', 'camila.ruiz@gmail.com', 32)";
if ($conexion->query($sql) === TRUE) {
  echo "Inserta valores en $tabla exitosamente. </br>";
} else {
  echo "Error insertando valores en tabla $tabla: " . $conexion->error;
}
echo "<hr/>";

// Probando una conexion y un query usando PDO
$dbh = new PDO("mysql:host=localhost;dbname=$baseDeDatos", "root", ini_get("mysqli.default_pw"));
// usar la conexión aquí
$sth = $dbh->query('SELECT * FROM Alumnos');
$filas = $sth->fetchAll();
foreach ($filas as $fila) {
  echo $fila["nombre"] . "</br>";
  echo $fila["apellido"] . "</br>";
  echo $fila["email"] . "</br>";
  echo $fila["edad"] . "</br>";
}
// Cerrar la conexión PDO
$sth = null;
$dbh = null;
echo "<hr/>";

// Eliminar la base de datos para poder volver a ejecutar todo el codigo
$sql = "DROP DATABASE IF EXISTS $baseDeDatos";
if ($conexion->query($sql) === TRUE) {
  echo "Base de datos $baseDeDatos eliminada exitosamente. </br>";
} else {
  echo "Error eliminando la base de datos $baseDeDatos: " . $conexion->error;
}

// Cerrar la conexión MySQLi
$conexion->close();
?>

</body>
</html>