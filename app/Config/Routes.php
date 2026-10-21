<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->group('api',['filter'=>'cors'], static function(RouteCollection $routes) : void{

    $routes->options('(:any)', static function(){});
        
    $routes->get('categoria', 'CategoriaController::mostrarDatos');
    $routes->post('crearCategoria', 'CategoriaController::crear');
    $routes->put('actualizarCategoria/(:num)', 'CategoriaController::actualizar/$1');
    $routes->delete('eliminarCategoria/(:num)', 'CategoriaController::eliminar/$1');


    $routes->get('tareas', 'TareaController::mostrarDatos');
    $routes->post('crearTarea', 'TareaController::crear');
    $routes->get('buscarTarea/(:num)', 'TareaController::buscar/$1');
    $routes->put('actualizarTarea/(:num)', 'TareaController::actualizar/$1');
    $routes->delete('eliminarTarea/(:num)', 'TareaController::eliminar/$1');


    $routes->get('tablero', 'TableroKanvanController::mostrarDatos');
    $routes->post('crearTablero', 'TableroKanvanController::crear');
    $routes->get('buscartablero/(:num)', 'TableroKanvanController::buscar/$1');
    $routes->put('actualizarTablero/(:num)', 'TableroKanvanController::actualizar/$1');
    $routes->delete('eliminarTablero/(:num)', 'TableroKanvanController::eliminar/$1');

    $routes->get('estados', 'EstadotareaController::mostrarDatos');
    $routes->post('crearEstado','EstadotareaController::crear');
    $routes->get('buscarEstado/(:num)','EstadotareaController::buscar/$1');
    $routes->put('actualizarEstado/(:num)','EstadotareaController::actualizar/$1');
    $routes->delete('eliminarEstado/(:num)','EstadotareaController::eliminar/$1');
    

});
