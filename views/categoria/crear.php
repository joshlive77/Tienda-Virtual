<?php if(isset($edit) && isset($cat) && is_object($cat)): ?>
<h1>Editar categoria <?=$cat->nombre?></h1>
    <?php
        $url_action = base_url."categoria/save&id=".$cat->id;
    ?>
<?php else: ?>
<h1>Crear nuevos categoria</h1>
    <?php
        $url_action = base_url.'categoria/save';
    ?>
<?php endif; ?>

<form action="<?=$url_action?>" method="POST">
    <label for="nombre">nombre</label>
    <input type="text" name="nombre" value="<?= isset($cat) && is_object($cat) ? $cat->nombre : ''; ?>" required>
    <input type="submit" value="guardar">
</form>