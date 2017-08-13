@extends('sayfa.home')
@section('title')Adres Ekle @endsection
@section('sol_bolum')
  @include('sayfa.kullanici')
@endsection
@section('degisken')
  <div class="col-md-6">
    @if(!empty($hata))

      <div class="alert alert-danger">
        {{ $hata }}
        <a href="#" class="close" data-dismiss="alert">&times;</a>
      </div>
    @endif
    @include('sayfa.adres_ekle_form')
  </div>
  <div class="col-md-3">@include('sayfa.urun_order')</div>
@endsection
