<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Product,Session;
use Response;
class ShoppingController extends Controller
{
    public function extra($value){
        $string = "";
      if(strpos($value,"**")){
                   $explode = explode("**",$value);

                   foreach($explode as $extra){
                     $string .= "<p>".str_replace(["--","//"],[" "," ₺ Adet: "],$extra). "</p>";
                   }
                }else{
                  $string .= "<p>".str_replace(["--","//"],[" "," ₺ Adet: "],$value). "</p>";;
                }
            return $string;
    }
    public function sip_durum($data){
        date_default_timezone_get('Europe/Istanbul');
       setlocale(LC_TIME, 'tr_TR'); 
      if($data->siparis_durumu == 0){ $data->siparis_durumu = "<font class='text-muted'>Onay Bekliyor</font>"; }
      else if($data->siparis_durumu == 1){ $data->siparis_durumu = "<font class='text-success'>Onaylandı</font>"; }
      else if($data->siparis_durumu == 2){ $data->siparis_durumu = "<font class='text-primary'>Kargoya Hazırlanıyor</font>"; }
      else if($data->siparis_durumu == 3){ $data->siparis_durumu = "<font class='text-warning'>Kargoya Verildi</font>"; }
      else if($data->siparis_durumu == 4){ $data->siparis_durumu = "<font class='text-success'>Ürün Teslim Edildi</font>"; }

       if($data->odeme_yontemi == 1){ $data->odeme_yontemi = "Kredi Kartı"; }else if($data->odeme_yontemi == 0){ $data->odeme_yontemi = "Havale"; }
       if($data->kargo_secenegi == 1){ $data->kargo_secenegi = "Hızlı Teslimat"; }elseif($data->kargo_secenegi == 0){
         $data->kargo_secenegi == 0; }
        $tarih = explode(" ",$data->created_at);
        $tarih2 = explode("-",$tarih[0]);
        $data->created_at = strftime("%d %B %Y %A",strtotime($tarih[0]));
        $uye_sorgula = DB::table("users")->where('id',$data->user_id)->first();
        $data->user_id = $uye_sorgula->name;
        $adres_sorgu = DB::table("adresler")->where('id',$data->adres_bilgileri)->first();
        $data->adres_bilgileri = "<h4>".$adres_sorgu->adress_type."</h4>".$adres_sorgu->adress."<br>".$adres_sorgu->ad_soyad." - ".$adres_sorgu->cep_no;
          return $data;
    }
    public function myCart(){
      $sepet = Session::get('sepet');
      $stok = [];
      $aciklama = [];
      $toplam_ucret = 0;
      $urun_adeti = 0;
        if(empty($sepet)){
          return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Sepetinizde ürün yok.']);
        }else{
          foreach($sepet as $value){
              $veri = DB::table("stok")->where('urun_id',$value["urun_id"])->first();
              $stok[$value["urun_id"]] = $veri;
                $string = self::extra($value["extra"]);
                 $aciklama[$value["urun_id"]] = $string;
                 $toplam_ucret += $value["fiyat"];
                 $urun_adeti += $value["adet"];
                 $kargo_durumu[$stok[$value["urun_id"]]->kargo] = $stok[$value["urun_id"]]->kargo;
            }
            if(in_array(1,$kargo_durumu)){
              $kargo = "ucretsiz";
            }else{
              $kargo = "ucretli";
            }
            Session::forget('kargo_durumu'); Session::put('kargo_durumu',$kargo); Session::forget('aciklama');
            Session::put('aciklama',$aciklama); Session::forget('toplam_ucret'); Session::put('toplam_ucret',$toplam_ucret);
            Session::forget('urun_adeti'); Session::put('urun_adeti',$urun_adeti);
          if(Auth::check()){ $sign = "user"; }else{ $sign = "guest"; }
          return view('sayfa.mycart')->with(['sepet'=>$sepet,'stok'=>$stok,'sign'=>$sign,'aciklama'=>$aciklama,'toplam_ucret'=>$toplam_ucret,'urun_adeti'=>$urun_adeti,'kargo'=>$kargo]);
        }
    }

