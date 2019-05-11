<h1>GESTIONAR CATEGORIAS</h1>

<a href="<?=base_url?>categoria/crear" class="button button-small">
    Crear Categoria
</a>


<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php while($cat = $categorias->fetch_object()):?>
    <tr>
        <td>
            <?= $cat->id;?>
        </td>
        <td>
            <?= $cat->nombre;?>
        </td>
        <td id="actions">
            <a href="<?=base_url?>categoria/editar&id=<?=$cat->id?>" class="button button-gestion button-action">Editar</a>
            <a href="<?=base_url?>categoria/eliminar&id=<?=$cat->id?>" class="button button-gestion button-red button-action">Eliminar</a>
        </td>
    </tr>

    <?php endwhile; ?>
</table>