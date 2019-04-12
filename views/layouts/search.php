<?php
/** Buscador genérico se usa en todas las vistas que son index. */
?>
<form action="">
    <br>
    <label for="search">Buscar</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-search"></i></span>
        </div>
        <input type="text" class="form-control" id="search" name="search" onkeyup="appVue.loadTable(controller)" placeholder="Buscar...">
    </div>
</form>