<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<!-- Ahmet Manga -->
  	{{ Html::style('public/css/css/bootstrap.css') }}
  	{{ Html::style('public/css/css/bootstrap-theme.css') }}
    {{ Html::style('public/css/css/price.css') }}
  
    {{ Html::style('public/css/css/font-awesome.min.css') }}
  	{{ Html::script('public/css/js/bootstrap.js') }}
  	{{ Html::script('public/js/jquery-3.2.1.js') }}
  	{{ Html::script('public/css/js/bootstrap.min.js') }}
  	{{ Html::script('public/js/site.js') }}
    {{ Html::script('public/js/order.js') }}
    {{ Html::script('public/js/sepet.js') }}
    {{Html::script('code.jquery.com/jquery-1.12.4.js')}}
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

	<meta name="viewport" content="width=device-width; initial-scale=1">
	<title>@yield('title') | Blog</title>
	<script type="text/javascript">
	$(document).ready(function(){
			$(window).scroll(function(){
					var yukseklik = $(this).scrollTop();
					if(yukseklik>50){
						$("#back-to-top").fadeIn();
					}else{
						$("#back-to-top").fadeOut();
					}
			});
			$("#back-to-top").click(function(){
					$("body,html").animate({
						'scrollTop':'0px'
					},800);
					return false;
			});

	});

	</script>
</head>
<body>
<div id="ust_div" class="container-fluid">
	<div class="container-fluid">
   		<div class="row">

   				<nav id="ust" class="navbar navbar-inverse" style="border-top-left-radius:0px;border-top-right-radius:0px;">
   <div class="container-fluid">
     <div class="row">
        <div class="col-md-12">
          <div class="navbar-header">
            <div class="navbar-brand">

              <input type="color" name="renk_sec" value="#ff0000">
            </div>
            <button class="navbar-toggle" data-toggle="collapse" data-target="#ackapa"><div class="icon-bar"></div><div class="icon-bar"></div><div class="icon-bar"></div></button>
          </div>

            <div class="collapse navbar-collapse navbar-static-top" id="ackapa">


            <ul class="nav navbar-nav navbar-right">

          @if($user == 2)
            <li class="active"><a href="#" data-target="#giris_div" data-toggle="modal"><span  class="glyphicon glyphicon-log-in"></span>&nbsp;Giriş Yap</a></li>
          {{--  @if(empty($hata) && empty($errors->all())) --}}
            <li><a href="<?php echo url('/') ?>/kayit" ><span  class="glyphicon glyphicon-user"></span>&nbsp;Kayıt Ol</a></li>
          {{-- @endif --}}

            <li><a href="#" data-target="#sifre_div" data-toggle="modal"><span  class="glyphicon glyphicon-lock"></span>&nbsp;Şifremi Unuttum</a></li>
            <li><p>&nbsp;&nbsp;&nbsp;</p></li>
          @else
            <li><a href="#">Hoşgeldiniz, {{Auth::user()->name}}</a></li>
            <li><a href="{{url('siparisler')}}">Siparişlerim</a></li>
            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Hesabım <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="list-group-item"><a href="{{url('profil/bilgi_duzenle')}}">Bilgileri Düzenle</a></li>
                <li class="list-group-item"><a href="{{url('profil/sifre_islemleri')}}">Şifre İşlemleri</a></li>
                <li class="list-group-item"><a href="{{url('profil/adreslerim')}}">Adreslerim</a></li>
                <li class="list-group-item"><a href="{{url('profil/adres_ekle')}}">Yeni Adres Ekle</a></li>

              </ul>
            </li>
            <li><a href="<?php echo url('/') ?>/logout">&nbsp;Çıkış Yap</a></li>
          @endif
            </ul>
            </div>
        </div>
     </div>

  <div class="row" style="margin-top:10px;">
   <div  id="logo" class="navbar-header col-md-1">
   <a href="{{url('/')}}">logo</a>
 <!--	<img src="Logo" style="margin-top: 10px;"> -->
   </div>
 <div class="masaustu">
   <div class="col-md-7">

       <div class="navbar" style="padding-left:5%;">
         <form action="<?php echo url('/') ?>/ara" id="giris_form" method="get">
           <div class="input-group">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="text" value="@if(!empty($search_data))@foreach($search_data as $value){{str_replace(["'%","%'"],['',''],$value)}},@endforeach @elseif(!empty($ara)){{$ara}}@endif" name="arama" placeholder="İstediğin Ürünleri Ara" class="input input-lg" id="search_input" style="height:55px;">
             <button type="button" class="input-group-addon btn btn-lg btn-default glyphicon glyphicon glyphicon-search" id="search_button" name="button"></button>
           </div>


     </form>
       </div>
     </div>
     <div class="col-md-3">

                 <button class="btn btn-lg btn-primary" style="height: 55px;border-radius:0px;" id="sepet"><span class="glyphicon glyphicon-shopping-cart"></span>
                   @if(count($sepet_composer) == 0)
                      (0) Sepetim | Toplam Tutar : 0 ₺
                    @else
                       ({{count($sepet_composer)}}) Sepetim | Toplam Tutar : {{$toplam_tutar}} ₺
                    @endif
                 </button>

     </div>

 </div>
 <div class="panel panel-primary panel-body" id="sepet_detay" style="position:absolute; z-index:1; width:370px;overflow:hidden;display:none;right:6%;top:90%;">
  <table class="table table-bordered table-responsive table-hover">
    <thead>
      <tr>
        <td>Fiyat</td>
        <td>Ürün</td>
        <td>Adet</td>
        <td></td>
      </tr>
    </thead>
    <tbody id="sepet_data">
  <?php
    if(count($sepet_composer) != 0){
      foreach($sepet_composer as $v){

           echo "<tr>

          <td><h5>".$v["fiyat"]." ₺</h5></td>
          <td title='".substr($v["isim"],0,15)."'> <img src='".$v["resim"]."' width='35' height='35'>  <b><a href='".url('/')."/urun_detay/".$v["urun_id"]."'>".substr($v["isim"],0,15)."</a></b></td>
          <td style='text-align:center;'>".$v["adet"]."</td>
          <td title='İşlem gerçekleşmezse sayfayı yenileyip tekrar deneyin.'><button class='btn btn-danger sepet_sil' veri='".$v["urun_id"]."' adet='".$v["adet"]."'><span class='glyphicon glyphicon-remove'></span></button></td>

           </tr>";

      }

    }
   ?>

    </tbody>

  </table>
