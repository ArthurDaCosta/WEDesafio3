<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrinhoItem extends Model
{
    protected $fillable = [
        'idproduto',
        'quantidade'
    ];

    use HasFactory;
}
