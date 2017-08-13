<?php $__env->startSection('title'); ?>Şifre İşlemleri <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?>
  <?php echo $__env->make('sayfa.kullanici', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
<div class="col-md-6">
  <div class="panel panel-default panel-body">
<h2>
    Şifre İşlemleri</h2>
<hr>
  <form class="form-group" role="form" action="<?php echo url('/') ?>/profil/sifre_islemleri" method="post">
    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="col-md-12 form-group <?php if($errors->has("old_password")): ?> has-error has-feedback <?php endif; ?>">

      <label>Eski Şifre</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="old_password" placeholder="Eski Şifre" class="form-control input-lg" required=""
      <?php if($errors->has("password")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("old_password")); ?> </div></div>

      <div class="col-md-12 form-group <?php if($errors->has("password")): ?> has-error has-feedback <?php endif; ?>">

      <label>Yeni Şifre</label>
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

      <label>Yeni Şifre (Tekrar)</label>
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
    
    <input type="submit" name="kayit" id="kayit"  value="Şifrenizi Değiştirin" class="btn btn-primary btn-lg fulle">
    </form>
</div>
</div>
<div class="col-md-3"><?php echo $__env->make('sayfa.urun_order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>