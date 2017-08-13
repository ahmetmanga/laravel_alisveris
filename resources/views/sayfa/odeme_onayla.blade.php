@extends('sayfa.home')
@section('title')Ödeme @endsection
@section('degisken')

      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-6 panel panel-body">
            <h2 class="text-primary" style="float:left;">Merhaba, {{$isim}} </h2>
</p>
          </div>
          <div class="col-md-3 col-md-offset-3 panel panel-body">
            <h2><a class="pull-right" href="{{url('sepetim')}}"><span class="glyphicon glyphicon-chevron-left"></span> Sepete Dön</a></h2>
          </div>
        <div class="col-md-12 panel panel-body">
          <h2 class="page-header text-primary">Sepetinizdeki Ürünler</h2>
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <td>Ürün</td>
                  <td>Kargoya Veriliş</td>
                  <td>Kargo Seçeneği</td>
                  <td>Adet</td>
                  <td>Toplam</td>
                </tr>
              </thead>
              <tbody>
                @foreach($sepet as $value)

                  <tr>
                    <td>
                      <h4 class="text-primary" style="margin-top:0px;">
                        <a href="<?php echo url('/');?>/urun_detay/{{$value["urun_id"]}}" title="{{$value["isim"]}}">{{$value["isim"]}}</a>
                      </h4>
                    </td>
                    <td>
                    @if($stok[$value["urun_id"]]->hizli_teslimat == 2) <h4><span class="glyphicon glyphicon-ok"></span> Hızlı Teslimat</h4>
                    @elseif($stok[$value["urun_id"]]->stok == 0) <h5>Kargoya veriliş süresi: <b style="color:red">5</b> <b> iş günü</b></h5>
                    @else <h5>Kargoya veriliş süresi: <b style="color:red">1</b> <b> iş günü</b></h5> @endif
                    </td>
                  <td>@if($stok[$value["urun_id"]]->kargo == 1)
                    Ücretsiz Kargo @else
                      Standart Kargo @endif
                  </td>
                  <td class="middle">{{$value["adet"]}}</td>
                  <td>
                    <h4>
                      {{$value["fiyat"]}} ₺</h4>
                      <?php   ?>
                  </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            @if($kargo == "ucretsiz")
              <hr>
              <div class="panel panel-primary panel-body">
                <h4>Sepetinizdeki ürünlerden biri ücretsiz kargo. Sizden kargo ücreti alınmayacaktır.</h4>
              </div>
            @endif
        </div>
        <div class="col-md-12 panel panel-body">
          <h2 class="page-header text-primary">Teslimat Bilgileri <button type="button" data-toggle="modal" data-target="#adres_ekle" class="pull-right btn btn-primary btn-lg" name="button">Yeni Adres Ekle</button></h2>

          <div class="modal fade" id="adres_ekle">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-heading">
                  <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>
                <div class="modal-body">
                  @include('sayfa.adres_ekle_form')
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 panel panel-body adres_sayfa" style="text-align:center; @if(count($adresler) <= 4) display:none; @endif">
        </div>
        <form action="{{url('odeme_onayla')}}" method="post">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
        @foreach($adresler as $value)
          <div class="col-md-6 adresler">
            <div class="panel  panel-body" style="min-height:175px;">
              <h3>{{$value->adress_type}} <input type="radio" class="pull-right adresler_radio" name="adres" value="{{$value->id}}"></h3>
              {!!$value->adress!!}
              <h4>{{$value->ad_soyad}} - {{$value->cep_no}}</h4>
            </div>
          </div>
        @endforeach

            <div class="col-md-12">
              <div class="col-md-5 panel panel-body">
                <h4 class="page-header text-primary">Ödeme Yöntemi</h4>
                <ul class="list-group hover">
          <li class="list-group-item secili">Havale/Eft <input class="input_radio" type="radio" name="odeme" value="0"></li>
          <li class="list-group-item secili"  id="kredi_karti">Kredi Kartı <input class="input_radio" type="radio" name="odeme" value="1"></li>

                </ul>
              </div>
              <div class="col-md-5 col-md-offset-2 panel panel-body">
                <h4 class="page-header text-primary">Kargo</h4>
                <ul class="list-group">
                  <li class="list-group-item secili">Standart Kargo - @if($kargo == "ucretli") <b>5.00 ₺</b> @else <b>Ücretsiz</b> @endif <input type="radio" @if($kargo == "ucretli") fiyat="5" @else fiyat="0" @endif class="input_radio" name="kargo" value="0" @if($hizli != 2) checked @endif></li>
                  @if($hizli == 2) <li class="list-group-item secili">Hızlı Teslimat - <b>10.00 ₺</b> <input type="radio" class="input_radio" fiyat="10" name="kargo" value="1"></li> @endif
                </ul>
              </div>
            </div>
          <div class="col-md-12 panel panel-body" style="display:none;" id="taksit_secenekleri">
            @if($toplam_ucret >= 100)
              <table class="table table-responsive table-hover table-bordered">
                <thead>
                  <tr>
                    <td>Taksitler</td>
                    @foreach($bankalar as $banka)
                      <td>{{$banka->banka_ismi}}</td>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                     @for($i=2;$i<=6;$i++)
                                <tr>
                                  <td>{{$i}} Taksit</td>
                                  @foreach($bankalar as $banka)
                                      <?php $taksit = explode(",",$banka->taksitler); ?>
                                      @if(in_array($i,$taksit))
                                          @if($i>3)
                                            @if($toplam_ucret >= 300)
                                              <?php $aylik_tutar = (round($toplam_ucret/$i+($i*2/$toplam_ucret)*100)); ?>
                                                <td class="secili">Aylık Tutar: <b>{{$aylik_tutar}} ₺</b> Toplam: <u>{{$aylik_tutar*$i }}</u> ₺ <input type="radio" class="input_radio" name="taksit" value="{{$i}}{{$banka->id}}"></td>
                                            @else
                                              <td class="bg-danger"></td>
                                            @endif


                                            @else
                                              <td class="secili">Aylık Tutar: <b>{{round($toplam_ucret/$i)}} ₺</b> Toplam: <u>{{$toplam_ucret }}</u> ₺ <input type="radio" class="input_radio" name="taksit" value="{{$i}}{{$banka->id}}"></td>
                                            @endif
                                        @else
                                            <td class="bg-danger"></td>
                                        @endif
                                  @endforeach
                                </tr>
                     @endfor


                </tbody>
              </table>
            @else
              <h3>Önemli Not</h3>
              <br>
              <h4>Taksitli alışveriş için sipariş tutarınız 100 ₺ ve üzerinde olmalıdır.</h4>
              <h4>300 ₺ altındaki siparişlerinizde en çok 3 taksit imkanından faydalanabilirsiniz.</h4>
            @endif
          </div>
        </div>

        <div class="col-md-3">
        
          <div class="col-md-12">
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
                 <font id="toplam_fiyat">
                  @if($kargo == "ucretli")
                    {{$toplam_ucret+5}} ₺
                  @else
                    {{$toplam_ucret}} ₺
                  @endif</font>
                </h2>
            </div>
              <button type="submit" class="btn btn-primary btn-lg fulle" name="button" onclick="window.location.href='{{url('odeme_onayla')}}'" style="min-height:70px;font-size:25px;">Siparişi Onayla</button>
          </div>
          </div>
           </form>
          {{-- Kupon --}}
          <div class="col-md-12"><div class="panel panel-body">
            <h2 class="page-header text-primary">Kupon Kullan</h2>
                <form method="post" action="{{url('odeme_onayla/kupon')}}">
                  {{csrf_field()}}
                <div class="col-md-12"><input type="text" name="kupon_kodu" class="input input-lg" required placeholder="Kupon Kodu">
               </div> 
               <div class="col-md-12" style="margin-top: 3%;"> <input type="submit" name="kupon_submit" value="Kullan" class="btn btn-primary btn-lg fulle"></div>
                </form>
        </div></div>
        </div>
     
      </div>
@endsection
