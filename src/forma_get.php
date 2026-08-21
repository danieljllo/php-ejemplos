<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php
// 1. definir variables e inicializar en blanco
$nombreError = "";
$nombre = "";

// 2. verificar si la solicitud es de tipo GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  // 3. validar las entradas
  if (empty($_GET["nombre"])) {
    $nombreError = "Nombre es requerido";
  } else {
    $nombre = sanitizar_entrada($_GET["nombre"]);
    // validar que nombre solo contiene letras o espacios.
    // usando expresiones regulares (regex)
    // https://es.wikipedia.org/wiki/Expresión_regular
    // https://regexr.com
    if (!preg_match("/^[a-zA-Z ]*$/",$nombre)) {
      $nombreError = "Solo letras o espacios son permitidos";
    }
  }
}

// funcion para sanitizar entradas
function sanitizar_entrada($entrada) {
  $entrada = trim($entrada);
  $entrada = stripslashes($entrada);
  $entrada = htmlspecialchars($entrada);
  return $entrada;
}
?>

<h2>Forma PHP (GET)</h2>
<p><span class="error">* campo requerido</span></p>
<!-- Forma HTML donde especifimos las entradas y el metodo de solicitud GET -->
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>">
  <span class="error">* <?php echo $nombreError;?></span>
  <input type="submit" nombre="submit" value="Submit">  
</form>

<?php
// En esta sección del HTML se muestran las entradas que recibimos
echo "<h2>Informacion:</h2>";
echo "Nombre: ";
echo $nombre;
?>

</body>
</html>