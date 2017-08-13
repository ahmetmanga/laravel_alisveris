@extends('sayfa.home')
@section('title')Siparişler @endsection

@section('degisken')
	<div class="col-md-12 panel panel-body">
				
				<table id="siparisler" class="table table-bordered"  style="margin-left:5%;width:90%">
					<tbody>
						@foreach($siparisler as $value)
						<tr class="adresler">
							<td>
								<div class="col-md-12"  style="min-height: 250px;border:1px solid #ddd;text-align:center;">
									<div class="col-md-2">
									<div class="col-md-12"><h5 class="text-muted">Sipariş Tarihi</h5><h5> {{$value->created_at}}</h5></div>
								<div class="col-md-12"><h4>Sipariş No <b>1{{$value->id}}</b></h4></div>
								<div class="col-md-12"><h4 class="text-primary">{{$value->user_id}}</h4></div>
								<div class="col-md-12"><h4>Adres</h4></div>
								<br>
								<div class="col-md-12">{!!substr($value->adres_bilgileri,0,50)!!}...</div>
								<div class="col-md-12"><h4>Toplam Tutar</h4><h4> <b>{{$value->toplam_tutar}} ₺</b></h4></div>	
								</div>
							
								<div class="col-md-8" style="min-width: 50px;min-height: 300px;">
									<h3 style="text-align: left;">Sipariş Durumu : {!!$value->siparis_durumu!!}</h3>
									<table class="table table-responsive table-bordered" style="margin-top: 2%;">
										<tbody>
											@foreach($value->urunler as $urun)
												<tr>
													<td><img src="{{$urun["resim"]}}" width="100" height="100"></td>
													<td><h3><a href="{{url('urun_detay')}}/{{$urun["urun_id"]}}">{{$urun["isim"]}}</a></h3></td>
													<td style="vertical-align: middle;">{!!$urun["extra"]!!}</td>
												</tr>			
											@endforeach
										</tbody>
									</table>
										

								</div>
								<div class="col-md-2">
									<a style=" margin-top:50%;" href="{{url('siparis_detay')}}/{{$value->id}}" class="btn btn-primary btn-lg fulle">Sipariş Detayları</a>
									<a style=" margin-top:25%;" href="#" class="btn btn-primary btn-lg fulle">İade Et</a>
								</div>
								</div>
								
							</td>
						</tr>
						@endforeach

					</tbody>

				</table>
				<br>
		<div class="col-md-12 adres_sayfa" style="text-align: center;"></div>
		
	</div>
@endsection