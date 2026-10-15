<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <main class="container">
        <h1>Categorías</h1>
        <nav class="">
            <a href="<?= site_url('categoria') ?>">Categorías</a>
            <a href="<?= site_url('estados') ?>">Estados</a>
            <a href="<?= site_url('tareas') ?>">Tareas</a>
            <a href="<?= site_url('tablero') ?>">Tablero</a>
        </nav>
        <a href="" class="btn">agregar</a>
        <table class="table">
            <thead>
                <tr>
                    <th >ID</th>
                    <th >Nombre</th>
                    <th>acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($datos as $categoria):?>
                <tr>
                    <td><?= esc($categoria['categoria_id'])?></td>
                    <td><?= esc($categoria['nom_categoria'])?></td>
                    <td>
                        <button>modificar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

</body>
</html>