<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use View,Auth,Session;
use DB,App\User;
use Hash,Mail;
class UserController extends Controller
{
    //
    public function adres_dogrula($form_array){
       
    $form_kural = [
      'name'=>'min:10|max:75|required',
      'tc_no'=>'required|min:11|numeric',
      'phone_number'=>'required|min:10|numeric',
      'adres_basligi'=>'required|max:100',
      'il'=>'required|numeric',
      'ilce'=>'required|numeric',
      'adres'=>'required|min:10|max:250'
    ];
    $form_hata = [
      'name.required'=>'İsim Soyisim yazmadınız.',
      'tc_no.required'=>'TC Kimlik Numaranızı yazmadınız.',
      'phone_number.required'=>'Telefon Numarası Yazmadınız.',
      'adres_basligi.required'=>'Adres için bir tanım vermediniz.',
      'il.required'=>'İl seçmediniz.',
      'ilce.required'=>'İlçe seçmediniz.',
      'adres.required'=>'Adres yazmadınız.',
      'name.min'=>'İsim alanı en az 10 karakter olmalı.',
      'phone_number.min'=>'Telefon Numarası en az 10 karakter olmalı.',
      'adres.min'=>'Adres açıklaması en az 10 karakter olmalı.',
      'tc_no.min'=>'TC Kimlik Numarası 11 karakter olmalı.',
      'name.max'=>'İsim alanı en fazla 75 karakter olabilir.',
      'il.numeric'=>'İlçe yanlış girildi.',
      'ilce.numeric'=>'İlçe yanlış girildi.',
      'adres_basligi.max'=>'Adres başlığı en fazla 100 karakter olabilir.',
      'adres.max'=>'Adres en fazla 250 karakter olabilir.',
      'tc_no.numeric'=>'TC Kimlik Numarası Sayı Olmalı.'
    ];

      $form_result = Validator::make($form_array,$form_kural,$form_hata);
      return $form_result;
    }
    public function signup(Request $req){
    if(Auth::check()){
      return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Üye girişi yapmış durumdasınız. Şuan bu işlemi yapamazsınız.']);
    }else{
      $form_array = [
       'name'=>parent::temizle($req->input('name')),
       'surname'=>parent::temizle($req->input('surname')),
       'email'=>parent::temizle($req->input('email')),
       'phone_number'=>parent::temizle($req->input('phone_number')),
       'password'=>parent::temizle($req->input('password')),
       'password_confirmation'=>parent::temizle($req->input('password_confirmation')),
     ];

     $form_kural = [
       'name'=>'min:2|max:30|required',
       'surname'=>'min:2|max:30|required',
       'email'=>'min:10|max:50|required|email|unique:users',
       'password'=>'required|min:8',
       'password_confirmation'=>'required|min:8',
       'phone_number'=>'required|min:10|min:11|numeric'
        ];

        $form_mesaj = [
          'name.required'=>'İsim boş bırakılamaz.',
          'surname.required'=>'Soyisim boş bırakılamaz.',
          'surname.min'=>'Soyisim hatalı girildi.',
          'surname.max'=>'Soy isim çok uzun.',
          'email.required'=>'E-mail boş bırakılamaz.',
          'password.required'=>'Şifre boş bırakılamaz.',
          'password_confirmation.required'=>'Şifrenizi doğrulamadınız.',
          'phone_number.required'=>'Telefon numarası girmediniz.',
          'name.min' => 'İsim minimum 10 karakter olmak zorunda.',
          'email.min'=>'E-mail minimum 10 karakter olmak zorunda.',
          'password.min'=>'Şifreniz minimum 8 karakter olmalı.',
          'password_confirmation.min'=>'Şifre tekrarınız 8 karakter olmalı.',
          'phone_number.min'=>'Telefon numaranız istenilen formatta değil.',
          'name.max'=>'İsim maximum 75 karakter olabilir.',
          'email.max'=>'E-mail adresi maximum 50 karakter olabilir.',
          'phone_number.max'=>'Telefon numaranız 11 karakterden büyük olamaz.',
          'phone_number.numeric'=>'Telefon numaranız sadece rakam içerebilir',
          'email.email'=>'E-mail istenilen formatta değil.',
          'email.unique'=>'Bu mail adresiyle sistemde üyelik mevcut.'
        ];
        $result = Validator::make($form_array,$form_kural,$form_mesaj);
        if(parent::temizle($req->input('password')) != parent::temizle($req->input('password_confirmation'))){
          return view('sayfa.kayit')->with('hata','Girilen şifreler birbiriyle uyuşmuyor.');
        }else if($result->fails()){
          return view("sayfa.kayit")->with('veri',$form_array)->withErrors($result->errors());
        }else{
        
          $ekle = DB::table("users")->insert([
            'name'=>ucwords($form_array["name"]." ".$form_array["surname"]),
            'email'=>$form_array["email"],
            'phone_number'=>$form_array["phone_number"],
            'password'=>bcrypt($form_array["password"])
            ]);
          
          /*
          Mail::send('mail.yeni_kayit',['isim'=>$form_array["name"]],function($message) use ($form_array){
            $message->from('manga.ahmet@yandex.com.tr','Ahmet Manga');
            $message->to($form_array["email"],$form_array["name"])->subject('Yeni Kayıt');
          });
          */
          
          return redirect('/')->with(['tur'=>'alert-success', 'mesaj'=>'Üyeliğiniz oluşturuldu. Hesabınıza giriş yapabilirsiniz.']);
        }
      }

    }

