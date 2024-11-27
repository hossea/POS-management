<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'description',
        'brand',
        'price',
        'quantity',
        'alert_stock',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price', 'discount', 'total');
    }

    public function OrderDetail()
    {
        return $this-> hasMany(OrderDetail::class);
    }
    public function Product()
    {
        return $this-> belongsTo(OrderDetail::class);
    }

}
