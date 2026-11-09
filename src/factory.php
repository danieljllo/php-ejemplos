<?php
namespace factory;
?>
<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo de Patrón de Diseño Factory Method en PHP</h1>
<?php
use factory;

// Tenemos una jerarquía de objetos que queremos crear.
// En este caso tenemos Avisos clasificados de 3 tipos diferentes
class Aviso { }

class AvisoLaboral extends Aviso {
  public function __construct() {
    echo "Creo AvisoLaboral<br/>";
  }
}

class AvisoProducto extends Aviso {
  public function __construct() {
    echo "Creo AvisoProducto<br/>";
  }
}

class AvisoInmobiliario extends Aviso {
  public function __construct() {
    echo "Creo AvisoInmobiliario<br/>";
  }
}

// Creamos una clase que administre la creación de objetos
class FabricaDeAvisos
{
  // Factory Method: este es el método que nos fabrica los objetos
  public function fabricarAviso(string $tipo): Aviso | null
  {
    switch ($tipo) {
      case "Laboral":
        return new AvisoLaboral();
      case "Producto":
        return new AvisoProducto();
      case "Inmobiliario":
        return new AvisoInmobiliario();
      default:
        echo "Tipo de aviso inválido<br/>";
        return null;
    }
  }
}

// En lugar de llamar los constructores de cada aviso, usamos
// la FabricaDeAvisos y el método fabricarAviso() para crearlos
$fabrica = new FabricaDeAvisos();
$aviso1 = $fabrica->fabricarAviso("Laboral");
$aviso2 = $fabrica->fabricarAviso("Producto");
$aviso3 = $fabrica->fabricarAviso("Inmobiliario");
$aviso4 = $fabrica->fabricarAviso("Spam");

?>

</body>
</html>