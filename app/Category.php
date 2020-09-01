<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'categoryID';
    protected $fillable = ['name', 'userID'];

    public function items()
    {
        return $this->hasMany('App\Product','categoryID');
    }
}
