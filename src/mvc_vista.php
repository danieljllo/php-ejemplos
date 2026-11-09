<?php
namespace vista;

class VistaTabla {
  public function mostrarDatos(string $nombre, int $edad) {
    $htmlFormato = "
      <style>
        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
        }
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        tr:nth-child(even) {
          background-color: #dddddd;
        }
      </style>";

    $htmlTabla = "
      <table>
        <tr>
          <th>Nombre</th>
          <th>Edad</th>
        </tr>
        <tr>
          <td>$nombre</td>
          <td>$edad</td>
        </tr>
      </table>";
    echo $htmlFormato . $htmlTabla;
  }
}

class VistaLista {
  public function mostrarDatos(string $nombre, int $edad) {

    $htmlLista = "
      <ul>
        <li><b>Nombre:</b> $nombre</li>
        <li><b>Edad:</b> $edad</li>
      </ul>";
    echo $htmlLista;
  }
}
?>
