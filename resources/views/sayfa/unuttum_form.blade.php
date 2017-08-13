<div class="panel panel-default panel-body">
<form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/url" type="get">
  <div class="form-group">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label>E-Mail Adresi</label>

    <input type="email" name="mail-unuttum" placeholder="E-Mail" class="form-control" required="">
  </div>

  <input type="submit" name="giris" id="sifre_unuttum" value="Yeni Şifre İste" class="btn btn-primary btn-lg fulle">
</form>
</div>
