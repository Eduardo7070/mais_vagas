<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vagas extends Model
{
    use HasFactory;

    protected $fillable = [
        'vagas_id',
        'companie_id',
        'nome_vaga',
        'desc_vaga',
        'salario_vaga',
        'area_vaga',
        'tipo_vaga',
    ];

    public function companies()
    {
        return $this->belongsTo(Companies::class);
    }
}
