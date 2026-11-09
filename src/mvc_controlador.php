<?php
namespace controlador;
?>
<!DOCTYPE HTML>
<html>
<body>  
<h1>Ejemplo de Patrón de Arquitectura MVC en PHP</h1>
<?php
namespace controlador;

include 'mvc_modelo.php';
include 'mvc_vista.php';

$modelo = new \modelo\Datos();
$vista1 = new \vista\VistaTabla();
$vista1->mostrarDatos($modelo->getNombre(), $modelo->getEdad());

$vista2 = new \vista\VistaLista();
$vista2->mostrarDatos($modelo->getNombre(), $modelo->getEdad());

?>
</body>
</html>