<?php
namespace singleton;
?>
<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo de Patrón de Diseño Singleton en PHP</h1>
<?php
use singleton;

// Solo queremos que exista una instancia (objeto) de la clase Clasificados en el programa
class Clasificados
{
  // Variable estática que almacena la única instancia
  private static Clasificados $instancia;

  private int $numeroAvisos = 0;

  // Hacemos el constructor privado para que nadie lo pueda llamar
  private function __construct() { }

  // Creamos un método que regresa la instancia
  public static function getInstancia(): Clasificados
  {
    // La primera vez que llamamos este método la instancia no existe, así que la creamos
    if (!isset(self::$instancia)) {
      echo "Creo objeto Clasificados<br/>";
      self::$instancia = new Clasificados();
    }
    return self::$instancia;
  }

  // Luego ponemos el resto del código que nos permite usar la clase Clasificados
  // Crear avisos, borrar avisos, crear autores, etc
  public function crearAvisoLaboral() {
    echo "Creo Aviso Laboral<br/>";
    $this->numeroAvisos++;
  }
  
  public function getNumeroAvisos() { 
    echo $this->numeroAvisos . "<br/>";
  }

}

// En lugar de llamar el constructor de Clasificados usando 'new'
// llamamos el método que nos regresa una instancia
$clasificados1 = Clasificados::getInstancia();
$clasificados1->crearAvisoLaboral();
$clasificados1->crearAvisoLaboral();
$clasificados1->crearAvisoLaboral();
$clasificados1->getNumeroAvisos();

// La segunda vez que lo llamamos, nos regresa la misma instancia
// en lugar de construir una segunda instancia
$clasificados2 = Clasificados::getInstancia();
$clasificados2->getNumeroAvisos();

// Si un cliente intenta llamar el constructor recibe un error
$clasificados3 = new Clasificados(); // error! constructor es privado y no se puede llamar

?>

</body>
</html>