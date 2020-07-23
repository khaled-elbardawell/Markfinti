<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoClient extends Model
{
    protected $table = 'info_clients';

    protected $fillable = ['companyField','companyName','companyNo','user_id'];



    public function client()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }
}
