<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'name',
        'phone',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price', 'discount', 'total');
    }
    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
