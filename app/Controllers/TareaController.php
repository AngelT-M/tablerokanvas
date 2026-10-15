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
    public function eliminar(int $id){
        $this->modelo->eliminarTarea($id);
    }

    public function buscar(int $id){
        $datos = $this->modelo->buscarTarea($id);
        
    }

    private function cuerpo(): array{
        $json = $this->request->getJSON(true);
        if(is_array($json) ){
         return $json;   
        }
    }

    public function crear(){
        $id = $this->modelo->crearTarea($this->cuerpo());
        return $id;
    }


    public function actualizar(int $id){
        
        return $this->modelo->actualizarTarea($id, $this->cuerpo());
       // $this->model->actualizarTarea(int $id, $datos)
    }

}