    // login
    public function login(Request $gelen){
    if(Auth::check()){
          return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Üye girişi yapmış durumdasınız. Şuan bu işlemi yapamazsınız.']);
    }else{

      $form = ['email' => parent::temizle($gelen->input("email-login")), 'password' => parent::temizle($gelen->input("password-login"))];
      $form_kural = ['email'=>'required|email', 'password'=>'required'];
      $hata_mesaji =  ['email.required'=>'Email adresinizi girmediniz.', 'password.required'=>'Şifrenizi girmediniz.','email.email'=>'Email uygun formatta değil.'];
      $result = Validator::make($form,$form_kural,$hata_mesaji);
      if($result->fails()){
        return view('sayfa.giris')->withErrors($result->errors());
      }else if(Auth::attempt($form)){
          Session::put('timeout',time());
          return redirect('/')->with(['tur'=>'alert-success', 'mesaj'=>'Başarıyla Giriş Yapıldı']);
        }else{

          return redirect('giris')->with(['tur'=>'alert-danger','mesaj'=>'E-mail adresi veya şifre hatalı.']);

        }
      }
    }
    public function adres_ekle(){
        $iller  = DB::table("iller")->orderBy('isim','ASC')->get();
        return view('sayfa.adres_ekle')->with(['iller'=>$iller]);
    }
    public function adres_eklendi(Request $req){
          $form_array = [
          'name'=>parent::temizle($req->name),
          'tc_no'=>parent::temizle($req->tc_no),
          'phone_number'=>parent::temizle($req->phone_number),
          'adres_basligi'=>parent::temizle($req->adres_basligi),
          'il'=>parent::temizle($req->il),
          'ilce'=>parent::temizle($req->ilce),
          'adres'=>parent::temizle($req->adres)
        ];
        $form_result = self::adres_dogrula($form_array);
      if($form_result->fails()){
            return redirect()->back()->with('veri',$form_array)->withErrors($form_result->errors());
      }else if($form_array["il"]>= 1 && $form_array["il"]<=81){
          $il = DB::table("iller")->where('il_no',$form_array["il"])->first();
          $ilce = DB::table("ilceler")->where('ilce_no',$form_array["ilce"])->first();
          if(count($ilce) == 0 || count($il) == 0){
            return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Bilgiler bulunamadı.']);
          }else{
            $adres = $form_array["adres"]."<br />".$ilce->isim."/".$il->isim;
            $ekle = DB::table("adresler")->insert(['user_id'=>Auth::user()->id,
            'adress'=>$adres,'adress_type'=>$form_array["adres_basligi"],'ad_soyad'=>$form_array["name"],'tc_no'=>$form_array["tc_no"],'cep_no'=>$form_array["phone_number"]]);
            return redirect('profil/adreslerim')->with(['tur'=>'alert-success','mesaj'=>'Adresiniz başarıyla eklendi.']);
          }
        }
        return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Bir hata meydana geldi.']);
      }

