<?php

namespace App\Controllers;

use App\Models\CategoriaModel;

use CodeIgniter\API\ResponseTrait;

class CategoriaController extends BaseController
{
    use ResponseTrait;
    private CategoriaModel $modelo;

    public function __construct(){
        $this->modelo = model(CategoriaModel::class);
    }

    

    public function mostrarDatos(){
        return $this->respond($this->modelo->listar());
    }

    public function buscar(int $id){
        return $this->modelo->buscar($id);
    }

    private function cuerpo(): array{
        $json = $this->request->getJSON(true);
        if (is_array($json)) {
            return $json;
        }
    }

    public function crear(){
        $id = $this->modelo->crearRegistro($this->cuerpo());
        return $id;
    }

    public function actualizar(int $id){
        return $this->modelo->actualizar($id, $this->cuerpo());
    }

    public function eliminar(int $id){
        $this->modelo->eliminar($id);
    }

}
