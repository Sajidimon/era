<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'total', 'sales_funnel_id', 'status'];

    public function funnel()
    {
        return $this->belongsTo(SalesFunnel::class, 'sales_funnel_id');
    }

}
