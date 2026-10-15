<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero Kanban</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <main class="container">
        <h1>Tablero Kanban</h1>
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
                    <th >Tarea</th>
                    <th >Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $fila): ?>
                <tr>
                    <td><?= esc($fila['tablero_kanvan_id']) ?></td>
                    <td><?= esc($fila['estado_tarea_id']) ?></td>
                    <td><?= esc($fila['tarea_id']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>