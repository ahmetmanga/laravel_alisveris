<?php
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['timeout_control'])->group(function(){
  Route::get('sepete_ekle/{urun_id}/{adet}/{extra}', function($urun_id,$adet,$extra){
      if(Request::ajax()){

        $urun_id = \App\Http\Controllers\Controller::temizle($urun_id);
        $adet = \App\Http\Controllers\Controller::temizle($adet);
          if(is_numeric($urun_id) && is_numeric($adet) && $adet>0 && $adet<=100 && $urun_id >0){
            $data = \App\Product::where('id',$urun_id)->first();
              if($data->view == 0){
                return Response::json(['Belirtilen ürün stokta yok.']);
              }else{
                if(strpos($data->resim,'*resim*')){
                  $resim = explode('*resim*',$data->resim);
                  $resim = $resim[0];
                }else{
                  $resim = $data->resim;
                }
              if($extra != "undefined"){
                  $bol = explode("**",$data->color_type);
                if(is_numeric($extra)){
                  $sepet_veri["extra"] = $bol[$extra]."//".$adet;
                  $bol2 = explode("--",$bol[$extra]);
                  $sepet_veri["fiyat"] = ((int)$bol2[1])*$adet;
                }else{
                  foreach($bol as $v){
                    $bol2 = explode("--",$v);
                    if($data->price == $bol2[1]){
                      $sepet_veri["extra"] = $v."//".$adet;
                      $sepet_veri["fiyat"] = ((int)$bol2[1])*$adet;
                    }
                  }
                }
            }else{
              $sepet_veri["extra"] = $data->color_type."//".$adet;
              $bol = explode("--",$data->color_type);
              $sepet_veri["fiyat"] = ((int)$bol[1])*$adet;
            }

              $sepet_veri["isim"] = $data->name;
              $sepet_veri["adet"] = $adet;
              $sepet_veri["urun_id"] = $urun_id;
              $sepet_veri["resim"] = $resim;
              $donen = Session::get('sepet');
              if(count($donen)>20){
                return Response::json(['error'=>'Tek sefer de 20 den fazla ürün satın alamazsınız.']);
              }else if(empty($donen)){
                Session::put('sepet',[$urun_id=>$sepet_veri]);
                $donen = Session::get('sepet');
                return Response::json(['data'=>$donen]);
              }else{
                /* array_key_exists de $urun_id yi arıyoruz çünkü dönen dizisinde $urun_id key $sepet_veri de value... */
                      if(array_key_exists($urun_id,$donen)){
                        // ürün daha önce sepeti eklendiyse
                          $donen[$urun_id]["adet"] += $adet;
                            if(strpos($donen[$urun_id]["extra"],"**")){
                              // sepete aynı üründen farklı türde eklendiyse.
                              $extra_bol1 = explode("**",$donen[$urun_id]["extra"]);
                              $durum = 0;
                              $i=0;
                              foreach($extra_bol1 as $value){
                                $i++;
                                $bol2 = explode("--",$value);
                                $extra = explode("--", $sepet_veri["extra"]);
                                if($bol2[0] ==$extra[0]){
                                  $durum =$i;
                                    // aynı üründen aynı tür eklenmiş. adet fiyat güncelliyoruz..
                                  $bol3 = explode("//",$bol2[1]);
                                  $toplam = $bol3[0]+$sepet_veri["fiyat"];
                                  $adet = $bol3[1]+$sepet_veri["adet"];
                                  $string = $bol2[0]."--".$toplam."//".$adet;
                                }
                              }
                              if($durum == 0){
                                // aynı üründen aynı tür eklenmemiş. sonuna ekliyoruz.
                              $donen[$urun_id]["extra"] = $donen[$urun_id]["extra"]."**".$sepet_veri["extra"];
                            }else{
                              // adet fiyat güncelledik extra bölümüne dahil ediyoruz.
                              $bol = explode("**",$donen[$urun_id]["extra"]);
                              $bol[$durum-1] = $string;
                              $donen[$urun_id]["extra"] = implode("**",$bol);
                            }

                            }else{

                              // ürünün aynı türü eklenmemiş..
                                $yine_bol = explode("--",$donen[$urun_id]["extra"]);
                                $extra_type = explode("--",$sepet_veri["extra"]);
                              if($yine_bol[0] == $extra_type[0]){
                                // adet arttırıyoruz..
                                $bol = explode("//",$yine_bol[1]);
                                $toplam = $bol[0]+$sepet_veri["fiyat"];
                                $adet = $bol[1]+$sepet_veri["adet"];
                                $donen[$urun_id]["extra"] = $yine_bol[0]."--".$toplam."//".$adet;
                              }else{
                                $donen[$urun_id]["extra"] = $donen[$urun_id]["extra"]."**".$sepet_veri["extra"];
                              }
                            }
                          $donen[$urun_id]["fiyat"] += $sepet_veri["fiyat"];
                          Session::forget('sepet');
                          Session::put('sepet',$donen);
                          return Response::json(['data'=>$donen]);
                    }else{
                        $donen[$urun_id] = $sepet_veri;
                        Session::put('sepet',$donen);
                      return Response::json(['data'=>$donen]);
                   }


              }
              }
          }else{
            return Response::json(['error'=>'Sistem bir hata ile karşılaştı.']);
          }
      }
    });

      Route::get('sepet_sil/{urun_id}/{adet}', function($urun_id,$adet){
          if(Request::ajax()){
              $urun_id = \App\Http\Controllers\Controller::temizle($urun_id);
                $adet = \App\Http\Controllers\Controller::temizle($adet);
              if(is_numeric($urun_id) && $urun_id>0){
                $ses = Session::get('sepet');
                 $i=0;
                foreach($ses as $v){
                  $i++;
                    if($v["urun_id"] == $urun_id && $v["adet"] == $adet){
                      $deger = $i;
                    }
                }
                  unset($ses[$deger-1]);
                  $ses = array_values($ses);
                    Session::forget('sepet');
                    Session::put('sepet',$ses);
                  return Response::json(['data'=>$ses]);
              }

  } });
  Route::get('adet_guncelle/{urun_id}/{adet}', function($urun_id,$adet){
      if(Request::ajax()){
          $urun_id = \App\Http\Controllers\Controller::temizle($urun_id);
            $adet = \App\Http\Controllers\Controller::temizle($adet);
              $data = DB::table("product")->where('id',$urun_id);
          if(is_numeric($urun_id) && $urun_id>0 && $adet>0){
            $sepet = Session::get('sepet');
            if(empty($sepet)){
              return Response::json(['error'=>'Sepetinizde ürün yok.']);
            }else{
              if(array_key_exists($urun_id, $sepet)){

                if(strpos($sepet[$urun_id]["extra"],"**")){
                      $adetler = [];
                      $type = [];
                      $fiyatlar = [];
                  $ex = explode("**",$sepet[$urun_id]["extra"]);
                    foreach($ex as $value){
                      $explode = explode("--",$value);
                      array_push($type,$explode[0]);
                      $fiyat = explode("//",$explode[1]);
                      array_push($fiyatlar,$fiyat[0]);
                      array_push($adetler,$fiyat[1]);
                    }
                    tekrar:
                    $en_buyuk = $fiyatlar[0];
                    $indis = 0;
                      for($i=1;$i<count($fiyatlar);$i++){
                          if($en_buyuk <= $fiyatlar[$i]){
                            $en_buyuk = $fiyatlar[$i];
                            $indis = $i;
                          }
                      }
                      $adetler[$indis] += $adet-$sepet[$urun_id]["adet"];
                      if($adetler[$indis]<1){
                        unset($adetler[$indis]);    $adetler = array_values($adetler);
                        unset($fiyatlar[$indis]);   $fiyatlar = array_values($fiyatlar);
                        unset($type[$indis]);       $type = array_values($type);
                        goto tekrar;

                      }
                      $string = [];
                      for($i=0;$i<count($adetler);$i++){
                        $string[$i] = $type[$i]."--".$fiyatlar[$i]."//".$adetler[$i];
                      }
                    $aciklama = implode("**",$string);
                      $sepet[$urun_id]["fiyat"] = $en_buyuk*$adet;
                      $sepet[$urun_id]["extra"] = $aciklama;
                      $sepet[$urun_id]["adet"] = array_sum($adetler);
                }else{
                  $fiyat = explode("--",$sepet[$urun_id]["extra"]);
                  $fiyat_son = explode("//",$fiyat[1]);
                  $sepet[$urun_id]["fiyat"] = ($fiyat_son[0]/$sepet[$urun_id]["adet"])*$adet;
                  $sepet[$urun_id]["extra"] = $fiyat[0]."--".$sepet[$urun_id]["fiyat"]."//".$adet;
                  $sepet[$urun_id]["adet"] = $adet;
                }



                Session::forget('sepet');
                Session::put('sepet',$sepet);
                return Response::json(['data'=>$sepet]);
              }else{
                return Response::json(['error'=>'Belirtilen ürün sepetiniz de mevcut değil.']);
              }
            }
          }

} });
  Route::get('sepet_bosalt',function(){
      if(Request::ajax()){
            Session::forget('aciklama'); Session::forget('toplam_ucret'); Session::forget('urun_adeti');
          Session::forget('kargo_durumu'); Session::forget('hizli'); Session::forget('sepet'); Session::forget('kupon');
              $data = [];
              return Response::json(['data'=>$data]);
      }else{
        return Response::json(['error'=>'Sistem bir hatayla karşılaştı.']);
      }
  });
  Route::get('ilce_al/{il_id}',function($il_id){
    if(Request::ajax() && Auth::check()){
        $il_id = \App\Http\Controllers\Controller::temizle($il_id);
          if(is_numeric($il_id) && $il_id>=1 && $il_id<=81){
            $ilceler = DB::table("ilceler")->where('il_no',$il_id)->orderBy('isim','ASC')->get();
            return Response::json(['data'=>$ilceler]);
          }else{
            return Response::json(['error'=>'Hatalı il seçimi!']);
          }
    }
  });
    Route::get('veri_getir/{arama}',function($arama){
    if(!empty($arama) && Request::ajax()){
      $arama = \App\Http\Controllers\Controller::temizle($arama);
      $data2 = DB::select("SELECT * FROM `product` WHERE `name` LIKE '%".$arama."%' AND view=1 ORDER BY ratings DESC LIMIT 0,10");
      $data = [];
      foreach($data2 as $value){
          if(strpos($value->resim,"*resim*")){
            $bol = explode("*resim*",$value->resim);
            $value->resim = $bol[0];
          }
          $data[$value->id] = $value;
      }
      return Response::json(['data'=>$data]);
    }
  });
  Route::get('/', function () {
      return view('sayfa.index');
  });
  Route::get('/kayit',function(){
  if(\Auth::check()){
              return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Üye girişi yapmış durumdasınız. Şuan bu işlemi yapamazsınız.']);
  }else{
      return view('sayfa.kayit');
  }
  });
  Route::get('/login',function(){
  if(\Auth::check()){
              return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Üye girişi yapmış durumdasınız. Şuan bu işlemi yapamazsınız.']);
  }else{
      return view('sayfa.giris');
  }
  });

  Route::post('/kayit',['uses'=>'UserController@signup']);
  Route::post('/login',['uses'=>'UserController@login']);
  Route::get('/index',function(){
    return view('sayfa.index');
  });
  Route::get('giris',function(){
    if(\Auth::check()){
    return view('sayfa.index')->with(['tur'=>'alert-danger','mesaj'=>'Üye girişi yapmış durumdasınız. Şuan bu işlemi yapamazsınız.']);
    }else{
    return view('sayfa.giris');
  }
  });
  Route::get('/logout', function(){
        Auth::logout();
        return redirect("/")->with(['tur'=>'alert-success','mesaj'=>'Çıkış yapıldı.']);

  });
  Route::get('category/{id}', ['uses'=>'UrunController@detay_goster']);
  Route::get('filtrele',['uses'=>'UrunController@filtrele']);
  Route::get('urun_detay/{urun_id}',['uses'=>'UrunController@urun_detay']);

  Route::get('ara',['uses'=>'UrunController@arama_yap']);
    Route::get('sepetim',['uses'=>'ShoppingController@myCart']);
    Route::get('urun_detay/yorumlar/{urun_id}',['uses'=>'UrunController@yorumlar']);
  // only User
  Route::middleware(['login_control'])->group(function(){
    // kullanıcı giriş yapmışsa.
    Route::get('profil/adres_ekle',['uses'=>'UserController@adres_ekle']);
    Route::post('profil/adres_ekle',['uses'=>'UserController@adres_eklendi']);
    Route::get('odeme_onayla',['uses'=>'ShoppingController@odeme_onayla']);
    Route::post('odeme_onayla',['uses'=>'ShoppingController@odeme_db']);
    Route::post('yorum_gonder',['uses'=>'UrunController@yorum_gonder']);
    Route::get('siparisler',['uses'=>'ShoppingController@siparisler']);
    Route::get('siparis_detay/{sip_id}',['uses'=>'ShoppingController@siparis_detay']);
    Route::post('odeme_onayla/kupon',['uses'=>'ShoppingController@kupon_aktif']);
    Route::get('profil/adreslerim',['uses'=>'UserController@adresler']);
    Route::get('profil/adres_sil/{adres_id}',['uses'=>'UserController@adres_sil']);
    Route::get('profil/adres_duzenle/{adres_id}',['uses'=>'UserController@adres_duzenle']);
    Route::post('profil/adres_duzenle',['uses'=>'UserController@adres_duzenle_post']);
    Route::get('profil/bilgi_duzenle',['uses'=>'UserController@bilgi_duzenle']);
    Route::post('profil/bilgi_duzenle',['uses'=>'UserController@bilgi_duzenle_form']);
    Route::get('profil/sifre_islemleri',function(){ return view('sayfa.sifre_islemleri'); });
    Route::post('profil/sifre_islemleri',['uses'=>'UserController@sifre_islemleri']);

    // admin ozel
    Route::middleware(['admin_ozel'])->group(function(){
      // admin girişi olduysa..
    });
  });
});