    public function odeme_onayla(){
      $sepet = Session::get('sepet');
      $stok = [];
      $aciklama = [];
      $toplam_ucret = 0;
      $urun_adeti = 0;
      $hizli = 1;
      $kupon = Session::get('kupon');
        if(empty($sepet)){
          return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Sepetinizde ürün yok.']);
        }else{
          foreach($sepet as $value){
              $veri = DB::table("stok")->where('urun_id',$value["urun_id"])->first();
              $stok[$value["urun_id"]] = $veri;
              $hizli = $veri->hizli_teslimat;
               $string = "";
                if(strpos($value["extra"],"**")){
                   $explode = explode("**",$value["extra"]);

                   foreach($explode as $extra){
                     $string .= str_replace(["--","//"],[" "," ₺ Adet: "],$extra). "<br />";
                   }
                }else{
                  $string .= str_replace(["--","//"],[" "," ₺ Adet: "],$value["extra"]). "<br />";
                }
                 $aciklama[$value["urun_id"]] = $string;
                 $toplam_ucret += $value["fiyat"];
                 $urun_adeti += $value["adet"];
                 $kargo_durumu[$stok[$value["urun_id"]]->kargo] = $stok[$value["urun_id"]]->kargo;
            }
            if(in_array(1,$kargo_durumu)){
              $kargo = "ucretsiz";
            }else{
              $kargo = "ucretli";
            }
            if(!empty($kupon)){ $toplam_ucret = ($toplam_ucret - ($toplam_ucret)*($kupon/100)); }
            Session::forget('toplam_ucret'); Session::put('toplam_ucret',$toplam_ucret);
            Session::forget('aciklama'); Session::put('aciklama',$aciklama); 
            Session::forget('urun_adeti'); Session::put('urun_adeti',$urun_adeti);
            Session::forget('kargo_durumu'); Session::put('kargo_durumu',$kargo);
            Session::forget('hizli'); Session::put('hizli',$hizli);
            $isim = Auth::user()->name;
            $adresler = DB::table("adresler")->where('user_id',Auth::user()->id)->where('yayin',1)->orderBy('id','DESC')->get();
            $iller = DB::table("iller")->get();
            $bankalar = DB::table("bankalar")->get();
          return view('sayfa.odeme_onayla')->with(['bankalar'=>$bankalar,'hizli'=>$hizli,'sepet'=>$sepet,'stok'=>$stok,'isim'=>$isim,'aciklama'=>$aciklama,'toplam_ucret'=>$toplam_ucret,'urun_adeti'=>$urun_adeti,'kargo'=>$kargo,'adresler'=>$adresler,'iller'=>$iller]);
        }
    }
    // ödeme
    public function odeme_db(Request $req){
      $adres = parent::temizle($req->input('adres'));
      $odeme = parent::temizle($req->input('odeme'));
      $kargo = parent::temizle($req->input('kargo'));
      $taksit = parent::temizle($req->input('taksit'));
      $taksit_sayisi = substr($taksit,0,1);
      $taksit_banka = substr($taksit,1,strlen($taksit));
      $toplam_ucret = Session::get('toplam_ucret'); $kargo_durumu = Session::get('kargo_durumu');
      $hizli = Session::get('hizli');  $sepet = Session::get('sepet');
      $aciklama = Session::get('aciklama'); $adres_sorgu = DB::table("adresler")->where('id',$adres)->first();
        if(!is_numeric($odeme) || !is_numeric($kargo) || !is_numeric($adres) || empty($sepet)){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Bilgiler doğrulanamadı!']);
        }else if(($odeme == 1 && empty($taksit)) || ($toplam_ucret<300 && $taksit_sayisi>3) || ($toplam_ucret<100 && !empty($taksit))){
            return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Ödeme Bilgilerinde Bir Hata Oluştu. Tekrar deneyin.']);
        }else if($toplam_ucret>=100 && !is_numeric($taksit) && $odeme == 1){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Taksit seçmediniz.']);
        }else if(($adres_sorgu->user_id != Auth::user()->id) || count($adres_sorgu) == 0){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Seçtiğiniz adres bulunamadı!']);
        }else if($hizli == 1 && $kargo == 1){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Bu ürünler hızlı teslimatta kullanılamaz.']);
        }else{
            if($kargo == 1) $toplam_ucret += 10;
            if($kargo == 0 && $kargo_durumu == "ucretli") $toplam_ucret += 5;
            if($odeme == 0){ $taksit_sayisi = []; }else{ 
                $banka_sorgula = DB::table("bankalar")->where('id',$taksit_banka)->first();
              $taksit_sayisi = ['banka'=>$banka_sorgula->banka_ismi,'taksit'=>$taksit_sayisi]; }
              $taksit_sayisi = json_encode($taksit_sayisi);
              // stok kontrol ediyoruz.
              $durum = true;
              foreach($sepet as $value){
               $kontrol = DB::table("stok")->where('urun_id',$value["urun_id"])->first();
                if($kontrol->stok < $value["adet"]){
                  $durum = false;
                }
              }
              if($durum == false){
                return redirect('sepetim')->with(['tur'=>'alert-danger','mesaj'=>'Sepetinizdeki ürünler için stoklarımız yetersiz. <br>Lütfen ürün adetlerini yeniden güncelleyin.']);
              }else{
                foreach($sepet as $value){
                $kontrol = DB::table("stok")->where('urun_id',$value["urun_id"])->first();
                $update = DB::table("stok")->where('urun_id',$value["urun_id"])->update(['stok'=>$kontrol->stok-$value["adet"]]);
                $satis = DB::table("product")->where('id',$value["urun_id"])->first();
                $guncelle = DB::table("product")->where('id',$value["urun_id"])->update(['satis_miktari'=>$satis->satis_miktari+$value["adet"]]);
              }
              // eğer stok da sıkıntı yoksa. işlemi yap.

          $ekle = DB::table("siparisler")->insert([
              'user_id'=>Auth::user()->id,
              'urunler'=>json_encode($sepet),
              'toplam_tutar'=>$toplam_ucret,
              'adres_bilgileri'=>$adres,
              'kargo_secenegi'=>$kargo,
              'odeme_yontemi'=>$odeme,
              'taksit'=>$taksit_sayisi,
          ]);
         
          Session::forget('aciklama'); Session::forget('toplam_ucret'); Session::forget('urun_adeti');
          Session::forget('kargo_durumu'); Session::forget('hizli'); Session::forget('sepet'); Session::forget('kupon');
           $sip_id = DB::table("siparisler")->orderBy('id','DESC')->first();
           if($sip_id->user_id == Auth::user()->id){
          return redirect('siparis_detay/'.$sip_id->id)->with(['tur'=>'alert-success','mesaj'=>'Siparişiniz başarıyla oluşturuldu.']);
            }else{
              return redirect('')->with(['tur'=>'alert-danger','success'=>'Bir hata meydana geldi.']);
            }
        } }
    }

