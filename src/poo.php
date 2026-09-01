<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo Programación Orientada a Objetos (POO) en PHP</h1>
<?php

//////////////////////////////////////////////////////////////////////////////
// Propiedades o Atributos
//////////////////////////////////////////////////////////////////////////////
class PeliculaAnimada1 {
  public $nombre = "";
  private $fecha = 0;
}

$shrek = new PeliculaAnimada1();
$shrek->nombre = "Shrek";
//$shrek->fecha = 2001; // no se puede accesar un atributo privado

//////////////////////////////////////////////////////////////////////////////
// Métodos
//////////////////////////////////////////////////////////////////////////////
class PeliculaAnimada2 {
  public $nombre = "";
  private $fecha = 0;

  public function mostrarDetalles() {
    echo "Película: " . $this->nombre . " ($this->fecha)</br>";
  }
  
  public function asignarFecha($fecha) {
    if ($this->validarFecha($fecha))
      $this->fecha = $fecha;
  }

  private function validarFecha($fecha) {
    if ($fecha >= 1900 and $fecha < 2027) {
      return true;
    }
    return false;
  }
}

$shrek = new PeliculaAnimada2();
$shrek->mostrarDetalles();

$shrek->nombre = "Shrek";
//$shrek->fecha = 2001; // no se puede accesar un atributo privado
$shrek->asignarFecha(2001);
$shrek->mostrarDetalles();

//////////////////////////////////////////////////////////////////////////////
// Métodos Get y Set
//////////////////////////////////////////////////////////////////////////////
class PeliculaAnimada3 {
  private $nombre = "";
  private $fecha = 0;

  public function mostrarDetalles() {
    echo "Película: " . $this->nombre . " ($this->fecha)</br>";
  }
  
  public function getNombre() {
    return $this->nombre;
  }

  public function getFecha() {
    return $this->fecha;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setFecha($fecha) {
    if ($this->validarFecha($fecha))
      $this->fecha = $fecha;
  }

  private function validarFecha($fecha) {
    if ($fecha >= 1900 and $fecha < 2027) {
      return true;
    }
    return false;
  }
}

$shrek = new PeliculaAnimada3();
$shrek->mostrarDetalles();

$shrek->setNombre("Shrek");
$shrek->setFecha(2001);
$shrek->mostrarDetalles();
echo "La fecha es: " . $shrek->getFecha() . " </br>";

//////////////////////////////////////////////////////////////////////////////
// Constructor y Destructor
//////////////////////////////////////////////////////////////////////////////
class PeliculaAnimada4 {
  private $nombre = "";
  private $fecha = 0;

  function __construct($nombre, $fecha) {
    $this->nombre = $nombre;
    $this->setFecha($fecha);
    echo "Construyendo: " . $this->nombre . ". Fecha: " . $this->fecha .".<br>";
  }

  function __destruct() {
    echo "Destruyendo: " . $this->nombre . ". Fecha: " . $this->fecha .".<br>";
  }

  public function mostrarDetalles() {
    echo "Película: " . $this->nombre . " ($this->fecha)</br>";
  }
  
  public function getNombre() {
    return $this->nombre;
  }

  public function getFecha() {
    return $this->fecha;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setFecha($fecha) {
    if ($this->validarFecha($fecha))
      $this->fecha = $fecha;
  }

  private function validarFecha($fecha) {
    if ($fecha >= 1900 and $fecha < 2027) {
      return true;
    }
    return false;
  }
}

$shrek = new PeliculaAnimada4("Shrek", 2001);
$shrek->mostrarDetalles();

$shrek->setNombre("Shrek 2");
$shrek->setFecha(2004);
$shrek->mostrarDetalles();
echo "La fecha es: " . $shrek->getFecha() . " </br>";

//////////////////////////////////////////////////////////////////////////////
// Propiedades y métodos estáticos
//////////////////////////////////////////////////////////////////////////////
class PeliculaAnimada5 {
  private static $totalPeliculas = 0;
  private $nombre = "";
  private $fecha = 0;

  function __construct($nombre, $fecha) {
    $this->nombre = $nombre;
    $this->setFecha($fecha);
    self::$totalPeliculas++;
    echo "Construyendo: " . $this->nombre . ". Fecha: " . $this->fecha .".<br>";
  }

  function __destruct() {
    echo "Destruyendo: " . $this->nombre . ". Fecha: " . $this->fecha .".<br>";
  }

  public function mostrarDetalles() {
    echo "Película: " . $this->nombre . " ($this->fecha)</br>";
  }
  
  public function getNombre() {
    return $this->nombre;
  }

  public function getFecha() {
    return $this->fecha;
  }
  
  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setFecha($fecha) {
    if ($this->validarFecha($fecha))
      $this->fecha = $fecha;
  }

  private function validarFecha($fecha) {
    if ($fecha >= 1900 and $fecha < 2027) {
      return true;
    }
    return false;
  }

  public static function numeroTotalPeliculas() {
    echo self::$totalPeliculas . "</br>";
  }
}

$shrek = new PeliculaAnimada5("Shrek", 2001);
$shrek->mostrarDetalles();

$shrek->setNombre("Shrek 2");
$shrek->setFecha(2004);
$shrek->mostrarDetalles();
echo "La fecha es: " . $shrek->getFecha() . " </br>";

PeliculaAnimada5::numeroTotalPeliculas();
$shrek::numeroTotalPeliculas();

$toyStory = new PeliculaAnimada5("Toy Story", 1995);
PeliculaAnimada5::numeroTotalPeliculas();
?>

</body>
</html>