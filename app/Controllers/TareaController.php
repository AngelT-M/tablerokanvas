<?php

namespace App\Controllers;

use App\Models\TareaModel;

class TareaController extends BaseController
{
    public function mostrarDatos(){
        $modelo = new TareaModel();
        $datos = $modelo->listar();
    }
}
