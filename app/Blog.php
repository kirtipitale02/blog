<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title','description'];


    public function article(){
    	return $this->hasMany('App\article');
    }

    public function ArticalRelation(){
    	return $this->hasMany('App\ArticalRelation','blog_id');
    }

    public function scopeSearch($query , $s)
    {
    	return $query->where('title' , 'like' ,'%' .$s. '%')
    	             ->orWhere('description' , 'like' ,'%' .$s. '%');
    }

}
	