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
    ];

    private function filtrar(BaseBuilder $b , array $filtros): BaseBuilder
    {
        if(! empty ($filtros['buscar'])){
            $b->groupStart()
            ->like('t.titulo' $filtros['buscar'])
            ->groupEnd();
        }   

        foreach(['prioridad', 'categoria_id'] as $campo){
            if(! empty($filtros[$campo])){
                $b->where('t.$campo' , $filtros[$campo]);
            }
        }
        return $b;

    }


    private function base(): BaseBuilder
    {
        return $this ->db->table('tareas t')
        ->select('t.tarea_id, t.titulo , t.descripcion, t.categoria_id, c.nom_categoria, t.prioridad')
        ->join('categoria c', 'c.categoria_id = t.categoria_id');
    }

    private function formatear(array $fila): array
    {
        foreach (['tablero_kanvan_id', 'estado_tarea_id', 'tarea_id'] as $campo) {
            if (isset($fila[$campo])) {
                $fila[$campo] = (int) $fila[$campo];
            }
        }
        return $fila;
    }

    public function listar(array $filtros = [], int $limite, int $desde): array
    {
        $fila = $this->filtrar($this->base(), $filtros)->orderBy('t.id_atarea')->limite($limite, $desde )->get()->getResultArray();
        return array_map([$this, 'formatear'], $fila);
    }

    public function listar(): array
    {
        $fila = $this->datos
            $datos = $this 
            ->select('tareas.tarea_id, tareas.titulo, tareas.descripcion, categorias.nom_categoria, tareas.prioridad')
            ->join('categorias', 'categorias.categoria_id = tareas.categoria_id')
            ->findAll();
            return array_map([$this, 'formatear'], $datos);
    }
    

    public function contar(array $filtros = []): int
    {
        return $this->filtrar($this->db->base('tarea t'), $filtros)->countAllResult();
    }

    public function buscar(int $tarea_id): ? array 
    {
        $fila = $this-base()->where('t.tarea_id', $tarea_id)->get()->getRowArray();
        return $fila ? $this->formateo($fila) : null;
    }

    public function crearTarea(array $d): int
    {
        return (int) $this->insert([
            'titulo' => $d['titulo'],
            'descripcion' => $d['descripcion'] ?? null;
            'cateogoria_id' => $d['categoria_id'],
            'prioridad' => $d['prioridad'] ?? 'Alta'
        ]);
    }

    public function actualizarTarea(int $tarea_id, array $valores): void
    {
        if($valores){
            $this->update($tarea_id, $valores);
        }
    }

    public function eliminarDeProyecto(int $tarea_id): void
    {
        $this->delete($tarea_id);
    }

}
