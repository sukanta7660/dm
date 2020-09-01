<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'orderItemID';
    protected $fillable = [
        'orderID', 'productID', 'quantity', 'price', 'status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'productID');
    }
}