<hr />
<div class="col-md-6"><button type="button" name="sepet_bosalt" class="btn btn-danger btn-lg fulle">Sepeti Boşalt</button></div>
<div class="col-md-6"><button type="button" onclick="window.location.href='{{url('sepetim')}}'" name="odemeye_gec" class="btn btn-primary btn-lg fulle" style="float:right;">Ödemeye Geç</button></div>
 </div>
 <div class="mobil" style="display:none;">
   <div class="col-md-10" id="icerik">
       <button type="button" name="button" id="sepet_mobil" class="btn btn-primary" style="float:left;border-radius:0px; ">
         <span id="sepet">@if(count($sepet_composer) == 0)
             Sepet (0)
           @else
           Sepet({{count($sepet_composer)}})</span>
       @endif
       </button>
     <div class="search">
   <form action="<?php echo url('/') ?>/ara" id="giris_form" method="get">
     <input type="text" name="arama" value="@if(!empty($search_data))@foreach($search_data as $value){{str_replace(["'%","%'"],['',''],$value)}},@endforeach @elseif(!empty($ara)){{$ara}}@endif" class="form-control input-sm" placeholder="Arama Yap" />
      <button type="submit" class="btn btn-primary" style="float:right;"><span class="glyphicon glyphicon-search"></span> Ara</button>
    </form>
     </div>


   </div>
 </div>

   </div>
 </div>



  </nav>

             @if($user == 2)
   				<!-- giris -->
				<div class="modal fade" id="giris_div">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header"><h4>Giriş Yap<span class="close"  data-dismiss="modal">&times;</span></h4></div>
							<div class="modal-body">
							@include('sayfa.giris_form')
							</div>
							<div class="modal-footer"><button data-dismiss="modal" class="btn btn-default">Kapat</button></div>
						</div>
					</div>
				</div>

				<!-- Sifre unuttum -->
				<div class="modal fade" id="sifre_div">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header"><h4>Şifremi Unuttum<span class="close"  data-dismiss="modal">&times;</span></h4></div>
							<div class="modal-body">
						          @include('sayfa.unuttum_form')
							</div>
							<div class="modal-footer"><button data-dismiss="modal" class="btn btn-default">Kapat</button></div>
						</div>
					</div>
				</div>
				<!-- bitis -->
      @endif
   			</div>


   			@include('sayfa.category')
   			<div class="row">
   				@yield('sol_bolum')
          @if(session('tur'))
          <div class="col-md-9" id="hata_mesajlari">
            <div class="alert {{ session('tur') }}">
              {!! session('mesaj') !!}
              <a href="#" class="close" data-dismiss="alert">&times;</a>
            </div>
          </div>

          @endif
              @yield('degisken')




        <div class="col-md-12">
          <div class="navbar navbar-inverse">
            <div class="panel-body" style="color:white">
            <span class="glyphicon glyphicon-registration-mark"></span>
            <a target="_blank" href="http://ahmetmanga.net">AhmetManga.Net</a> Blog - 2017
            <div class="navbar-right"><span class="badge">v1.0 Beta</span>&nbsp;&nbsp;
             </div>

          </div>
        </div>
        </div>

   				<div class="col-md-12" style="height: 100px">

   				</div>
   				<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"><span class="glyphicon glyphicon-chevron-up"></span></a>

   			</div>
   		</div>
</div>
</div>
{{ Html::script('public/js/arkaplan.js')}}
<script>

var hesapla = function(){
  var genislik = $(window).width();
if(genislik > 750){
    $(".masaustu").show();
    $(".mobil").hide();
    $(".kat_desktop").css('display','block');
    $(".kat_mobil").css('display','none');
    $(".adet_masaustu").css('display','block');
    $(".adet_mobil").css('display','none');
    $("#urun_detay_tab").children().addClass('tab_panel');
}else{
  $(".masaustu").hide();
  $(".mobil").show();
  $(".kat_desktop").css('display','none');
  $(".kat_mobil").css('display','block');
  $(".adet_masaustu").css('display','none');
  $(".adet_mobil").css('display','block');
  $("#urun_detay_tab").children().removeClass('tab_panel');

}
}
setInterval(hesapla,100);
</script>
</body>
</html>
