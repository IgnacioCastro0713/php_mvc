<?php
if ($count != 0) {
    $rows = $res->fetchAll(PDO::FETCH_OBJ);
    foreach ($rows as $row) { ?>
        <tr>
            <td class="text-center"><?php echo $row->id; ?></td>
            <td><?php echo $row->nombreCompleto; ?></td>
            <td><?php echo $row->ciudad; ?></td>
            <td><?php echo $row->nombre; ?></td>
            <td class="td-actions text-center">
                <!--button type="button" rel="tooltip" class="btn btn-info btn-simple btn-icon btn-sm">
                    <i class="tim-icons icon-single-02"></i>
                </button-->
                <a href="edit?id=<?php echo $row->id; ?>" rel="tooltip"
                   class="btn btn-success btn-simple btn-icon btn-sm" title="Editar">
                    <i class="tim-icons icon-settings-gear-63"></i>
                </a>
                <button onclick="appVue.confirmDelete('<?php echo $row->nombreCompleto?>', '<?php echo $row->id; ?>', controller);"
                        class="btn btn-danger btn-simple btn-icon btn-sm" title="Eliminar">
                    <i class="tim-icons icon-simple-remove"></i>
                </button>
            </td>
        </tr>
        <?php
    }
} else
    echo "<tr><td colspan='4'>No se obtuvieron resultados.</td></tr>";
?>