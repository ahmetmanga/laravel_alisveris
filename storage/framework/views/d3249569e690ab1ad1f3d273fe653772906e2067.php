<?php $__env->startSection('title'); ?>Üye Girişi <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?>
  <?php echo $__env->make('sayfa.sol', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
<div class="col-md-7 col-md-offset-1">

  <?php echo $__env->make('sayfa.giris_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>