<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class md_method_of_payment extends Model
{
    use HasFactory;
    public $incrementing    = false;
    protected $keyType      = 'string';
    protected $primaryKey   = 'id_method_of_payment';
    protected $fillable     = ['id_method_of_payment', 'name_method_of_payment'];
}
