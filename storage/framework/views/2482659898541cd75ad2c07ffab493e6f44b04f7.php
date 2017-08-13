<?php $__env->startSection('title'); ?><?php echo e($title->name); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('sol_bolum'); ?>
  <div class="col-md-3">
    <form class="form-inline" id="filter_form" action="<?php echo url('/') ?>/filtrele" method="get">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="panel panel-body">
      <h3 class="text-primary top_sifirla">Kategoriler <span class="glyphicon glyphicon-chevron-down"></span></h3>
      <ul class="list-group">
          <input type="hidden" name="kat_id" value="<?php if(!empty($mevcut_id)): ?> <?php echo e($mevcut_id); ?>, <?php endif; ?> <?php if(!empty($secilen)): ?><?php for($i=1;$i<count($secilen)-1;$i++): ?><?php echo e($secilen[$i]); ?>,<?php endfor; ?> <?php endif; ?>">
        <?php $__currentLoopData = $kat_bilgisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="list-group-item"><div class="checkbox">
                <label style="font-size: 1em">
                    <input type="checkbox" class="kat_checkbox" name="marka" value="<?php echo e($kat->id); ?>" <?php if(!empty($secilen) && in_array($kat->id,$secilen) && !empty($mevcut_id) && $kat->id != $mevcut_id): ?>
                      checked
                    <?php endif; ?>>
                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                    <?php echo e($kat->name); ?>

                </label>
            </div></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </ul>
    </div>
    <div class="panel panel-body" title="Aradığınız ürünle ilgili herhangi bir özelliği girebilirsiniz.">
  <h3 class="text-primary top_sifirla">Aradığınız Özellik <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <p class="text-info">Birden fazla özellik aramak için "," koyun.</p>
  <div class="col-md-12">
    <input type="text" style="width:100%;" class="input-lg" name="anahtar" value="<?php if(!empty($anahtar_array)): ?><?php $__currentLoopData = $anahtar_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e(str_replace(["'%","%'"],['',''],$value)); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php elseif(!empty($anahtar)): ?><?php echo e($anahtar); ?><?php endif; ?>" placeholder="Özellik Arayın Örn(8GB,4.5G")">
  </div>


    </div>
    <div class="panel panel-body">
  <h3 class="top_sifirla text-primary">Fiyat Aralığı <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <div class="col-md-6">
    <input type="number" style="width:100%;" class="input-lg" name="en_az" <?php if(!empty($min)): ?> value="<?php echo e($min); ?>" <?php endif; ?> placeholder="Minimum">
  </div>
  <div class="col-md-6">
    <input type="number" style="width:100%;" class="input-lg" name="en_cok" <?php if(!empty($max)): ?> value="<?php echo e($max); ?>" <?php endif; ?> placeholder="Maximum">
  </div>


    </div>
    <div class="panel panel-body">
  <h3 class="top_sifirla text-primary">Sırala <span class="glyphicon glyphicon-chevron-down"></span></h3>
  <hr>
  <div class="col-md-12">
              <select class="input input-lg" name="sirala" style="width:100%;">
                <option value="fiyat_artan" <?php if(!empty($sirala) && $sirala == "fiyat_artan"): ?> selected <?php endif; ?>>Fiyata göre Artan</option>
                  <option value="fiyat_azalan" <?php if(!empty($sirala) && $sirala == "fiyat_azalan"): ?> selected <?php endif; ?>>Fiyata göre Azalan</option>
      <option value="son_eklenen" <?php if(!empty($sirala) && $sirala == "son_eklenen"): ?> selected <?php endif; ?>>Son Eklenenlere göre</option>
                  <option value="yorum_azalan" <?php if(!empty($sirala) && $sirala == "yorum_azalan"): ?> selected <?php endif; ?>>Yorumlara göre azalan</option>
                    <option value="yorum_artan" <?php if(!empty($sirala) && $sirala == "yorum_artan"): ?> selected <?php endif; ?>>Yorumlara göre artan</option>

              </select>

  </div>


    </div>
    <div class="panel panel-body">
      <button type="submit" name="button" class="btn btn-primary btn-lg fulle">Kriterlere göre Ara <span class="glyphicon glyphicon-search"></span></button>

      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('degisken'); ?>
  <div class="col-md-9">
    <?php if(!empty($min) || !empty($max) || !empty($secilen)): ?>
      <div class="alert alert-success">
        Seçtiğiniz kriterlere göre aşağıdaki ürünler bulundu.
        <a href="#" class="close" data-dismiss="alert">&times;</a>
      </div>
    <?php endif; ?>
    <?php echo $__env->make('sayfa.urun_order', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>