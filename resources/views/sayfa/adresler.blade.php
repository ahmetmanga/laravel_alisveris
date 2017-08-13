@extends('sayfa.home')
@section('title')Adresler @endsection
@section('sol_bolum')@include('sayfa.kullanici')@endsection
@section('degisken')
	<div class="col-md-9">
			<div class="col-md-6 adresler"><div class="panel panel-body" style="min-height: 175px;"><a href="{{url('profil/adres_ekle')}}"><h2 style="margin-top:10%; margin-left: 30%;"><span class="glyphicon glyphicon-plus"></span> Adres Ekle</h2></a></div></div>
			 @foreach($adresler as $value)
          <div class="col-md-6 adresler">
            <div class="panel  panel-body" style="min-height:175px;">
              <h3>{{$value->adress_type}}</h3>
              {!!$value->adress!!}
              <p>{{$value->tc_no}}</p>
              <h4>{{$value->ad_soyad}} - {{$value->cep_no}}</h4>
              <p><a href="{{url('profil/adres_duzenle')}}/{{$value->id}}" class="btn btn-warning">Düzenle</a>
				<a href="{{url('profil/adres_sil')}}/{{$value->id}}" class="btn btn-danger pull-right">Sil</a>
              </p>
            </div>
          </div>
        @endforeach
		 <div class="col-md-12 panel panel-body adres_sayfa" style="text-align:center; @if(count($adresler) <= 4) display:none; @endif">
        </div>
	</div>
@endsection