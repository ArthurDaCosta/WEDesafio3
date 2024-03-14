<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrinho extends Model
{
    protected $fillable = [
        'idusuario',
        'items'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    protected $table = 'Carrinho';

    use HasFactory;
}
