<?php

namespace App\Models;

use CodeIgniter\Model;

class TareaModel extends Model
{
    public const PRIORIDADES = ['Baja', 'Media', 'Alta'];
    
    protected $table         = 'tareas';
    protected $primaryKey    = 'tarea_id';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'titulo',
        'descripcion',
        'categoria_id',
        'prioridad',
        'estado',
        'usuario'
    ];

    private function formatear(array $fila): array
    {
        foreach (['tablero_kanvan_id', 'estado_tarea_id', 'tarea_id'] as $campo) {
            if (isset($fila[$campo])) {
                $fila[$campo] = (int) $fila[$campo];
            }
        }
        return $fila;
    }

    public function listar(): array
    {
        $datos = $this->select('tareas.tarea_id, tareas.titulo, tareas.descripcion, categorias.nom_categoria, tareas.prioridad, tareas.estado, tareas.usuario')
                      ->join('categorias', 'categorias.categoria_id = tareas.categoria_id')
                      ->findAll();
        return array_map([$this, 'formatear'], $datos);
    }

    
    public function buscar(int $tarea_id): ?array 
    {
        $fila = $this->find($tarea_id);
        return $fila ? $this->formatear($fila) : null;
    }


    public function crear(array $datos) : int
    {
        $id = $this->insert([
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'categoria_id' => $datos['categoria_id'],
            'prioridad' => $datos['prioridad'],
            'estado' =>$datos['estado'],
            'usuario' =>$datos['usuario']
        ]);
        return $id === false  ? null: (int) $id;
    }

    public function actualizar(int $tarea_id, array $datos): bool
    {
        $valores = array_intersect_key($datos, array_flip($this->allowedFields));
        if (! $valores) {
            return true;
        }
        return $this->update($tarea_id, $valores);
    }


    public function eliminar(int $tarea_id): void
    {
        $this->delete($tarea_id);
    }
}
