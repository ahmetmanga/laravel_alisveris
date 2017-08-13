<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function temizle($veri){
    $veri = trim($veri);
    $temiz_veri = strip_tags(htmlspecialchars($veri));
    $sansurle = array('CREATE','DELETE','SELECT','FROM','LIMIT','TABLE','MYISAM','ORDER','ASC','JOIN','BINARY','WHERE',"'", "\"");
    $editle = array('---','---','---','---','---','---','---','---','---','---','---','---','','');
     return str_replace($sansurle,$editle,$temiz_veri);

    }
    public static function sepet_extra_explode($veri,$sepet_veri){
      $yine_bol = explode("--",$veri);
      $extra_type = explode("--",$sepet_veri["extra"]);
    if($yine_bol[0] == $extra_type[0]){
      // adet güncelliyoruz..
      $bol = explode("//",$yine_bol[1]);
      $toplam = $bol[0]+$sepet_veri["fiyat"];
      $adet = $bol[1]+$sepet_veri["adet"];
    return  $yine_bol[0]."--".$toplam."//".$adet;
    }
    return 0;
}
    public function satir_yap($veri){
      $veri2 = "";
      $veri = explode("\n",$veri);
      foreach($veri as $value){
          $veri2 .= $value."<br>";
      }
      return $veri2;
    }
}
