<div class="panel panel-default panel-body">
<h2>
    Kayıt Ol</h2>
<hr>
  <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/kayit" method="post">
  <div class="col-md-6 form-group <?php if($errors->has("name")): ?> has-error has-feedback <?php endif; ?>">
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <label>Adınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="<?php if(!empty($veri)): ?> <?php echo e($veri["name"]); ?> <?php endif; ?>" placeholder="Adınız" class="form-control input-lg" required=""
      <?php if($errors->has("name")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("name")); ?> </div>
    </div>
    <div class="col-md-6 form-group <?php if($errors->has("surname")): ?> has-error has-feedback <?php endif; ?>">
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <label>Soyadınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="surname" value="<?php if(!empty($veri)): ?> <?php echo e($veri["surname"]); ?> <?php endif; ?>" placeholder="Soyadınız" class="form-control input-lg" required=""
      <?php if($errors->has("surname")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("surname")); ?> </div>
    </div>
    <div class="col-md-12 form-group <?php if($errors->has("email")): ?> has-error has-feedback <?php endif; ?>">

      <label>E-Mail Adresi</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" name="email"  value="<?php if(!empty($veri)): ?> <?php echo e($veri["email"]); ?> <?php endif; ?>" placeholder="E-Mail Adresiniz" class="form-control input-lg" required=""
      <?php if($errors->has("email")): ?>
        id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>
    <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("email")); ?> </div>
  </div>
    <div class="col-md-12 form-group <?php if($errors->has("phone_number")): ?> has-error has-feedback <?php endif; ?>">

      <label>Telefon Numarası</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input type="tel" id="cepTel" name="phone_number"  value="<?php if(!empty($veri)): ?> <?php echo e($veri["phone_number"]); ?> <?php endif; ?>"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
      <?php if($errors->has("phone_number")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("phone_number")); ?> </div>
  </div>

      <div class="col-md-12 form-group <?php if($errors->has("password")): ?> has-error has-feedback <?php endif; ?>">

      <label>Şifre</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password" placeholder="Şifre" class="form-control input-lg" required=""
      <?php if($errors->has("password")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("password")); ?> </div>
  </div>
    <div id="sifre_gucluk" class="progress progress-striped active" style="display: none">
      <div id="sifre_deger" class="progress-bar"></div>
    </div>
    <div class="col-md-12 form-group <?php if($errors->has("password_confirmation")): ?> has-error has-feedback <?php endif; ?>">

      <label>Şifre (Tekrar)</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password_confirmation" placeholder="Şifre (Tekrar)" class="form-control input-lg" required=""
      <?php if($errors->has("password_confirmation")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("password_confirmation")); ?> </div>
  </div>
    <div id="sifre_eslesme" style="display: none" class="form-group">
    <label class="alert alert-danger">Girilen şifreler eşleşmiyor.</label>

    </div>
    
    <input type="submit" name="kayit" id="kayit"  value="Kayıt Ol" class="btn btn-primary btn-lg fulle">
    </form>
</div>
