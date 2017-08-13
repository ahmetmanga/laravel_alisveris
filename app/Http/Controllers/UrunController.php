<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB,Auth;
use Response,Validator;
class UrunController extends Controller
{

/*
        işlemler de bir hata olursa paren::merge fonk. yüzünden olabilir.
        onu kaldırıp if(count($veri) != 0) $data = array_merge_recursive($veri,$data); ekle..


*/
      public static function puan_hesaplat($data){
        // puanı hesaplatıyoruz.
            $yorumlar2 = DB::select("SELECT * FROM `yorumlar` WHERE `urun_id` = ".$data->id." AND `yayin_durumu` = 1");
            if(count($yorumlar2) == 0){
              return 0;
            }else{
              return $data->ratings/count($yorumlar2);
            }
      }
      public function yorum_sahibi($yorumlar2){
        $yorumlar = [];
            foreach($yorumlar2 as $yorum){
              $uye_sor = DB::table("users")->where('id',$yorum->user_id)->first();
              $yorum->user_id = $uye_sor->name;
              $yorumlar[$yorum->id] = $yorum;
            }
            return $yorumlar;
      }
      public function urun_cek($kat_id,$min,$max,$search_string,$sirala2,$data){
        if(is_array($kat_id)){ $kat_id = $kat_id[0]; }
      $normal_cat = DB::select('SELECT * FROM `product` WHERE view=1 AND `cat_id` LIKE '.$kat_id.' AND `price` BETWEEN '.$min.' AND '.$max.' AND `comment` LIKE '.$search_string.' ORDER BY '.$sirala2);
      if(count($normal_cat) != 0) $data = array_merge_recursive($normal_cat,$data);
      /* alt kat bakiyoruz */
      $alt_kat = DB::table("category")->where('type',$kat_id)->get();
     foreach($alt_kat as $veri){
      $normal_cat = DB::select('SELECT * FROM `product` WHERE view=1 AND `cat_id` LIKE '.$veri->id.' AND `price` BETWEEN '.$min.' AND '.$max.' AND `comment` LIKE '.$search_string.' ORDER BY '.$sirala2);
      if(count($normal_cat) != 0) $data = array_merge_recursive($normal_cat,$data);
        $alt_kat = DB::table("category")->where('type',$veri->id)->get();
        foreach($alt_kat as $veri2){
          $normal_cat = DB::select('SELECT * FROM `product` WHERE view=1 AND `cat_id` LIKE '.$veri2->id.' AND `price` BETWEEN '.$min.' AND '.$max.' AND `comment` LIKE '.$search_string.' ORDER BY '.$sirala2);
          if(count($normal_cat) != 0) $data = array_merge_recursive($normal_cat,$data);
                      } }            return $data;
      }

    public function detay_goster($id){
      $id = parent::temizle($id);
      $data = [];
      $kat_bilgisi = [];
        if(is_numeric($id)){
          $kat = DB::table("category")->where('id',$id)->first();
          if(count($kat) == 0){
            return redirect("/")->with(['tur'=>'alert-danger','mesaj'=>'Kategori bulunamadı!']);
          }else{
            $alt_kat = DB::table("category")->where('type',$kat->id)->where('view',1)->get();
              if(count($alt_kat) == 0){
                $kat_bilgisi = DB::table("category")->where('type',$kat->type)->get();
                $data = DB::table("product")->where('cat_id',$id)->where('view',1)->orderBy('id','DESC')->get();
              }else{
                $kat_bilgisi = $alt_kat;
                foreach($alt_kat as $kat_2){

                  $veri =  DB::select('SELECT * FROM `product` WHERE view=1 AND `cat_id` LIKE '.$kat_2->id.' ORDER BY id DESC');
                    if(count($veri) != 0) $data = array_merge_recursive($veri,$data);
                        $iki = DB::table("category")->where('type',$kat_2->id)->get();
                        if(count($iki) != 0){
                          foreach($iki as $kat_3){
                            $veri = DB::select('SELECT * FROM `product` WHERE view=1 AND `cat_id` LIKE '.$kat_3->id.' ORDER BY id DESC');
                            if(count($veri)!=0) $data = array_merge_recursive($veri,$data);
                          }
                        }
                }
              }
              $title = DB::table("category")->where('id',$id)->first();
              // puanı hesaplatıyoruz.

              $data2 = [];
              foreach($data as $value){
                $value->ratings = self::puan_hesaplat($value);
                $data2[$value->id] = $value;
              }
              return view('sayfa.urunler_liste')->with(['data'=>$data2,'kat_bilgisi'=>$kat_bilgisi,'mevcut_id'=>$id,'title'=>$title]);
          }
          }
        }

