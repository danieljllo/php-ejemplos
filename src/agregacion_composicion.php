<?php
namespace agregacion_composicion;
?>
<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo Programación Orientada a Objetos (POO) en PHP</h1>
<h2>Agregación y Composición</h2>
<?php

//////////////////////////////////////////////////////////////////////////////
// Agregacion unidireccional
//////////////////////////////////////////////////////////////////////////////
class Auto {
  private $marca = "";
  private Motor $motor;

  public function __construct(string $marca) {
    $this->marca = $marca;
    echo "Creo Auto marca: " . $this->marca . "</br>";
  }
  
  public function setMotor(Motor $motor) { 
    $this->motor = $motor;
    echo "Agrego motor</br>";
  }
}

class Motor {
  private $cilindraje = 0;
  
  public function __construct(int $cilindraje) {
    $this->cilindraje = $cilindraje;
    echo "Creo Motor de cillindraje: " . $this->cilindraje . "</br>";
  }
}

$m = new Motor(2000);
$toyota = new Auto("Toyota");
$toyota->setMotor($m);

echo "<hr/>";

//////////////////////////////////////////////////////////////////////////////
// Agregacion bidireccional
//////////////////////////////////////////////////////////////////////////////
class Estudiante {
  public string $nombre = "";
  private Tecnicatura $tecnicatura;
  
  public function __construct(string $nombre) {
    $this->nombre = $nombre;
    echo "Creo Estudiante: " . $this->nombre . "</br>";
  }
  
  public function setTecnicatura(Tecnicatura $tecnicatura) {
    $this->tecnicatura = $tecnicatura;
    $this->tecnicatura->registrar($this);
    echo "Asigno Tecnicatura: " . $this->tecnicatura->nombre . "</br>";
  }
  
  public function getTecnicatura() {
    echo "Tecnicatura: " . $this->tecnicatura->nombre . "</br>";
  }
}

class Tecnicatura {
  public string $nombre = "";
  private $estudiantes = array();

  public function __construct(string $nombre) {
    $this->nombre = $nombre;
    echo "Creo Tecnicatura: " . $this->nombre . "</br>";
  }
  
  public function registrar(Estudiante $estudiante) {
    array_push($this->estudiantes, $estudiante);
    echo "Registro Estudiante: " . $estudiante->nombre . "</br>";
  }
  
  public function getEstudiantes() {
    echo "Estudiantes registrados: ";
    foreach ($this->estudiantes as $e) {
      echo $e->nombre . ", ";
    }
  }
}

$juan = new Estudiante("Juan");
$maria = new Estudiante("Maria");
$rys = new Tecnicatura("Redes y Software");
$juan->setTecnicatura($rys);
$maria->setTecnicatura($rys);
$juan->getTecnicatura();
$rys->getEstudiantes();

echo "<hr/>";

//////////////////////////////////////////////////////////////////////////////
// Composicion
//////////////////////////////////////////////////////////////////////////////
class Casa {
  private string $direccion = "";
  private $ambientes = array();
  
  public function __construct(string $direccion) {
    $this->direccion = $direccion;
    echo "Casa en: " . $this->direccion . "</br>";
  }

  public function agregarAmbiente($nombre) {
    array_push($this->ambientes, new Ambiente($nombre, $this));
    echo "Agrego Ambiente: " . $nombre . "</br>";
  }
  
  public function listarAmbientes() {
    echo "Ambientes: ";
    foreach ($this->ambientes as $e) {
      echo $e->nombre . ", ";
    }
  }
}

class Ambiente {
  public string $nombre = "";
  private Casa $casa; 
  
  public function __construct(string $nombre, Casa $casa) {
    $this->nombre = $nombre;
    $this->casa = $casa;
  }
}

$c1 = new Casa("Colonia 1234");
$c1->agregarAmbiente("Comedor");
$c1->agregarAmbiente("Cocina");
$c1->listarAmbientes();

echo "<hr/>";

?>

</body>
</html>