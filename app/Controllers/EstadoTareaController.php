<?php

namespace App\Controllers;

use App\Models\EstadoTareaModel;
use CodeIgniter\API\ResponseTrait;

class EstadoTareaController extends BaseController
{
    use ResponseTrait;
    private EstadoTareaModel $modelo;

    public function __construct(){
        $this->modelo = model(EstadoTareaModel::class);
    }
    
    public function mostrarDatos()
    {
        return $this->respond($this->modelo->listar());
    }

    public function eliminar(int $id){
        $this->modelo->eliminar($id);
    }

    public function buscar(int $id){
    $datos = $this->modelo->buscar($id);
    if ($datos === null) {
        return $this->failNotFound("No se encontro el estado con el ID {$id}");
    }
    return $this->respond($datos);
    }

    public function cuerpo(): array{
        $json = $this->request->getJSON(true);
        if (is_array($json)) {
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


}
