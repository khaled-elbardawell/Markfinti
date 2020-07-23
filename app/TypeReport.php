<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeReport extends Model
{
    protected $table = 'type_reports';

    protected $fillable = ['name','is_deleted'];

    public function report(){
        return $this->hasOne('App\Reports','type_id');
    }
}
