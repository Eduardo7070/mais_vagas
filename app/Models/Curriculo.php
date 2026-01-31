<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cargo_desejado',
        'resumo_profissional',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class);
    }

    public function formacoes()
    {
        return $this->hasMany(Formacao::class);
    }
}
