<?php

namespace App\Models;

use CodeIgniter\Model;

class TableroKanvanModel extends Model
{
    protected $table         = 'tablero_kanvan';
    protected $primaryKey    = 'tablero_kanvan_id';
    protected $allowedFields = [
        'estado_tarea_id',
        'tarea_id'
    ];

    
    public function formatear(array $fila): array 
    {
        foreach(['tablero_Kanvan_id', 'estado_tarea_id', 'tarea_id'] as $campo){
            if (isset($fila[$campo])) {
                 $fila[$campo] = (int) $fila[$campo];     
            }
        }
        return $fila;
    }

    public function listar(): array
    {
        $datos = $this->select('tablero_kanvan.tablero_Kanvan_id, estados_tarea.estado_tarea_id, tareas.tarea_id')
                      ->join('tareas', 'tareas.tarea_id = tablero_kanvan.tarea_id')
                      ->join('estados_tarea', 'estados_tarea.estado_tarea_id = tablero_kanvan.estado_tarea_id')
                      ->findAll();
        return array_map([$this, 'formatear'], $datos);
    }

    public function buscar(int $tablero_kanvan_id): ? array 
    {
        $fila = $this->find($tablero_kanvan_id);
        return $fila ? $this->formatear($fila): null;
    }

    public function crear(array $datos): int 
    {
        $id = $this->insert([
            'estado_tarea_id' => $datos['estado_tarea_id'],
            'tarea_id' => $datos['tarea_id']
        ]);
        return $id === false ? null: (int) $id;
    }

    public function actualizar(int $tablero_kanvan_id, array $datos): bool 
    {
        $valores = array_intersect_key($datos, array_flip($this->allowedFields));
        if(!$valores){
            return true;
        }
        return $this->update($tablero_kanvan_id, $valores);
    }

    public function eliminar(int $tablero_kanvan_id): void 
    {
        $this->delete($tablero_kanvan_id);
    }



   
}
