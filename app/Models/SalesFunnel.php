<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesFunnel extends Model
{
    protected $fillable = [
        'title',
        'subheading',
        'image',
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'sales_funnel_product');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'sales_funnel_id');
    }
}
