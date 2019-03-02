<?php

use Favorite\Favorite;

$row = $detail->fetchAll(PDO::FETCH_OBJ)[0];
$developer = Favorite::getDeveloper($row->id_estudio);

if ($count != 0) {
     echo $row->juego;
     echo $row->estudio;
     echo $row->descripcion;
     echo Favorite::getPlatforms($row->id_juego, true);
     echo $developer['city'];
     echo $developer['name'];
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";