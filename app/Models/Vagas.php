<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vagas extends Model
{
    use HasFactory;

    protected $primaryKey = 'vagas_id';

    protected $fillable = [
        'companie_id',
        'nome_vaga',
        'desc_vaga',
        'salario_vaga',
        'area_vaga',
        'tipo_vaga',
    ];

    public function company()
    {
        return $this->belongsTo(
            Companies::class,
            'companie_id',     
            'companie_id'      
        );
    }
}
