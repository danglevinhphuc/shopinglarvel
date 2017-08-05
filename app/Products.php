<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = "products";
    public function category(){
    	return $this->belongsTo('App\Category','id_category','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\Bill_detail','id_product','id');
    }
    public function hinhproduct(){
    	return $this->hasMany('App\Hinhproduct','id_product','id');	
    }
}
