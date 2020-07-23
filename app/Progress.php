<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';
    protected $fillable = ['name','is_deleted'];

    public function projects(){
        return $this->hasMany('App\Project','progress_id');
    }
}
