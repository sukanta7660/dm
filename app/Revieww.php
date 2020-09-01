<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revieww extends Model
{
    protected $table = "reviewws";
    protected $primaryKey = "reviewID";
    protected $fillable = ['naame','review','status'];

}