      public function adresler(){
        $adresler = DB::table("adresler")->where('user_id',Auth::user()->id)->where('yayin',1)->orderBy('id','DESC')->get();
        return view('sayfa.adresler')->with('adresler',$adresler);
      }
      public function adres_sil($adres_id){
        $adres_id = parent::temizle($adres_id);
        $sorgu = DB::table("adresler")->where('id',$adres_id)->first();
          if(empty($adres_id) || !is_numeric($adres_id)){
            return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı.']);
          }else if($sorgu->user_id != Auth::user()->id){
            return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı.']);
          }else{
            $sil = DB::table("adresler")->where('id',$adres_id)->update(['yayin'=>0]);
            return redirect('profil/adreslerim')->with(['tur'=>'alert-success','mesaj'=>'Adres silindi.']);
          }
      }
      public function adres_duzenle($adres_id){
        $adres_id = parent::temizle($adres_id);
        $sorgu = DB::table("adresler")->where('id',$adres_id)->first();
          if(empty($adres_id) || !is_numeric($adres_id)){
           return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı.']);
          }else if($sorgu->user_id != Auth::user()->id){
            return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı.']);
          }else{
           $iller  = DB::table("iller")->orderBy('isim','ASC')->get();
            return view('sayfa.adres_ekle')->with(['veri'=>$sorgu,'iller'=>$iller,'duzenle'=>'duzenle']);
          }
      }
      public function adres_duzenle_post(Request $req){
         $form_array = [
          'name'=>parent::temizle($req->name),
          'tc_no'=>parent::temizle($req->tc_no),
          'phone_number'=>parent::temizle($req->phone_number),
          'adres_basligi'=>parent::temizle($req->adres_basligi),
          'il'=>parent::temizle($req->il),
          'ilce'=>parent::temizle($req->ilce),
          'adres'=>parent::temizle($req->adres)
        ];
          $adres_id = $req->adres_id;
          $sorgula = DB::table("adresler")->where('id',$adres_id)->first();
         $form_result = self::adres_dogrula($form_array);
      if($form_result->fails()){
            return redirect()->back()->with('veri',$form_array)->withErrors($form_result->errors());
      }else if($form_array["il"]>= 1 && $form_array["il"]<=81){
          $il = DB::table("iller")->where('il_no',$form_array["il"])->first();
          $ilce = DB::table("ilceler")->where('ilce_no',$form_array["ilce"])->first();
          if(count($ilce) == 0 || count($il) == 0){
            return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Bilgiler bulunamadı.']);
          }elseif(empty($adres_id) || !is_numeric($adres_id)){
             return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı!']);
          }elseif($sorgula->user_id != Auth::user()->id || count($sorgula) == 0){
            return redirect('profil/adreslerim')->with(['tur'=>'alert-danger','mesaj'=>'Adres bulunamadı!']);
          }else{
             $adres = $form_array["adres"]."<br />".$ilce->isim."/".$il->isim;
            $ekle = DB::table("adresler")->where('id',$sorgula->id)->update(['user_id'=>Auth::user()->id,
            'adress'=>$adres,'adress_type'=>$form_array["adres_basligi"],'ad_soyad'=>$form_array["name"],'tc_no'=>$form_array["tc_no"],'cep_no'=>$form_array["phone_number"]]);
            return redirect('profil/adreslerim')->with(['tur'=>'alert-success','mesaj'=>'Adresiniz başarıyla eklendi.']);
          }
        }
        return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Bir hata meydana geldi.']);
      }

