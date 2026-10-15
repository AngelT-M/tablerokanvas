<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('categoria', 'CategoriaController::mostrarDatos');
$routes->get('estados', 'EstadoTareaController::mostrarDatos');

$routes->get('tareas', 'TareaController::mostrarDatos');
$routes->post('crearTarea', 'TareaController::crear');
$routes->get('buscarTarea/(:num)', 'TareaController::buscar/$1');
$routes->put('actualizarTarea/(:num)', 'TareaController::actualizar/$1');
$routes->delete('eliminarTarea/(:num)', 'TareaController::eliminar/$1');


$routes->get('tablero', 'TableroKanvanController::mostrarDatos');