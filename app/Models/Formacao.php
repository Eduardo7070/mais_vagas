<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{   protected $table = 'formacoes';
    use HasFactory;
    protected $fillable = [
        
        'curriculo_id',
        'curso',
        'instituicao',
        'periodo',
    ];

    public function curriculo()
    {
        return $this->belongsTo(Curriculo::class);
    }
}
