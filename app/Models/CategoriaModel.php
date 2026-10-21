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
    public function formatear(array $fila): array
    {
        foreach(['categoria_id'] as $campo){
            if (isset($fila[$campo])) {
                $fila[$campo] = (int) $fila[$campo];
            }
        }
        return $fila;
    }

    public function listar(): array
    {
        $datos = $this->select('categoria_id, nom_categoria')
                    ->findAll();
        return array_map([$this, 'formatear'], $datos);
    }

    public function buscar(int $categoria_id): ? array 
    {
        $fila = $this->find($categoria_id);
        return $fila ? $this->formatear($fila): null;
    }
    
    public function crear(array $datos): ?int
    {
        $id = $this->insert([
            'nom_categoria' => $datos['nom_categoria']
        ]);
        return $id === false ? null : (int) $id;
    }

    public function actualizar(int $categoria_id, array $datos): bool 
    {
        $valores = array_intersect_key($datos, array_flip($this->allowedFields));
        if(! $valores){
            return true;
        }
        return $this->update($categoria_id, $valores);
    }

    public function eliminar(int $categoria_id): void
    {
        $this->delete($categoria_id);    
    }
 
    
    


   
}
