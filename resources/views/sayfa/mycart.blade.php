@extends('sayfa.home')
@section('title')Sepetim @endsection
@section('degisken')
      <div class="col-md-12">
        @if($sign == "guest")
          <div class="col-md-9">
            <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
              Üyeliğinize giriş yapmamış görünüyorsunuz. <br> Bir sonraki aşamada   <a href="{{url('giris')}}"><b>Giriş Yapmanız</b></a> yada  <a href="{{url('kayit')}}"><b>Kayıt Olmanız</b></a> gerekecek. <br>

            </div>
          </div>
        @endif
        <div class="col-md-9">
          <div class="panel panel-body">
            <h1 class="page-header text-primary">Sepetim</h1>
            <table class="table table-hover" >
              <thead>
                <td></td>
                <td></td>
                <td></td>
                <td>Fiyat</td>
              </thead>
              <tbody>
              @foreach($sepet as $value)

                <tr>
                  <td><a href="<?php echo url('/');?>/urun_detay/{{$value["urun_id"]}}">
                    <img src="{{$value["resim"]}}" width="100" height="100" alt="{{$value["isim"]}}">
                  </a></td>
                  <td>
                    <h3 class="text-primary" style="margin-top:0px;">
                      <a href="<?php echo url('/');?>/urun_detay/{{$value["urun_id"]}}" title="{{$value["isim"]}}">@if(strlen($value["isim"])>20) {{substr($value["isim"],0,20)}} ... @else {{$value["isim"]}} @endif</a>
                    </h3>
                  @if($stok[$value["urun_id"]]->hizli_teslimat == 2) <h4><span class="glyphicon glyphicon-ok"></span> Hızlı Teslimat</h4>
                  @elseif($stok[$value["urun_id"]]->stok == 0) <h5>Kargoya veriliş süresi: <b style="color:red">5</b> <b> iş günü</b></h5>
                  @else <h5>Kargoya veriliş süresi: <b style="color:red">1</b> <b> iş günü</b></h5> @endif
                    <p>{!!$aciklama[$value["urun_id"]]!!}</p>
                    <p><button class='btn btn-danger sepet_sil' veri="{{$value["urun_id"]}}" adet="{{$value["adet"]}}"><span class='glyphicon glyphicon-remove'></span></button></p>

                  </td>
                  <td> <div class="col-md-5 adet">
        <div class="adet_masaustu">
          <div class="col-md-1 adet-artis">
              <a  href="javascript:void(0)" veri="{{$value["urun_id"]}}" class="text-success arttir ajax">+</a>
          </div>
            <div class="col-md-1">
              <input type="number" name="adet"  class="adet_miktari" min="1" max="100" value="{{$value["adet"]}}">

              Adet
            </div>
            <div class="col-md-1 adet-azalis">
                <a href="javascript:void(0)" veri="{{$value["urun_id"]}}" class="text-danger azalt ajax">-</a>
            </div>
        </div>


        <div class="adet_mobil" style="display:none;line-height:200%;">
          <div class="col-md-1 adet-artis" style="font-size:15px;">
              <a  href="javascript:void(0)" veri="{{$value["urun_id"]}}" class="text-success arttir">{{$value["adet"]}}</a>
          </div>

            <div class="col-md-1" style="margin-left:10%;">
              <input type="number" name="adet"  class="adet_miktari" min="1" max="100" value="1">
              Adet
            </div>
            <div class="col-md-2" style="float:right;font-size:15px;">
                <a href="javascript:void(0)" veri="{{$value["urun_id"]}}" class="text-danger azalt">Azalt</a>
            </div>
        </div>
        </div>
</td>
<td>
  <h4>
    {{$value["fiyat"]}} ₺</h4>
    <?php   ?>
</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-body" style="text-align:right;">
              <h2 class="page-header text-primary">Sipariş Özeti</h2>
              <p style="font-size:20px;">Toplam: <b>{{$urun_adeti}} Ürün</b></p>
              <p style="font-color:#ddd">Ürün Tutarı :</p>
              <h1 style="margin-top:0px;">{{$toplam_ucret}} ₺</h1>
              @if($kargo == "ucretli")
              <p style="color:#333">+5 ₺ kargo ücreti</p>
            @endif
            <div class="bg-primary">
                <h2 style="margin-top:0px;text-align:center;color:white;">Toplam:
                  @if($kargo == "ucretli")
                    {{$toplam_ucret+5}} ₺
                  @else
                    {{$toplam_ucret}} ₺
                  @endif
                </h2>
            </div>
              <button type="button" class="btn btn-primary btn-lg fulle" name="button" onclick="window.location.href='{{url('odeme_onayla')}}'" style="min-height:70px;font-size:25px;"><span class="glyphicon glyphicon-shopping-cart"></span> Alışverişi Tamamla</button>
          </div>
        </div>
      </div>

@endsection
