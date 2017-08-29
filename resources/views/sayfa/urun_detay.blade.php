@extends('sayfa.home')
@section('title'){{$data->name}} @endsection
@section('degisken')
  <div class="modal fade" id="yorum_yap">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-heading">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
          </div>
          <div class="modal-body">
            @include('sayfa.yorum')
          </div>
      </div>
    </div>
  </div>
<div class="col-md-12">
  @if(!empty($errors))
      @foreach($errors->all() as $error)
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
            {{$error}}
        </div>
      @endforeach
  @endif
  <div class="panel panel-body" style="border-radius:0px;">
    <div class="col-md-6">
      <div class="carousel slide" data-ride="carousel" id="urun_slayt">
          <ol class="carousel-indicators" style="bottom:0;">
            <?php $image = explode("*resim*",$data->resim); ?>
           @if(strpos($data->resim,"*resim*"))
              @for($i=0;$i<count($image);$i++)
                  <li data-target="#urun_slayt" @if($i==0) class="active" @endif data-slide-to="{{$i}}"></li>
              @endfor
           @else
               <li data-target="#urun_slayt" class="active" data-slide-to="0"></li>
          @endif
              </ol>
              <div class="carousel-inner">

                @if(strpos($data->resim,"*resim*"))
                   @for($i=0;$i<count($image);$i++)
                     <div class="item @if($i== 0) active @endif">
        <a  data-target="#{{$i}}" data-toggle="modal"><img style="margin-left:10%;" width="500" height="500" src="{{$image[$i]}}" alt="{{$data->name}}"></a>

                     </div>

                   @endfor
                @else
                  <div class="item active">
     <a href="#" data-target="#1" data-toggle="modal"><img style="margin-left:10%;" src="{{$data->resim}}" width="500" height="500" alt="{{$data->name}}"></a>

                  </div>
               @endif


              </div>
        <a href="#urun_slayt" class="carousel-control left" style="width:7%;" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
        <a href="#urun_slayt" class="carousel-control right" style="width:7%;" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>

      </div>
      @if(strpos($data->resim,"*resim*"))
        @for($i=0;$i<count($image);$i++)
          <div class="modal fade" id="{{$i}}">
              <div class="modal-dialog" style="width:800px;height:800px;">
                <div class="modal-content">
                  <div class="modal-header">
                  <a href="#" class="close" data-dismiss="modal">&times;</a>
                  </div>
                    <div class="modal-body">
                      <img src="{{$image[$i]}}" width="775" height="775" alt="{{$data->name}}">
                    </div>

                </div>
              </div>
          </div>
        @endfor
      @else
        <div class="modal fade" id="1">
            <div class="modal-dialog" style="width:800px;height:800px;">
              <div class="modal-content">
                <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>
                  <div class="modal-body">
                    <img src="{{$data->resim}}" width="775" height="775" alt="{{$data->name}}">
                  </div>

              </div>
            </div>
        </div>
      @endif
    </div>
    <div class="col-md-6" style="background-color:#ddd;height:100%;">
      <div class="row">
        <div class="col-md-12">
          <h3>{{$data->name}}</h3>
          <a class="text-primary" style="font-weight:bold;margin-top:2%;" href="{{ url('category/'.$kat->id) }}">{{$kat->name}}</a>
        </div>
      </div>
    <div class="row">
      <div class="col-md-6" style="margin-top:5%;">

      @if($data->old_price != 0.00)
        <div class="fiyat_anadiv fiyat_anadiv-buyuk">
            <div class="indirim indirim-buyuk">
              %{{ round(100 - (($data->price/$data->old_price)*100)) }}
            </div>
            <div style="float:right; margin-right:5px;">

                <div class="old_price old_price-buyuk">
                {{$data->old_price}} ₺
                </div>
                <div class="price price-buyuk">
                 {{$data->price}} ₺
                </div>

            </div>
        </div>
      @else
        <div class="price price-buyuk">
          {{$data->price}}
        </div>
    @endif

      </div>
      <div class="col-md-5 col-md-offset-1 puan_renk" id="puanla" style="margin-top:5%;">
        <?php   $ratings = floor($data->ratings); ?>
          <h4><a href="#" data-toggle="modal" data-target="#yorum_yap">Yorum Yap</a> | <a href="#urun_detay_tab">Yorumlar ({{$yorum_sayisi}})</a></h4>
          <h3 class="puan_renk">
          @for($i=0;$i<$ratings;$i++)
            <span class="glyphicon glyphicon-star"></span>
          @endfor
          @for($i=0;$i<5-$ratings;$i++)
            <span class="glyphicon glyphicon-star-empty"></span>
          @endfor
