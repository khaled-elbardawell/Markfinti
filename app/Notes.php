<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';

    protected $fillable = ['sender_id','project_id','message','date'];

    public function project(){
        return $this->belongsTo('App\Project','project_id');
    }
    public function sender(){
        return $this->belongsTo('App\User','sender_id');
    }
}
