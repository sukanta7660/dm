<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $primaryKey = "productID";
    protected $fillable = ['name','price','imageName','productGroup','productType','isbidable','bidStatus','description','specification','categoryID','userID'];

    public function scopeSearch($query, $search){
        return $query->where('name','like',$search.'%')
            ->orWhere('price','like',$search.'%')
            ->orWhere('productType','like',$search.'%')
            ->orWhere('productGroup','like',$search.'%');
    }

    public function category(){
        return $this->belongsTo('App\Category','categoryID');
    }
    public function temp_order(){
        return $this->hasMany('App\TempOrder','productID');
    }
    public function product(){
        return $this->hasMany('App\ProductBid','productID');
    }
}
