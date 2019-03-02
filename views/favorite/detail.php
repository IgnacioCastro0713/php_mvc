<?php
if ($count != 0) {
    $row = $detail->fetchAll(PDO::FETCH_OBJ)[0];
     echo $row->juego;
     echo $row->desarrollador;
     echo $row->estudio;
     echo $row->plataforma;
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";