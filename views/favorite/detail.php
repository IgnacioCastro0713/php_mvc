<?php

use Favorite\Favorite;
$message = '';
$row = $detail->fetchAll(PDO::FETCH_OBJ)[0] ?? 0;

if (isset($row->id_estudio)) {
    $developer = Favorite::getDeveloper($row->id_estudio);
} else {
    $message = "No existe una relación de datos no se puede mostras los detalles generales correctamete. <br><br>
                <strong class='text-warning'>verifique los resgistro relacionados.</strong>";
}

if (isset($row->id_juego)){
    $platforms = Favorite::getPlatforms($row->id_juego, true);
} else {
    $message = "No existe una relación de datos no se puede mostras los detalles generales correctamete. <br><br>
                <strong class='text-warning'>verifique los resgistro relacionados.</strong>";
}

if ($count != 0  && $developer && $platforms) {
     echo "
     <h6 align='center'>Información de videojuego</h6>
     <div class='row container' style='border-bottom: 1px solid #a8a8a8; margin: auto'>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Nombre</strong></span>
               <p>{$row->juego}</p>
          </div>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Genero</strong></span>
               <p>{$row->genero}</p>
          </div>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Plataformas</strong></span>
               <p>{$platforms}</p>
          </div>
          <div align=\"left\" class=\"col - 3\">
               <span><strong>Descripción</strong></span>
               <p style='text-align: justify'>{$row->descripcion}</p>
          </div>
     </div>
     <h6 align='center'>Información del estudio perteneciente</h6><br>
     <div class='row container' style='border-bottom: 1px solid #a8a8a8; margin: auto'>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Estudio</strong></span>
               <p>{$row->estudio}</p>
          </div>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Sede</strong></span>
               <p>{$row->sede}</p>
          </div>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Propietario</strong></span>
               <p>{$row->propietario}</p>
          </div>
          <div align=\"left\" class=\"col-3\">
               <span><strong>Año de fundacion</strong></span>
               <p>{$row->fundacion}</p>
          </div>
     </div>
     <h6 align='center'>Información de los desarrolladores</h6><br>
     <div class='row container' style='border-bottom: 1px solid #a8a8a8; margin: auto'>
          <div align=\"left\" class=\"col-8\">
               <span><strong>Desarrollador</strong></span>
               <p>{$developer['name']}</p>
          </div>
          <div align=\"left\" class=\"col-4\">
               <span><strong>Ciudad</strong></span>
               <p>{$developer['city']}</p>
          </div>
     </div>";
} else
    echo "<tr><td colspan='4'>{$message}</td></tr>";