<?php

namespace App\Controllers;

use App\Models\TareaModel;

use CodeIgniter\API\ResponseTrait;

class TareaController extends BaseController

{
    use ResponseTrait;
    private TareaModel $modelo;

    public function __construct(){
        $this->modelo = model(TareaModel::class);
    }

    public function mostrarDatos(){
        return $this->respond($this->modelo->listar());
    }

    public function buscar(int $id){
        $datos = $this->modelo->buscar($id);
        if ($datos === null){
            return $this->failNotFound("no se encontro la tarea con el id {$id}");
        }
        return $this->respond($datos);
    }

    private function cuerpo(): array{
        $json = $this->request->getJSON(true);
        if(is_array($json) ){
         return $json;   
        }
    }

    public function crear(){
        $id = $this->modelo->crear($this->cuerpo());
        return $id;
    }

    public function actualizar(int $id){
        
        return $this->modelo->actualizar($id, $this->cuerpo());
    }

    public function eliminar(int $id){
        $this->modelo->eliminar($id);
    }

}
