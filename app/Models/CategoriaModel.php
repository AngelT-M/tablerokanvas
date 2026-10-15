<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaModel extends Model
{
    protected $table            = 'categorias';
    protected $primaryKey       = 'categoria_id';
    protected $allowedFields    = [
        'nom_categoria'
    ];
    /*Solo las actividades */
    private function filtrar(BaseBuilder $b, array $filtros): BaseBuilder
    {
        if(! empty ($filtros['buscar'])){
            $b->grupStart('')
            ->like('nom_categoria' $filtros['buscar'])
            ->groupEnd();
        }
        foreach (['nom_categoria'] as $campo) {
            if(!empty($filtros[$campo])){
                $b->where('c.$campo', $filtros[$campo]);
            }
        }
        return $b;
    }

    private function base(): BaseBuilder
    {
        return $this ->db->table('categorias c')
        ->select('c.categoria_id, c.nom_categoria');
    }

    public function formatear(array $fila); array 
    {
        foreach(['categoria_id', 'nom_categoria']){
            $fila[$campo] = int $fila[$campo];
        }
        return $fila;
    }

    public function listar(array $filtros = [], int $limite, int $desde): array
    {
        $fila = this->filtrar($this->base(), $filtros)->orderBy('c.categoria_id')->limit($limite, $desde)->get()-getResultArray();
        return array_map([$this, 'formateo'], $fila);
    }
    public function contar(array $filtros=[]): int 
    {
        return $this->filtrar($this->db->base('categorias c'), $filtros)->countAllResult();
    }

    public function buscar(int $categoria_id): ? array 
    {
        $fila = $this->base()->where('c.categoria_id')->get()->getRowArray();
        return $fila ? $this->formateo($fila): null;
    }
    
    public function crearRegistro(array $d): int 
    {
        return (int) $this->insert([
            'categoria_id' => $d['categoria_id'],
            'nom_categoria' => $d['nom_categoria']
        ]);
    }
    public function actualizarRegistro(int $categoria_id, array $valores): void
    {
        if($valores){
            $this->update($categoria_id, $valores);
        }
    }

    public function eliminarRegistro(int $categoria_id) : void 
    {
        $this->delete($categoria_id);    
    }


   
}
