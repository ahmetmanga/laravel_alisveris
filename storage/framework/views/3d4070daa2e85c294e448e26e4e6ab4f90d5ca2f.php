<div class="panel panel-default panel-body">
<form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/login" method="post">
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  <div class="form-group  <?php if($errors->has("email")): ?> has-error has-feedback <?php endif; ?>">

    <label>E-Mail Adresi</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
        <input type="email" name="email-login" placeholder="E-Mail Adresi" class="form-control input-lg" required=""
        <?php if($errors->has("email")): ?>
          id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>

    <?php else: ?>  > <?php endif; ?>
      </div>
      <hr> <div class="text-warning">
      <?php echo e($errors->first("email")); ?>

    </div>

  </div>
    <div class="form-group <?php if($errors->has("password")): ?> has-error has-feedback <?php endif; ?>">

    <label>Şifre</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
        <input type="password" name="password-login" placeholder="Şifre" class="form-control input-lg" required=""
        <?php if($errors->has("password")): ?>
          id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>

    <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("email")); ?> </div>
  </div>
    
  <input type="submit" name="giris" id="giris" value="Giriş Yap" class="btn btn-primary btn-lg fulle">
  </form>
</div>
