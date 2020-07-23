<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['name','is_deleted'];

    public function projects()
    {
        return $this->belongsToMany('App\Project', 'service_project', 'service_id', 'project_id');
    }
}
