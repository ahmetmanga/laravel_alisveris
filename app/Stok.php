<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = "stok";

    public function product(){
      return $this->belongsTo('App\Product');
    }
}
