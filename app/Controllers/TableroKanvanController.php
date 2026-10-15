<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TableroKanvanModel;

class TableroKanvanController extends BaseController
{
    public function mostrarDatos()
    {
        $datos = new TableroKanvanModel();
            

        return view('tablero', ['datos' => $datos->findAll()]);
    }
}
