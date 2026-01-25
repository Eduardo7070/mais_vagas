<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Companies extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $primaryKey = 'companie_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'name_companie',
        'email',
        'password',
    ];
}