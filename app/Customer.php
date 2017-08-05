<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = "customer";
    // 1 tin tuc co nhieu comment
    public function Bills(){
    	return $this->hasMany('App\Bills','id_customer','id');
    }
}
