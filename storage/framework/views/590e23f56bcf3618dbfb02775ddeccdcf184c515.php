<?php $__env->startSection('title'); ?>Anasayfa <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?>
  <?php echo $__env->make('sayfa.sol', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('degisken'); ?>
  <div class="col-md-9">

    <?php echo $__env->make('sayfa.urun_order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>