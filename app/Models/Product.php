<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'regular',
        'discount',
        'category',
        'stock',
        'description',
        'thumbnail',
    ];

    public function funnels(){
        return $this->belongsToMany(SalesFunnel::class, 'sales_funnel_product');
    }
}
