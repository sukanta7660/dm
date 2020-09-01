<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    protected $table = 'temp_orders';
    protected $primaryKey = 'tempOrderID';
    protected $fillable = [
        'sessionID', 'productID', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'productID');
    }
}
