<?php $__env->startSection('title'); ?>Kayıt Ol <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?><?php echo $__env->make('sayfa.sol', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
<div class="col-md-6">
  <?php if(!empty($hata)): ?>

    <div class="alert alert-danger">
      <?php echo e($hata); ?>

      <a href="#" class="close" data-dismiss="alert">&times;</a>
    </div>
  <?php endif; ?>
  <?php echo $__env->make('sayfa.kayit_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>


 <div class="col-md-3">
   <?php echo $__env->make('sayfa.urun_order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 </div>
      


<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>