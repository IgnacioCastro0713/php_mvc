<?php
if ($count != 0) {
    $rows = $res->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row->nombre; ?></td>
            <td><?php echo $row->genero; ?></td>
            <td><?php echo $row->lanzamiento; ?></td>
            <td class="td-actions text-center">
                <button type="button" rel="tooltip" class="btn btn-primary btn-simple btn-icon btn-sm">
                    <i class="tim-icons icon-heart-2" onclick="confirmDeleteFavorite(<?php echo $row->id; ?>, '<?php echo $row->nombre; ?>',controller, event);"></i>
                </button>
                <button type="button" rel="tooltip" class="btn btn-info btn-simple btn-icon btn-sm"
                        onclick="detailFavorite(<?php echo $row->id; ?>)"
                        data-toggle="modal" data-target="#exampleModalLong">
                    <i class="tim-icons icon-minimal-right"></i>
                </button>
            </td>
        </tr>
        
        <?php
    }
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";
?>

