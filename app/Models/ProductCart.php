<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id', 'product_id'
    ];


    protected $table = 'product_carts';

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
