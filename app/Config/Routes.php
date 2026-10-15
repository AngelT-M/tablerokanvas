<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('categoria', 'CategoriaController::mostrarDatos');
$routes->get('estados', 'EstadoTareaController::mostrarDatos');
$routes->get('tareas', 'TareaController::mostrarDatos');
$routes->get('tablero', 'TableroKanvanController::mostrarDatos');