<div class="panel panel-default panel-body">
<h2>
    Kayıt Ol</h2>
<hr>
  <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/kayit" method="post">
  <div class="col-md-6 form-group @if($errors->has("name")) has-error has-feedback @endif">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label>Adınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="@if(!empty($veri)) {{ $veri["name"] }} @endif" placeholder="Adınız" class="form-control input-lg" required=""
      @if($errors->has("name"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("name") }} </div>
    </div>
    <div class="col-md-6 form-group @if($errors->has("surname")) has-error has-feedback @endif">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <label>Soyadınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="surname" value="@if(!empty($veri)) {{ $veri["surname"] }} @endif" placeholder="Soyadınız" class="form-control input-lg" required=""
      @if($errors->has("surname"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("surname") }} </div>
    </div>
    <div class="col-md-12 form-group @if($errors->has("email")) has-error has-feedback @endif">

      <label>E-Mail Adresi</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" name="email"  value="@if(!empty($veri)) {{ $veri["email"] }} @endif" placeholder="E-Mail Adresiniz" class="form-control input-lg" required=""
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
      <input type="tel" id="cepTel" name="phone_number"  value="@if(!empty($veri)) {{ $veri["phone_number"] }} @endif"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
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

      <label>Şifre</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password" placeholder="Şifre" class="form-control input-lg" required=""
      @if($errors->has("password"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("password") }} </div>
  </div>
    <div id="sifre_gucluk" class="progress progress-striped active" style="display: none">
      <div id="sifre_deger" class="progress-bar"></div>
    </div>
    <div class="col-md-12 form-group @if($errors->has("password_confirmation")) has-error has-feedback @endif">

      <label>Şifre (Tekrar)</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password_confirmation" placeholder="Şifre (Tekrar)" class="form-control input-lg" required=""
      @if($errors->has("password_confirmation"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("password_confirmation") }} </div>
  </div>
    <div id="sifre_eslesme" style="display: none" class="form-group">
    <label class="alert alert-danger">Girilen şifreler eşleşmiyor.</label>

    </div>
    
    <input type="submit" name="kayit" id="kayit"  value="Kayıt Ol" class="btn btn-primary btn-lg fulle">
    </form>
</div>
