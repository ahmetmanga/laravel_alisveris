<div class="panel panel-default panel-body">
<h2>
    @if(empty($duzenle)) Yeni Adres Ekle @else Adres Düzenle @endif</h2>
<hr>
  @if(empty($duzenle))
   <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/profil/adres_ekle" method="post">
  @else
   <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/profil/adres_duzenle" method="post">
  @endif
  <div class="form-group @if($errors->has("name")) has-error has-feedback @endif">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  @if(!empty($duzenle))
  <input type="hidden" name="adres_id" value="{{$veri->id}}"> @endif
      <label>Adınız Soyadınız</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="@if(!empty($veri)) {{ $veri->ad_soyad }} @endif" placeholder="Adınız Soyadınız" class="form-control input-lg" required=""
      @if($errors->has("name"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("name") }} </div>
    </div>
    <div class="form-group @if($errors->has("tc_no")) has-error has-feedback @endif">

      <label>TC Kimlik Numaranız</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
      <input type="text" name="tc_no" maxlength="11" value="@if(!empty($veri)) {{ $veri->tc_no }} @endif" placeholder="TC Kimlik Numaranız" class="form-control input-lg" required=""
      @if($errors->has("tc_no"))
        id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>
    @else  > @endif
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("tc_no") }} </div>
  </div>
    <div class="col-md-6 form-group @if($errors->has("phone_number")) has-error has-feedback @endif">

      <label>Telefon Numarası</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input type="tel" id="cepTel" name="phone_number"  value="@if(!empty($veri)) {{ $veri->cep_no }} @endif"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
      @if($errors->has("phone_number"))
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  @else  > @endif
    </div>
    <hr>
  </div>
  <div class="col-md-6 form-group @if($errors->has("adres_basligi")) has-error has-feedback @endif">

    <label>Adres Başlığı</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-header"></i></span>
    <input type="text" id="adres_basligi" name="adres_basligi"  value="@if(!empty($veri)) {{ $veri->adress_type }} @endif"  placeholder="Adres Başlığı" class="form-control input-lg" required=""
    @if($errors->has("adres_basligi"))
      id="inputError2" aria-describedby="inputError2Status">
<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
<span id="inputError2Status" class="sr-only">(error)</span>
@else  > @endif
  </div>
  <hr>
</div>

      <div class="col-md-6 form-group @if($errors->has("il")) has-error has-feedback @endif">

      <label>İl Seçin</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>
          <select class="input input-lg" name="il" style="border-top-left-radius:0px; border-bottom-left-radius:0px;">
              <option value="0">Seçiniz</option>
              @foreach($iller as $value)
                  <option value="{{$value->il_no}}">{{$value->isim}}</option>
              @endforeach
          </select>
    </div>
    <hr> <div class="text-warning">
    {{ $errors->first("il") }} </div>
  </div>
  <div class="col-md-6 form-group @if($errors->has("ilce")) has-error has-feedback @endif">

  <label>İlçe Seçin</label>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>
      <select class="input input-lg" name="ilce" style="border-top-left-radius:0px; border-bottom-left-radius:0px;">

      </select>
</div>
<hr> <div class="text-warning">
{{ $errors->first("ilce") }} </div>
</div>

<div class="form-group @if($errors->has("adres")) has-error has-feedback @endif">

  <label>Adres</label>
  <div class="input-group">
  <?php if(!empty($veri)) $adres = explode("<br />",$veri->adress); ?>
    <textarea name="adres" rows="8" cols="60">@if(!empty($veri)) {{$adres[0]}} @endif</textarea>
  </div>
<hr> <div class="text-warning">
{{ $errors->first("adres") }} </div>
</div>
    <input type="submit" name="adres_ekle" id="adres_ekle"  value="Adresi Kaydet" class="btn btn-primary btn-lg fulle">
    </form>
</div>