</h3>


      </div>
    </div>
    <hr>
    {{--<form id="sepet" method="post" onsubmit="return sepet_ekle();"> --}}
      <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="urun_id" value="{{ $data->id}}">
    <div class="row" style="margin-top:6%;">
      <div class="col-md-12">
      @if($data->view != 0 && $stok->stok > 0)
        <div class="col-md-3 adet">
          <div class="adet_masaustu">
            <div class="col-md-1 adet-artis">
                <a  href="javascript:void(0)" class="text-success arttir">+</a>
            </div>
              <div class="col-md-1" style="margin-left:10%;">
                <input type="number" name="adet" class="adet_miktari" min="1" max="100" value="1">
                Adet
              </div>
              <div class="col-md-1 adet-azalis">
                  <a href="javascript:void(0)" class="text-danger azalt">-</a>
              </div>
          </div>

          {{-- Mobil --}}
          <div class="adet_mobil" style="display:none;line-height:200%;">
            <div class="col-md-1 adet-artis" style="font-size:15px;">
                <a  href="javascript:void(0)" class="text-success arttir">Arttır</a>
            </div>

              <div class="col-md-1" style="margin-left:10%;">
                <input type="number" name="adet" class="adet_miktari" min="1" max="100" value="1">
                Adet
              </div>
              <div class="col-md-2" style="float:right;font-size:15px;">
                  <a href="javascript:void(0)" class="text-danger azalt">Azalt</a>
              </div>
          </div>
          </div>
          <div class="col-md-4 col-md-offset-1" >
            <button type="button" name="sepete_ekle" class="btn btn-lg fulle btn-primary" style="min-height:50px;">
              <span class="glyphicon glyphicon-shopping-cart"></span> Sepete Ekle</button>
          </div>
        @else
          <button type="button" class="btn btn-primary btn-lg" disabled name="button">Stokta Yok</button>
          <h4>Bu ürün geçici olarak temin edilemiyor.</h4>
        @endif

      </div>
    </div>
{{-- kargo bilgileri --}}
    <div class="row" style="margin-top:5%;margin-bottom:2%;">
      @if($data->view != 0)
        <div class="col-md-12">
          @if($stok->stok < 20 && $stok->stok != 0)
            <h4 style="font-weight:bold;">Bu ürün hızla tükeniyor! <br> <br> Kalan adet: <font color="red">{{$stok->stok}}</font></h4>
          @endif
    </div>
  @endif
        @if($data->view != 0)
          <div class="col-md-12">
            @if($stok->stok == 0)
              <h5>Tahmini Kargoya Veriliş Süresi : <b>5 İş Günü</b></h5>
            @else
              <h5>Tahmini Kargoya Veriliş Süresi: <b>1 İş Günü</b></h5>
            @endif
      </div>
    @endif

          <?php
            if(strpos($data->color_type,"**")){
              $ex = explode("**",$data->color_type);
              echo "
                          <div class='col-md-12' style='margin-top:5%;margin-bottom:5%;'>
                            <select name='extra' class='input input-lg'><option>Renk Seçiniz</option>";
                      for($i=0;$i<count($ex);$i++){
                        echo "<option value=".$i.">".str_replace(['--','//'],[' ',' '],$ex[$i])." ₺</option>";
                      }
                      echo "</select> </div>";
                      }
           ?>




      <div class="col-md-12" style="margin-bottom:5%;">
        @if($stok->kargo == 1)
            <img src="http://design.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/kargo_bedava.png" alt="Kargo Bedava">
          @endif
          @if($stok->stok > 100)
            <img src="http://design.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/fast_shipping.png" alt="Süper Hızlı">
          @endif
        @if($stok->hizli_teslimat == 2)
            <img src="https://images.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/icon_1497508515143.png" alt="Hızlı Teslimat">
         @endif

      </div>
    </div>

    </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-body" style="border-radius:0px;">
      <ul class="nav nav-tabs" id="urun_detay_tab">
      				<li class="active"><a href="#1" data-toggle="tab">Ürün Açıklaması</a></li>
      				<li><a href="#2" data-toggle="tab">Kampanyalar</a></li>
      				<li><a href="#3" data-toggle="tab">Yorumlar ({{$yorum_sayisi}})</a></li>
      				<li><a href="#4" data-toggle="tab">Taksit</a></li>
              <li><a href="#5" data-toggle="tab">İade Koşulları</a></li>
      			</ul>
            <div class="tab-content">
            				<div id="1" class="tab-pane fade panel-body in active ">
                        {!!$data->comment!!}
            				</div>
            				<div id="2" class="tab-pane fade panel-body">
            					Eklenecek.
            				</div>
            				<div id="3" class="tab-pane fade panel-body">
                         <div class="col-md-3"><h2 class="page-header"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#yorum_yap" name="button">Yorum Yap</button></h2></div>
                         @if($yorum_sayisi>10)
                         <div class="col-md-4 col-md-offset-5">
                           <h2 class="page-header"><a href="{{url('urun_detay/yorumlar')}}/{{$data->id}}" class="btn btn-lg btn-primary fulle" style="min-height:40px;">Tüm Yorumları Oku</a></h2>
                         </div>
                         @endif

                         @if(count($yorumlar) == 0) <h2>Bu ürün için hiç yorum yapılmamış!</h2> @else
                             @foreach($yorumlar as $yorum)
                               <div class="row">
                                 <div class="col-md-12">
                                   <div class="col-md-4">
                                   <h2> {{$yorum->yorum_baslik}}</h2>
                                 </div>
                                 <div class="col-md-4" style="color:#919191;">
                                  <span class="glyphicon glyphicon-user"></span> {{substr($yorum->user_id,0,strlen($yorum->user_id)/2)}} -  <span class="glyphicon glyphicon-time"></span> {{$yorum->created_at}}
                                 </div>
                                 <div class="col-md-4 puan_renk">

                                     @for($i=0;$i<$yorum->puan;$i++)
                                       <span class="glyphicon glyphicon-star"></span>
                                     @endfor
                                     @for($i=0;$i<5-$yorum->puan;$i++)
                                       <span class="glyphicon glyphicon-star-empty"></span>
                                     @endfor

                                 </div>
                                 </div>
                               </div>
                                <br>
                                {!!$yorum->yorum!!}

                                <hr>
                             @endforeach
                         @endif

                    </div>
            				<div id="4" class="tab-pane fade panel-body">
            					@if($data->price >= 100)
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
                                                      @if($data->price >= 300)
                                                        <?php $aylik_tutar = (round($data->price/$i+($i*2/$data->price)*100)); ?>
                                                          <td>Aylık Tutar: <b>{{$aylik_tutar}} ₺</b> Toplam: <u>{{$aylik_tutar*$i }}</u> ₺</td>
                                                      @else
                                                        <td class="bg-danger"></td>
                                                      @endif


                                                      @else
                                                        <td>Aylık Tutar: <b>{{round($data->price/$i)}} ₺</b> Toplam: <u>{{$data->price }}</u> ₺</td>
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
                    <div id="5" class="tab-pane fade panel-body">
                      İncelediğiniz ürün, doğrudan üretici firma tarafından size kargoyla gönderilecektir. İade işlemlerinizi aşağıdaki şekilde yapmalısınız: <br />

