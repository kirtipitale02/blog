<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticalRelation extends Model
{
     protected $table='artical_relation';

   
   public function Article(){
   	return $this->belongsTo('App\artical','article_id');
   }
   
}
