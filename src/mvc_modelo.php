<?php
namespace modelo;

class Datos {
  private string $nombre = "Maria Perez";
  private int $edad = 20;

  public function getNombre() {
    return $this->nombre;
  }

  public function getEdad() {
    return $this->edad;
  }
}
?>