    public function filtrele(Request $req){
        $kat_id = parent::temizle($req->input("kat_id"));
        $min = parent::temizle($req->input("en_az"));
        $max = parent::temizle($req->input("en_cok"));
        $anahtar = parent::temizle($req->input("anahtar"));
        $anahtar_array = [];
        $sirala = parent::temizle($req->input("sirala"));
        if(empty($sirala)){ $sirala2 = "id DESC" ;
        }else if($sirala == "fiyat_artan"){ $sirala2 = "price ASC";
        }else if($sirala == "fiyat_azalan"){ $sirala2 = "price DESC";
        }else if($sirala == "yorum_artan"){ $sirala2 = "ratings ASC";
        }else if($sirala == "yorum_azalan"){ $sirala2  = "ratings DESC";
        }else{ $sirala2 = "id DESC"; }
        if(strpos($anahtar,",")){
          $anahtar = explode(",",$anahtar);
          foreach($anahtar as $value){
              array_push($anahtar_array,"'%".$value."%'");
          }
          $search_string = implode(" OR comment LIKE ",$anahtar_array);
        }else{
          $search_string = "'%".$anahtar."%'";
        }

        $kat_id = explode(",",$kat_id);
        $kat_bilgisi = [];
        $data = [];
        /*
        0. indis ayrı bir durumdadır.
        onu for içine alırsam üst kategori olduğu için sorun cıkacaktır.
        o yüzden ayrı bölümde yazdım.


        */
          if(count($kat_id) == 0 && empty($min) && empty($max)){
            return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Hiç bir kriter seçmediniz.']);
          }else{
                if(empty($min)) $min=0;
                if(empty($max)) $max = 999999;
                if(count($kat_id) <= 2){
                    $data = self::urun_cek($kat_id,$min,$max,$search_string,$sirala2,$data);
              }else{

                for($i=1;$i<count($kat_id)-1;$i++){
                  if(!empty($kat_id[$i])){
                        $data = self::urun_cek($kat_id[$i],$min,$max,$search_string,$sirala2,$data);
                      }
                  }  }
              $kat_bilgisi = DB::table("category")->where('type',$kat_id[0])->where('view',1)->get();
              if(count($kat_bilgisi) == 0){
                $gecici = DB::table("category")->where('id',$kat_id[0])->first();
                $kat_bilgisi = DB::table("category")->where('type',$gecici->type)->where('view',1)->get();
              }
              if(count($data) == 0){
                return redirect('/')->with(['tur'=>'alert-danger', 'mesaj'=>'Arama kriterlerine ürün bulunamadı.']);
              }else{
                  $title = DB::table("category")->where('id',$kat_id[0])->where('view',1)->first();

                  $data2 = [];
                  foreach($data as $value){
                    $value->ratings = self::puan_hesaplat($value);
                    $data2[$value->id] = $value;
                  }
                return view('sayfa.urunler_liste')->with(['data'=>$data2,'kat_bilgisi'=>$kat_bilgisi,'mevcut_id'=>$kat_id[0],'max'=>$max,'min'=>$min,'secilen'=>$kat_id,'anahtar'=>$anahtar,'sirala'=>$sirala,'anahtar_array'=>$anahtar_array,'title'=>$title]);
                        } }
                      }

      public function urun_detay($urun_id){
        $urun_id = parent::temizle($urun_id);
        if(is_numeric($urun_id)){
          $data = DB::table("product")->where('id',$urun_id)->first();
          if(count($data) == 0){
            return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Seçtiğiniz ürün bulunamadı.']);
          }else{
            $bankalar = DB::table("bankalar")->get();
            $stok = DB::table('stok')->where('urun_id',$data->id)->first();
            $kat = DB::table("category")->where('id',$data->cat_id)->first();
            $yorumlar2 = DB::select("SELECT * FROM `yorumlar` WHERE `urun_id` = ".$data->id." AND `yayin_durumu` = 1 ORDER BY id DESC");
            $yorumlar = [];
              $yorumlar = self::yorum_sahibi($yorumlar2);
            $yorum_sayisi = count($yorumlar2);
            $yorumlar = array_slice($yorumlar,0,10);
            $yorumlar3 = [];
             foreach($yorumlar as $yorum){
                $yorum->yorum = parent::satir_yap($yorum->yorum);
                $yorumlar3[$yorum->id] = $yorum;
             }
            $data->ratings = self::puan_hesaplat($data);
            $most_popular2 = DB::table("product")->where('cat_id',$data->cat_id)->where('view',1)->orderBy('satis_miktari','DESC')->take(10)->get();
            $most_popular = [];
            foreach($most_popular2 as $value){
              if(strpos($value->resim,"*resim*")){
                $exp = explode("*resim*",$value->resim);
                $value->resim = $exp[0];
              }
                $most_popular[$value->id] = $value;
            }
            return view('sayfa.urun_detay')->with(['yorum_sayisi'=>$yorum_sayisi,'data'=>$data,'kat'=>$kat,'bankalar'=>$bankalar,'stok'=>$stok,'yorumlar'=>$yorumlar3,'cok_satilanlar'=>$most_popular]);
          } } }

