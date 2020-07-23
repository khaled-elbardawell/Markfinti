<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['amount','pay_date','project_id' ];

    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }
}
