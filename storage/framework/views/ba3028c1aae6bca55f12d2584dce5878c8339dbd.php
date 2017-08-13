<?php $__env->startSection('title'); ?>Adresler <?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?><?php echo $__env->make('sayfa.kullanici', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
	<div class="col-md-9">
			<div class="col-md-6 adresler"><div class="panel panel-body" style="min-height: 175px;"><a href="<?php echo e(url('profil/adres_ekle')); ?>"><h2 style="margin-top:10%; margin-left: 30%;"><span class="glyphicon glyphicon-plus"></span> Adres Ekle</h2></a></div></div>
			 <?php $__currentLoopData = $adresler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-6 adresler">
            <div class="panel  panel-body" style="min-height:175px;">
              <h3><?php echo e($value->adress_type); ?></h3>
              <?php echo $value->adress; ?>

              <p><?php echo e($value->tc_no); ?></p>
              <h4><?php echo e($value->ad_soyad); ?> - <?php echo e($value->cep_no); ?></h4>
              <p><a href="<?php echo e(url('profil/adres_duzenle')); ?>/<?php echo e($value->id); ?>" class="btn btn-warning">Düzenle</a>
				<a href="<?php echo e(url('profil/adres_sil')); ?>/<?php echo e($value->id); ?>" class="btn btn-danger pull-right">Sil</a>
              </p>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		 <div class="col-md-12 panel panel-body adres_sayfa" style="text-align:center; <?php if(count($adresler) <= 4): ?> display:none; <?php endif; ?>">
        </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>