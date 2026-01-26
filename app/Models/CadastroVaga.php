<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CadastroVaga extends Model
{

    use HasFactory;

    protected $table = 'cadastro_vaga';
    protected $primaryKey = 'cadastro_vaga_id';

    protected $fillable = [
        'companie_id',
        'user_id',
        'vagas_id',
    ];

    public function company()
    {
        return $this->belongsTo(
            Companies::class,
            'companie_id',
            'companie_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }

    public function vagas()
    {
        return $this->belongsTo(
            Vagas::class,
            'vagas_id',
            'vagas_id'
        );
    }
}
