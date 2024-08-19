<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'seller_id', 'name', 'description', 'price', 'status', 'image',
    ];


    protected $table = 'products';


    public function seller()
    {
        return $this->belongsTo('App\Models\Seller', 'seller_id');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Models\Cart', 'product_carts');
    }


    
}
