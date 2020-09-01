<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBid extends Model
{
    protected $table = "product_bids";
    protected $primaryKey = "bidID";
    protected $fillable = ['price','productID','userID'];
    public function customer(){
        return $this->belongsTo('App\User', 'userID');
    }
    public function bid(){
        return $this->belongsTo('App\Product','productID');
    }
}
