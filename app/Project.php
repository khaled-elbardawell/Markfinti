<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name','discription','budget' ,'is_complete' ,'start_date', 'end_date' ,'complete_date' ,'user_id','code_number','manger_id','progress_id'];





//  one to one relation
    public function client(){
        return $this->belongsTo('App\User','user_id');
    }

    public function manger(){
        return $this->belongsTo('App\User','manger_id');
    }

    public function progress()
    {
        return $this->belongsTo('App\Progress','progress_id');
    }

//  one to many relation

    public function transactions(){
        return $this->hasMany('App\Transaction','project_id');
    }

    public function reports(){
        return $this->hasMany('App\Reports','project_id');
    }

    public function notes(){
        return $this->hasMany('App\Notes','project_id');
    }



// many to many

    public function services()
    {
        return $this->belongsToMany('App\Service', 'service_project', 'project_id','service_id')->withTimestamps();
    }
}
