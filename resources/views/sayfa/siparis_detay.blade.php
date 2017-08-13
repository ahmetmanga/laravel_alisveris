@extends('sayfa.home')
@section('title')Sipariş Detayı@endsection
@section('degisken')
	
		<div class="col-md-12">
					<div class="col-md-12 panel panel-body">
					<h2 class="page-header" style="color:#666666;margin-top: 0px;"><span class="glyphicon glyphicon-chevron-right"></span> Sipariş Detayları</h2>
						<table class="table table-responsive table-bordered">
							<tbody>
								<tr style="vertical-align: middle;">
									<td><h5>Sipariş No</h5><h4>{{$data->id}}</h4></td>
									<td><h5>Tarih</h5><h4>{{$data->created_at}}</h4></td>
									<td><h5>Ödeme Şekli</h5><h4>{{$data->odeme_yontemi}} @if($data->odeme_yontemi == "Kredi Kartı") | <b>{{$data->taksit["banka"]}} {{$data->taksit["taksit"]}} Taksit</b> @endif</h4></td>
									<td><h5>Sipariş Durumu</h5><h4><b>{!!$data->siparis_durumu!!}</b></h4></td>
									<td><h5>Toplam Tutar</h5><h3><b>{{$data->toplam_tutar}} ₺</b></h3></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-md-12 panel panel-body">
						<table class="table table-responsive table-bordered table-hover">
							<tbody>
								<tr>
								@foreach($data->urunler as $value)
									<tr>
									<td class="middle"><img src="{{$value["resim"]}}" width="100" height="100"></td>
									<td class="middle">
									<p><a href="{{url('urun_detay')}}/{{$value["urun_id"]}}" class="text-primary">{{$value["isim"]}}</a></p>
									<p>{{$value["adet"]}} Adet | <b>{!!$data->siparis_durumu!!}</b></p>
									</td>
									<td class="middle"><a href="{{url('urun_detay')}}/{{$value["urun_id"]}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-comment"></span> Yorum Yazın</a></td>
									<td class="middle">{!!$value["extra"]!!}</td>
									<td class="middle"><h4><b>{{$value["fiyat"]}} ₺</b></h4></td>
								</tr>
								 @endforeach
							</tbody>
						</table>
					</div>

				<div class="col-md-6 panel panel-body">
					<table class="table table-responsive table-bordered table-condensed">
						<tr  colspan="1">
							<td><h4>İsim Soyisim</h4></td>
							<td><h4><b>{{$adresler->ad_soyad}}</b></h4></td>
						</tr>
						<tr>
							<td><h4>Adres Başlığı</h4></td>
							<td><h4><b>{{$adresler->adress_type}}</b></h4></td>
						</tr>
						<tr>
							<td><h4>Adres</h4></td>
							<td><h4><b>{!!$adresler->adress!!}</b></h4></td>
						</tr>
						<tr>
							<td><h4>Telefon Numarası</h4></td>
							<td><h4><b>{{$adresler->cep_no}}</b></h4></td>
						</tr>
						<tr>
							<td><h4>Kimlik Numarası</h4></td>
							<td><h4><b>{{$adresler->tc_no}}</b></h4></td>
						</tr>
					</table>
				</div>
		
		</div>

@endsection