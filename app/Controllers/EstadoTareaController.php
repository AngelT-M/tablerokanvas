<?php

namespace App\Controllers;

use App\Models\EstadoTareaModel;

class EstadoTareaController extends BaseController
{
    public function mostrarDatos()
    {
        $model = new EstadoTareaModel();

        return view('estados_tarea', ['datos' => $model->findAll()]);
    }
}
