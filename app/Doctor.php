<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    public function department(){
       return $this->belongsTo('App\Department','department_id');
    }
    public function sub_department(){
        return $this->belongsTo('App\Department','sub_department_id');
    }
    public function appointment(){
        return $this->hasMany('App\Appointment');
    }
}
