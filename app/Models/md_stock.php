<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class md_stock extends Model
{
    use HasFactory;
    public $incrementing    = false;
    protected $keyType      = 'string';
    protected $primaryKey   = 'id_product';
    protected $fillable     = ['id_product', 'harga', 'stok'];
}
