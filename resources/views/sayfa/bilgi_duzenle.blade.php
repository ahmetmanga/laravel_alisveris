@extends('sayfa.home')
@section('title')Bilgi Düzenle @endsection
@section('sol_bolum')
  @include('sayfa.kullanici')
@endsection
@section('degisken')
<div class="col-md-6">
  <div class="panel panel-default panel-body">
<h2>
    Bilgileri Düzenle</h2>
<hr>
  <form  class="form-group" role="form" action="<?php echo url('/'); ?>/profil/bilgi_duzenle" method="post">
  <div class="col-md-12 form-group @if($errors->has("name")) has-error has-feedback @endif">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label>Adınız Soyadınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="{{$value->name}}" placeholder="Adınız Soyadınız" class="form-control input-lg" required=""
      @if($errors->has("name"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("name") }} </div>
    </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
      
    <div class="col-md-12 form-group @if($errors->has("email")) has-error has-feedback @endif">

      <label>E-Mail Adresi</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" name="email"  value="{{$value->email}}" placeholder="E-Mail Adresiniz" class="form-control input-lg" disabled="" 
      @if($errors->has("email"))
        id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>
    @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("email") }} </div>
  </div>
    <div class="col-md-12 form-group @if($errors->has("phone_number")) has-error has-feedback @endif">

      <label>Telefon Numarası</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input type="tel" id="cepTel" name="phone_number"  value="{{$value->phone_number}}"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
      @if($errors->has("phone_number"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("phone_number") }} </div>
  </div>

      <div class="col-md-12 form-group @if($errors->has("password")) has-error has-feedback @endif">

      <label>Bilgilerinizi Onaylayın</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password" placeholder="Şifre" class="form-control input-lg" required=""
      @if($errors->has("password"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <br>
    <div class="col-md-12 form-group">
     <input type="submit" name="bilgi_duzenle" id="bilgi_duzenle"  value="Bilgileri Düzenle" class="btn btn-primary btn-lg fulle"></div> 
   
    </form>
</div>

</div></div>
<div class="col-md-3">@include('sayfa.urun_order')</div>
</div>
@endsection
  
