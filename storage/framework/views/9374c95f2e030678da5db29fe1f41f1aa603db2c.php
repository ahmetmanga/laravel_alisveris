<?php $__env->startSection('title'); ?>Bilgi Düzenle <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?>
  <?php echo $__env->make('sayfa.kullanici', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
<div class="col-md-6">
  <div class="panel panel-default panel-body">
<h2>
    Bilgileri Düzenle</h2>
<hr>
  <form  class="form-group" role="form" action="<?php echo url('/'); ?>/profil/bilgi_duzenle" method="post">
  <div class="col-md-12 form-group <?php if($errors->has("name")): ?> has-error has-feedback <?php endif; ?>">
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      <label>Adınız Soyadınız</label>


    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="<?php echo e($value->name); ?>" placeholder="Adınız Soyadınız" class="form-control input-lg" required=""
      <?php if($errors->has("name")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("name")); ?> </div>
    </div>
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
      
    <div class="col-md-12 form-group <?php if($errors->has("email")): ?> has-error has-feedback <?php endif; ?>">

      <label>E-Mail Adresi</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input type="email" name="email"  value="<?php echo e($value->email); ?>" placeholder="E-Mail Adresiniz" class="form-control input-lg" disabled="" 
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
      <input type="tel" id="cepTel" name="phone_number"  value="<?php echo e($value->phone_number); ?>"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
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

      <label>Bilgilerinizi Onaylayın</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input type="password" name="password" placeholder="Şifre" class="form-control input-lg" required=""
      <?php if($errors->has("password")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <br>
    <div class="col-md-12 form-group">
     <input type="submit" name="bilgi_duzenle" id="bilgi_duzenle"  value="Bilgileri Düzenle" class="btn btn-primary btn-lg fulle"></div> 
   
    </form>
</div>

</div></div>
<div class="col-md-3"><?php echo $__env->make('sayfa.urun_order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
</div>
<?php $__env->stopSection(); ?>
  

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>