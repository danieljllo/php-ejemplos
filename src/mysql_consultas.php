<?php
namespace mysql_consultas;
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

// Crear la base de datos
$baseDeDatos = "db_prueba";
//$sql = "CREATE DATABASE $baseDeDatos";
$sql = "CREATE DATABASE IF NOT EXISTS $baseDeDatos";
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
//$sql = "CREATE TABLE $tabla (
$sql = "CREATE TABLE IF NOT EXISTS $tabla (
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

// Insertar elementos en la tabla
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

// Ejemplo de un ciberataque usando inyeccion SQL
$nombre = "Pedro";
$apellido = "Lopez";
$email = "plopez@gmail.com";
//$edad = "22'); DROP TABLE Alumnos; -- ";
$edad = 22;
$sql = "INSERT INTO $tabla (nombre, apellido, email, edad)
  VALUES ('$nombre', '$apellido', '$email', '$edad')";
echo $sql . "<br/>";
// La función 'query' solo permite ejecutar 1 query SQL a la vez precisamente
// para evitar ataques de inyeccion.
// Para fines ilustrativos usaremos la funcion 'multi_query'.
if ($conexion->multi_query($sql) === TRUE) {
  echo "Inserta valores en $tabla exitosamente. </br>";
} else {
  echo "Error insertando valores en tabla $tabla: " . $conexion->error;
}
echo "<hr/>";

// Insertar elementos en la tabla usando Parametrizacion de Sentencias (Prepared Statements)
// $edad = "22'); DROP TABLE Alumnos; -- ";
// $stmt = $conexion->prepare(
//     "INSERT INTO $tabla (nombre, apellido, email, edad)
//      VALUES (?, ?, ?, ?)"
// );
// $stmt->bind_param("sssi", $nombre, $apellido, $email, $edad);
// $stmt->execute();

// Borrando valores de la tabla
$sql = "DELETE FROM $tabla WHERE nombre='Juan'";
if ($conexion->query($sql) === TRUE) {
  echo "Borra valores en tabla exitosamente. </br>";
} else {
  echo "Error borrando valores en tabla: " . $conexion->error;
}
echo "<hr/>";

// Actualizando valores de la tabla
$sql = "UPDATE $tabla
  SET nombre='Luis Alberto', apellido='Tejada Gonzales'
  WHERE nombre='Luis'";
if ($conexion->query($sql) === TRUE) {
  echo "Actualiza valores en tabla exitosamente. </br>";
} else {
  echo "Error actualizando valores en tabla: " . $conexion->error;
}
echo "<hr/>";

// Realizando una consulta
$edadMinima = 20;
$sql = "SELECT * FROM $tabla WHERE edad > $edadMinima";
$resultado = $conexion->query($sql);
if ($resultado->num_rows > 0) {
  foreach ($resultado as $fila) {
    echo " Nombre completo: " . $fila['nombre'] . " " . $fila['apellido'] . " - Edad: " . $fila['edad'] . "<br/>";
}
} else {
  echo "Ningun alumno tiene más de $edadMinima años";
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