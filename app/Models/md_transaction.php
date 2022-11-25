<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\md_method_of_payment;
use App\Models\md_stock;

class md_transaction extends Model
{
    use HasFactory;
    public $incrementing    = false;
    protected $primaryKey   = null;
    protected $fillable     = ['id_transaction', 'id_product', 'id_method_of_payment', 'user_id', 'total_bought'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(md_method_of_payment::class, 'id_method_of_payment');
    }

    public function produk()
    {
        return $this->belongsTo(md_stock::class, 'id_product');
    }
}
