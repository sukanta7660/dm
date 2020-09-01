<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    protected $fillable = [
        'paidAmount', 'deliveryCharge', 'discount','paymentType','transactionID', 'paymentStatus', 'orderType','address',
        'description','orderStatus','deliveryDate','userID'
    ];

    public function order_item(){
        return $this->hasMany('App\OrderItem', 'orderID');
    }

    public function customer(){
        return $this->belongsTo('App\User', 'userID');
    }
}
