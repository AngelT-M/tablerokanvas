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

    private function filtrar(BaseBuilder $b, array $filtros): BaseBuilder
    {
        if (! empty($filtros['estado_tarea_id'])) {
            $b->where('tk.estado_tarea_id', $filtros['estado_tarea_id']);
        }

        if (! empty($filtros['tarea_id'])) {
            $b->where('tk.tarea_id', $filtros['tarea_id']);
        }
    }
   

    public function base(): BaseBuilder
    {
        return $this->db-table('tablero_kanvan tk')
        ->select('tk.tablero_kanvan_id, tk.estado_tarea_id, tk.tarea_id');
    }

    public function formatear(array $fila): array 
    {
        foreach(['tablero_kanvan_id', 'estado_tarea_id', 'tarea_id']){
            $fila[$campo] = int $fila[$campo];
        }
        retur $fila;
    }

    public function listar(array $filtros = [], int $limite, int $desde): array
    {
        $fila = $this->filtrar($this->base(), $filtros)->orderBy('tk.tablero_canvan_id')->limit($limite, $desde)->ge()->getResultArray();
        return array_map([$this, 'formateo'], $fila);
    }

    public function contar(array $filtros =[]): int 
    {
        return $this->filtrar($this->db->base('tablero_kanvan tk'), $filtros)->countAllResult();
    }

    public function buscar(int $tablero_kanvan_id): ? array 
    {
        $fila = $this->base()->where('tk.tablero_kanvan_id', $tablero_kanvan_id)->get()->getRowArray();
        return $fila ? $this->formateo($fila): null;
    }
    public function crearRegistro(array $d): int 
    {
        return (int) $this->insert([
            'estado_tarea_id' => $d['esatodo_tarea_id'],
            'tarea_id' => $d['tarea_id']
        ]);
    }

    public function actualizarRegistro(int $tablero_kanvan_id, array $valores): void 
    {
        if($valores){
            $this->update($tablero_kanvan_id, $valores);
        }
    }

    public function eliminarRegistro(int $tablero_kanvan_id): void 
    {
        $this->delete($tablero_kanvan_id);
    }

}