    public function siparisler(){

        $siparisler2 = DB::table("siparisler")->where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        $siparisler = [];
          if(count($siparisler2) == 0){
            return redirect('')->with(['tur'=>'alert-danger','mesaj'=>'Herhangi bir siparişiniz bulunamadı.']);
          }else{
            foreach($siparisler2 as $value){
             $value = self::sip_durum($value);
             $value->urunler = (object)json_decode($value->urunler,true);
              $urunler2 = [];
              foreach($value->urunler as $urunler){
                $urunler["extra"] = self::extra($urunler["extra"]);
                $urunler2[$urunler["urun_id"]] = $urunler;
                $urunler2 = array_slice($urunler2,0,2);
              }
              $value->urunler = $urunler2;
             $siparisler[$value->id] = $value;
          }
        return view('sayfa.siparisler')->with('siparisler',$siparisler);
          }
    }

    public function siparis_detay($sip_id){
      $sip_id = parent::temizle($sip_id);
        $data = DB::table("siparisler")->where('id',$sip_id)->first();

          if(empty($sip_id) || count($data) == 0){
            return redirect('siparisler')->with(['tur'=>'alert-danger','mesaj'=>'Sipariş bulunamadı!']);
          }else if(Auth::user()->id != $data->user_id){
            return redirect('siparisler')->with(['tur'=>'alert-danger','mesaj'=>'Siparişe erişiminiz yok.']);
          }else{
            $data->urunler = json_decode($data->urunler,true);
            $adresler = DB::table("adresler")->where('id',$data->adres_bilgileri)->first();
            $data = self::sip_durum($data);
            $urunler = [];
              foreach($data->urunler as $value){
                  $value["extra"] = self::extra($value["extra"]);
                  $urunler[$value["urun_id"]] = $value;
              }
              $data->urunler = $urunler;
              $data->taksit = json_decode($data->taksit,true);
              return view('sayfa.siparis_detay')->with(['data'=>$data,'adresler'=>$adresler]);
          }
    }

    public function kupon_aktif(Request $req){
      $kupon_kodu = parent::temizle($req->kupon_kodu);

      $toplam_ucret = Session::get('toplam_ucret');
      $sepet = Session::get('sepet');
      $sorgu = DB::table("kuponlar")->where('kupon',$kupon_kodu)->first();
      $kupon_durum = Session::get('kupon');
        if(empty($sepet) || empty($kupon_kodu)){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Kupon Kodu girmediniz.']);
        }else if($kupon_durum == "evet"){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Bu sipariş için daha önce kupon kullandınız.']);
        }else if(count($sorgu) == 0){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Kupon Kodu Mevcut Değil.']);
        }else if($sorgu->user_id != 0){
          return redirect('odeme_onayla')->with(['tur'=>'alert-danger','mesaj'=>'Bu Kupon Daha Önce Kullanılmış.']);
        }else{
          Session::forget('kupon'); Session::put('kupon',$sorgu->yuzde);
          DB::table("kuponlar")->where('kupon',$kupon_kodu)->update(['user_id'=>Auth::user()->id]);
           return redirect('odeme_onayla')->with(['tur'=>'alert-success','mesaj'=>'Kupon Etkinleştirildi. <b>İndirim Tutarı %'.$sorgu->yuzde."</b>"]);
        }
    }
}
