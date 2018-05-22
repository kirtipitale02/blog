<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artical extends Model
{
    protected $table='artical';

     public function article(){
    	return $this->belongsTo('App\Blog');
    }
}
