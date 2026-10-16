<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoriaModel;

class CategoriaController extends BaseController
{
    public function mostrarDatos()
    {
        $model = new CategoriaModel;
        return view('categoria', ['datos' => $model->findAll()]);
    }

    public function listar()
    {
        
    }
}
