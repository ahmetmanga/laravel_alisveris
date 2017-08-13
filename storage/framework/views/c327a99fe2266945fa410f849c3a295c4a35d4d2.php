<?php if(count($data) !=  0): ?>
  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(empty($composer_type)): ?> <div class="col-md-4 order"> <?php else: ?> <div class="col-md-12 order"> <?php endif; ?>
      <div class="thumbnail ek_ayar" title="Detay için tıklayınız.">

        <?php
        $resim_explode = explode("*resim*",$result->resim);
        ?>
        <?php if(strpos($result->resim,"*resim*")): ?>
          <div class="slayt">
            <ul>
              <?php $__currentLoopData = $resim_explode; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yeni_resim): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><img src="<?php echo e($yeni_resim); ?>" width="200" height="200" onclick="window.location='<?php echo url('/') ?>/urun_detay/<?php echo e($result->id); ?>'"></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php else: ?>
            <img src="<?php echo e($result->resim); ?>" width="200" height="200" onclick="window.location='<?php echo url('/') ?>/urun_detay/<?php echo e($result->id); ?>'">

        <?php endif; ?>
        <div class="caption" style="text-align:center;">
          <h4 title="<?php echo e($result->name); ?>">
            <a href="<?php echo url('/') ?>/urun_detay/<?php echo e($result->id); ?>">
              <?php if(strlen($result->name) <= 30): ?>
              <?php echo e($result->name); ?>

            <?php else: ?>
              <?php echo e(substr($result->name,0,20)); ?> ...
            <?php endif; ?>
            </a>
          </h4>
          <?php
          $ratings = floor($result->ratings);
           ?>
          <div class="fiyat_anadiv sol-20" onclick="window.location='<?php echo url('/') ?>/urun_detay/<?php echo e($result->id); ?>'">
            <?php if($result->old_price != 0.00): ?>


                <div class="indirim">
                    %<?php echo e(round(100 - (($result->price/$result->old_price)*100))); ?>

                </div>
                <div style="float:right; margin-right:5px;">

                    <div class="old_price">
                      <?php echo e($result->old_price); ?> ₺
                    </div>
                    <div class="price">
                      <?php echo e($result->price); ?> ₺
                    </div>

                </div>

              <?php else: ?>
                <div class="price" style="text-align:center;">
                  <?php echo e($result->price); ?> ₺
                </div>
            <?php endif; ?>

          </div>

        </div>
        <div class="ratings puan_renk" style="margin-left:5px;" onclick="window.location='<?php echo url('/') ?>/urun_detay/<?php echo e($result->id); ?>'">

                             <p>
                                 <?php for($i=0;$i<$ratings;$i++): ?>
                                   <span class="glyphicon glyphicon-star"></span>
                                 <?php endfor; ?>
                                 <?php for($i=0;$i<5-$ratings;$i++): ?>
                                   <span class="glyphicon glyphicon-star-empty"></span>
                                 <?php endfor; ?>
                             </p>
                         </div>
      </div>
    </div>
  <?php
  unset($resim_explode);
  ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

  <?php if(empty($composer_type)): ?><div class="col-md-12">
    <div class="panel panel-body sayfa_no" style="text-align:center;">

    </div><?php endif; ?>
  </div>