      public function bilgi_duzenle(){

          $bilgiler = DB::table("users")->where('id',Auth::user()->id)->first();
          return view('sayfa.bilgi_duzenle')->with(['value'=>$bilgiler]);
      }
       public function bilgi_duzenle_form(Request $req){
        $form_array = [
       'name'=>parent::temizle($req->input('name')),
       'phone_number'=>parent::temizle(trim($req->input('phone_number'))),
       'password'=>parent::temizle($req->input('password')),
     ];
      $form_rule = ['name'=>'required|min:2|max:30','email'=>'email|min:5|max:30|unique:users','password'=>'required','phone_number'=>'min:10|required|numeric'];
      $form_mesaj = [
          'name.required'=>'İsim boş bırakılamaz.',
          'password.required'=>'Şifre boş bırakılamaz.',
          'phone_number.required'=>'Telefon numarası girmediniz.',
          'name.min' => 'İsim minimum 10 karakter olmak zorunda.',
          'phone_number.min'=>'Telefon numaranız istenilen formatta değil.',
          'name.max'=>'İsim maximum 75 karakter olabilir.',
          'phone_number.max'=>'Telefon numaranız 12 karakterden büyük olamaz.',
          'phone_number.numeric'=>'Telefon numaranız sadece rakam içerebilir'
      ];

            
        $sorgula = DB::table("users")->where('id',Auth::user()->id)->first();
        $validator = Validator::make($form_array,$form_rule,$form_mesaj);
          if($validator->fails()){
            return redirect('profil/bilgi_duzenle')->withErrors($validator->errors())->withInput();
          }else if(Hash::check($form_array["password"], $sorgula->password)){
            $ekle = DB::table("users")->where('id',Auth::user()->id)->update(['name'=>$form_array["name"],'phone_number'=>$form_array["phone_number"]]);
            return redirect('')->with(['tur'=>'alert-success','mesaj'=>'Bilgileriniz sistemde başarıyla güncellendi.']);
          }else{
            return redirect('profil/bilgi_duzenle')->with(['tur'=>'alert-danger','mesaj'=>'Girilen şifre uyuşmuyor.','value',$sorgula]);
          }
      }

        public function sifre_islemleri(Request $req){
          $form_array = ['old_password'=>parent::temizle($req->old_password),'password'=>parent::temizle($req->password),
          'password_confirmation'=>parent::temizle($req->password_confirmation)];
          $form_kural = ['old_password'=>'required|min:8','password'=>'required|min:8','password_confirmation'=>'required|min:8'];

          $form_mesaj = ['old_password.required'=>'Eski şifrenizi yazmadınız.','password.required'=>'Şifre yazmadınız.',
          'password_confirmation.required'=>'Tekrar şifreyi yazmadınız.','old_password.min'=>'Eski şifreniz 8 karakterden küçük değildi.','password.min'=>'Yeni şifreniz 8 karakterden küçük olamaz.','password_confirmation.min'=>'Yeni Şifreniz 8 karakterden küçük olamaz.'];
          $dogrula = Validator::make($form_array,$form_kural,$form_mesaj);
          $sorgu = DB::table("users")->where('id',Auth::user()->id)->first();
          if($dogrula->fails()){
            return redirect()->back()->withErrors($dogrula->errors())->withInput();
          }elseif($form_array["password"] != $form_array["password_confirmation"]){
            return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Girilen şifreler eşleşmiyor.']);
          }else if(Hash::check($form_array["old_password"], $sorgu->password)){
            $update = DB::table("users")->where('id',Auth::user()->id)->update(['password'=>bcrypt($form_array["password"])]);
            return redirect('')->with(['tur'=>'alert-success','mesaj'=>'Şifreniz değiştirildi.']);
          }else{
            return redirect()->back()->with(['tur'=>'alert-danger','mesaj'=>'Girdiğiniz şifre mevcut şifrenizle uyuşmadı.']);
          }
        }
     
    }
