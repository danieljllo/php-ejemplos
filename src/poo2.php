<!DOCTYPE HTML>  
<html>
<body>  
<h1>Ejemplo Programación Orientada a Objetos (POO) en PHP</h1>
<?php

class Auto {
  private $marca = "";
  private $numeroPuertas = 4;
  private $modelo = "";
  private $matricula = "Sin Matricula";
  private static $totalNumeroPuertas = 0;

  public function __construct($mar, $mod, $numPue) {
    $this->setMarca($mar);
    $this->setModelo($mod);
    $this->setNumeroPuertas($numPue);
    self::$totalNumeroPuertas += $numPue;
  }

  public function __destruct() {
    self::$totalNumeroPuertas -= $this->numeroPuertas;
  }

  public function getTotalNumeroDePuertas() {
    return self::$totalNumeroPuertas;
  }
  
  public static function getTotalNumeroDePuertasEstatica() {
    return self::$totalNumeroPuertas;
  }
  public function getMarca() {
    return $this->marca;
  }

  public function setMarca($marca) {
    if (!is_string($marca) || trim($marca) === "") {
      throw new InvalidArgumentException("La marca no puede estar vacia.");
    }

    $this->marca = trim($marca);
    return $this;
  }

  public function getNumeroPuertas() {
    return $this->numeroPuertas;
  }

  public function setNumeroPuertas($numeroPuertas) {
    if (!is_int($numeroPuertas) || $numeroPuertas < 0) {
      throw new InvalidArgumentException("El numero de puertas debe ser un entero positivo.");
    }

    $this->numeroPuertas = $numeroPuertas;
    return $this;
  }

  public function getModelo() {
    return $this->modelo;
  }

  public function setModelo($modelo) {
    if (!is_string($modelo) || trim($modelo) === "") {
      throw new InvalidArgumentException("El modelo no puede estar vacio.");
    }

    $this->modelo = trim($modelo);
    return $this;
  }

  public function getMatricula() {
    return $this->matricula;
  }

  public function setMatricula($matricula) {
    if (!is_string($matricula) || trim($matricula) === "") {
      throw new InvalidArgumentException("La matricula no puede estar vacia.");
    }

    $this->matricula = trim($matricula);
    return $this;
  }

}

class AutoElectrico extends Auto {
  private $diasDeBateria = 0;

  public function __construct($mar, $mod, $numPue, $diasDeBateria) {
    parent::__construct($mar, $mod, $numPue);
    $this->diasDeBateria = $diasDeBateria;
  }

  public function cambiarBateria() {
    echo "Cambio bateria de: " . $this->getModelo() . "</br>";
    $this->diasDeBateria = 0;
  }
}

$byd = new AutoElectrico("BYD", "Chuqui", 6, 365);
echo $byd->getMarca() . "</br>";
$byd->cambiarBateria();

$sentra = new Auto("Nissan", "Sentra", 4);
echo $sentra->getMarca() . "</br>";
echo $sentra->getModelo() . "</br>";
echo $sentra->getNumeroPuertas() . "</br>";
echo $sentra->getMatricula() . "</br>";
echo $sentra->getTotalNumeroDePuertas() . "</br>";

$golf = new Auto("Volkswagen", "Golf", 2);
$golf->setMatricula("MVD 1235");
echo $golf->getMarca() . "</br>";
echo $golf->getMatricula() . "</br>";
echo $golf->getTotalNumeroDePuertas() . "</br>";
echo $golf::getTotalNumeroDePuertasEstatica() . "</br>";

unset($sentra);

//echo $sentra->getTotalNumeroDePuertas() . "</br>";
unset($golf);
echo Auto::getTotalNumeroDePuertasEstatica() . "</br>";



?>

</body>
</html>