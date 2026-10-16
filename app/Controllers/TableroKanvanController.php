<?php

namespace App\Controllers;

use App\Models\TableroKanvanModel;
use CodeIgniter\API\ResponseTrait;

class TableroKanvanController extends BaseController
{
    use ResponseTrait;
    private TableroKanvanModel $modelo;

    public function __construct(){
        $this->modelo = model(TableroKanvanModel::class);
    }

    public function mostrarDatos()
    {
        return $this->respond($this->modelo->listar());
    }
}
