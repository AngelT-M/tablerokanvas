<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <main class="container">
        <h1>Tareas</h1>
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
                    <th >Título</th>
                    <th >Descripción</th>
                    <th >Categoría</th>
                    <th >Prioridad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $tarea): ?>
                <tr>
                    <td><?= esc($tarea['tarea_id']) ?></td>
                    <td><?= esc($tarea['titulo']) ?></td>
                    <td><?= esc($tarea['descripcion'] ?? '') ?></td>
                    <td><?= esc($tarea['nom_categoria']) ?></td>
                    <td><?= esc($tarea['prioridad']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
