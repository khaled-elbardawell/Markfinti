<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $table = 'reports';

    protected $fillable = ['name','reports','added_date','type_id','project_id'];

    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }

    public function typeReport(){
        return $this->belongsTo('App\TypeReport','type_id');
    }
}
