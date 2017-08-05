<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hinhproduct extends Model
{
    //
    protected $table = "hinhproduct";
    // 1 tin tuc co nhieu comment
    public function product(){
    	return $this->belongsTo('App\Products','id_product','id');
    }
}