Ürünün adresinize teslim tarihinden itibaren 14 gün içinde "Sipariş Takibi" sayfasından "İade ve Geri gönderim" başvurusunda bulunarak iade sürecinizi başlatabilirsiniz. <br>

Başvurunuz sonrasında “Hesabım” sayfasında bulunan başvuru takibi bölümünde gösterilen kargo gönderi kodu ile göndermeniz gerekmektedir. İadenizin kabul edilmesi için, ürünün hasar görmemiş ve kullanılmamış olması gerekmektedir. <br>

İade etmek istediğiniz ürün, tarafımızdan üretici firmaya ulaştırılacak ve iade işlemleriniz Hepsiburada.com tarafından takip edilecektir. <br>

Daha detaylı bilgi için Yardım sayfasını ziyaret edebilirsiniz. <br>

* Bedel İadesi: İade işlemi sonuçlandıktan sonra bedel ödemesi kredi kartınıza/banka hesabınıza 24 saat içinde yapılmaktadır. Ödeme işlemlerinin hesabınıza yansıma süresi bankanıza göre değişkenlik gösterebilir. <br>
                    </div>
            			</div>

    </div>
  </div>
  <div class="col-md-12">
      <div class="panel panel-body">
          <h2 class="page-header"><a href="{{url('category')}}/{{$kat->id}}">{{$kat->name}}</a> Kategorisindeki Çok Satanlar</h2>
            <table class="table  table-responsive">
                    <tbody>
                      @foreach($cok_satilanlar as $value)
                                <tr>
                                  <td><img src="{{$value->resim}}" width="50" height="50"></td>
                                  <td><h3><a href="{{url('urun_detay')}}/{{$value->id}}">{{$value->name}}</a></h3></td>
                                  <td><div class="progress">
                                    <div class="progress-bar" style="width: @if($value->satis_miktari<10)
                                              {{$value->satis_miktari*2}}px; @else {{$value->satis_miktari}}px; @endif
                                     "><b>{{$value->satis_miktari}}</b></div></div></td> 
                                </tr>
                      @endforeach
                    </tbody>
            </table>  

       </div>              
  </div>
@endsection
