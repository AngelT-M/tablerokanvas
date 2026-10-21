<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoTareaModel extends Model
{
    protected $table         = 'estados_tarea';
    protected $primaryKey    = 'estado_tarea_id';
    protected $allowedFields = ['nom_estado'];


    private function formatear(array $fila): array 
    {
        foreach ( ['estado_tarea_id'] as $campo) {
            if (isset($fila[$campo])) {
                $fila[$campo] = (int) $fila[$campo];
            }
        }
        return $fila;
    }

    public function listar(): array
    {
        $datos = $this->select('estado_tarea_id , nom_estado')
                      ->findAll();
        return array_map([$this, 'formatear'], $datos);
    }

    public function buscar(int $estado_tarea_id): ?array 
    {
        $fila = $this->find($estado_tarea_id);
        return $fila ? $this->formatear($fila) : null;
    }


    public function crear(array $datos): int 
    {
        $id = $this->insert([
            'nom_estado' => $datos['nom_estado']
        ]);
        return $id === false ? null: (int) $id;
    }

    public function actualizar(int $estado_tarea_id, array $datos): bool
    {
        $valores = array_intersect_key($datos, array_flip($this->allowedFields));
        if (! $valores) {
            return true;
        }
        return $this->update($estado_tarea_id, $valores);
    }

    public function eliminar(int $estado_tarea_id): void 
    {
        $this->delete($estado_tarea_id);    
    }

}