        public function arama_yap(Request $r){
          $data = [];
          $data2 = [];
          $kat_bilgisi = [];
          $kat_bilgisi2 = [];
          $search_data = [];
          $ara = parent::temizle($r->input('arama'));
           if(empty($ara)){
             return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Bir arama yapmadınız.']);
           }else {
                    if(strpos($ara,",")){
                      $ara = explode(",",$ara);
                      foreach($ara as $value){
                        $search_data = trim($search_data);
                        array_push($search_data,"'%".$value." %'");
                      }
                        $string = implode(" OR comment LIKE ",$search_data);
                    }else{
                      $ara = trim($ara);
                      $string = "'%".$ara." %'";
                    }
             $veri = DB::select("SELECT * FROM `product` WHERE view=1 AND `name` LIKE ".$string." ORDER BY ratings DESC");
             if(count($veri) != 0) $data2 = array_merge_recursive($veri,$data2);
             $veri = DB::select("SELECT * FROM `product` WHERE view=1 AND `comment` LIKE ".$string." ORDER BY ratings DESC");
            if(count($veri) != 0) $data2=array_merge_recursive($veri,$data);

                 foreach($data2 as $v){
                     $kat_db = DB::select("SELECT * FROM category WHERE view=1 AND id=".$v->cat_id." ORDER BY id DESC");
                     if(count($kat_db) != 0){ $kat_bilgisi2 = array_merge_recursive($kat_db,$kat_bilgisi2);  $id = $v->cat_id; }
                 }

               foreach ($kat_bilgisi2 as $c) {
                   $kat_bilgisi[$c->id] = $c; // Get unique country by code.
               }
               foreach ($data2 as $c) {
                   $data[$c->id] = $c; // Get unique country by code.
               }

               if(count($data) == 0){
                 return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Aradığınız ürün bulunamadı.']);
               }else{

                 $data_5 = [];
                 foreach($data as $value){
                   $value->ratings = self::puan_hesaplat($value);
                   $data_5[$value->id] = $value;
                 }
                   $title = DB::table("category")->where('id',$id)->first();
                 return view('sayfa.urunler_liste')->with(['data'=>$data_5,'kat_bilgisi'=>$kat_bilgisi,'mevcut_id'=>$id,'search_data'=>$search_data,'ara'=>$ara,'title'=>$title]);
               } } }

          public function yorum_gonder(Request $req){
            $form_array = ['urun_id'=>parent::temizle($req->urun_id),'puan'=>parent::temizle($req->puan),'yorum_baslik'=>parent::temizle($req->yorum_baslik),'yorum'=>parent::temizle($req->yorum)];
            $form_hata =  ['urun_id'=>'required|numeric','puan'=>'required|numeric',
            'yorum_baslik'=>'min:5|max:100|required','yorum'=>'required|min:10|max:200'];
            $form_mesaj = ['required'=>'Tüm alanları doldurmadınız.',
                           'numeric'=>'Değerler istenilen aralıkta değil.',
                           'yorum_baslik.min'=>'Yorum başlığı çok kısa.',
                           'yorum_baslik.max'=>'Yorum başlığı çok uzun.',
                           'yorum.min'=>'Yorum çok kısa.',
                           'yorum.max'=>'Yorum en fazla 200 karakter olabilir.'];
            $urun_ara = DB::table("product")->where('id',$form_array["urun_id"])->first();
                  $validate = Validator::make($form_array,$form_hata,$form_mesaj);
                  if($validate->fails()){
                    return redirect()->back()->withErrors($validate->errors());
                  }else if(count($urun_ara) == 0){
                    return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Aranılan ürün bulunamadı.']);
                  }else if($form_array["puan"]>5 || $form_array["puan"]<1){
                    return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Hatalı puan seçimi.']);
                  }else{
                    $ekle = DB::table("yorumlar")->insert([
                      'user_id'=>Auth::user()->id,
                      'urun_id'=>$form_array["urun_id"],
                      'yorum_baslik'=>$form_array["yorum_baslik"],
                      'yorum'=>$form_array["yorum"],
                      'puan'=>$form_array["puan"]
                    ]);
                    return redirect()->back()->with(['tur'=>'alert-success','mesaj'=>'Yorumunuz başarıyla kaydedildi. <br />Onaylandıktan sonra yayına alınacak.']);
                  }
          }

        public function yorumlar($urun_id){

          $urun_id = parent::temizle($urun_id);
          $sorgula = DB::table("product")->where('id',$urun_id)->first();
          $yorumlar2 = DB::select("SELECT * FROM `yorumlar` WHERE `urun_id` = ".$urun_id." AND `yayin_durumu` = 1 ORDER BY id DESC");
          $yorumlar = [];
          $yorumlar = self::yorum_sahibi($yorumlar2);
            if(!is_numeric($urun_id)){
              return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Ürün bulunamadı!']);
            }elseif(count($sorgula) == 0){
              return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Ürün bulunamadı.']);
            }else{
              if(strpos($sorgula->resim,"*resim*")){
               $resim = explode("*resim*",$sorgula->resim); $sorgula = $resim[0];
             }else{$resim = $sorgula->resim; }
             $sorgula->ratings = self::puan_hesaplat($sorgula);
             $yorumlar3 = [];
             foreach($yorumlar as $yorum){
                $yorum->yorum = parent::satir_yap($yorum->yorum);
                $yorumlar3[$yorum->id] = $yorum;
             }
              return view('sayfa.tum_yorumlar')->with(['data'=>$sorgula,'yorumlar'=>$yorumlar2,'resim'=>$resim]);
            }
        }

    }
