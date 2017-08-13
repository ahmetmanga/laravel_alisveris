<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresler extends Model
{
   protected $table = "adresler";

   // iliskili model.
   public function user(){
     return $this->belongsTo('App\User');
   }
}
