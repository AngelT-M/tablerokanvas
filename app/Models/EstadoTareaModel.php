<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoTareaModel extends Model
{
    protected $table         = 'estados_tarea';
    protected $primaryKey    = 'estado_tarea_id';
    protected $allowedFields = ['nom_estado'];


    private function filtrar(BaseBuilder $b, array $filtros): BaseBuilder
    {
        if (! empty($filtros['buscar'])) {
            $b->groupStart()
              ->like('et.nom_estado', $filtros['buscar'])
              ->groupEnd();
        }
        foreach (['nom_estado'] as $campo) {
            if (! empty($filtros[$campo])) {
                $b->where("et.$campo", $filtros[$campo]);
            }
        }
        return $b;
    }

    private function base(): BaseBuilder
    {
        return $this->db->table('estados_tarea et')
            ->select('et.estado_tarea_id, et.nom_estado');
    }

    private function formatear(array $fila): array 
    {
        if (isset($fila['estado_tarea_id'])) {
            $fila['estado_tarea_id'] = (int) $fila['estado_tarea_id'];
        }
        return $fila;
    }

    public function listar(array $filtros = [], int $limite = 0, int $desde = 0): array
    {
        $fila = $this->filtrar($this->base(), $filtros)->orderBy('et.estado_tarea_id')->limit($limite, $desde)->get()->getResultArray();
        return array_map([$this, 'formatear'], $fila);
    }

    public function contar(array $filtros = []): int 
    {
        return $this->filtrar($this->db->table('estados_tarea et'), $filtros)->countAllResults();
    }

    public function buscar(int $estado_tarea_id): ?array 
    {
        $fila = $this->base()->where('et.estado_tarea_id', $estado_tarea_id)->get()->getRowArray();
        return $fila ? $this->formatear($fila) : null;
    }

    public function crearRegistro(array $d): int 
    {
        return (int) $this->insert([
            'estado_tarea_id'=> $d['estado_tarea_id'],
            'nom_estado' => $d['nom_estado']
        ]);
    }

    public function actualizarRegistro(int $estado_tarea_id, array $valores): void
    {
        if ($valores) {
            $this->update($estado_tarea_id, $valores);
        }
    }

    public function eliminarRegistro(int $estado_tarea_id): void 
    {
        $this->delete($estado_tarea_id);    
    }

}
