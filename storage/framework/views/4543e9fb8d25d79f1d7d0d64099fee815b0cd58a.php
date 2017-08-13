<div class="row">
<div class="col-md-12">
  <nav  class="navbar navbar-default kat_desktop" id="alt" style="margin-top:0px;">
    <button class="navbar-toggle" data-toggle="collapse" data-target="#menuackapa"><div class="icon-bar"></div><div class="icon-bar"></div> <div class="icon-bar"></div></button>
    <div class="collapse navbar-collapse" id="menuackapa">
    <ul class="nav navbar-nav">


      <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $alt_kategori = [];
        $kat_id = [];
        $enalt_kategori = [];
        $enkat_id = [];
         ?>
        <?php if($cat->type == 0 && $cat->view == 1): ?>
          <li class="sub_li"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo e($cat->name); ?> <span class="caret"></span></a>
            <div class="dropdown-menu acilir_menu" style="width:650px;">

                  <div class="row">
                    <div class="col-md-4" style="margin-left:10px;">
                      <ul class="list-group hover">
                        <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php if($sub_category->type == $cat->id && $sub_category->view == 1): ?>
                           <li class="list-group-item kat_isim" style="text-align:center;"><h4 style="color:black;"><?php echo e($sub_category->name); ?> <span class="glyphicon glyphicon-chevron-right"></span></h4></li>
                           <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ikinci): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <?php if($ikinci->type == $sub_category->id && $ikinci->view == 1 && $ikinci->type != $cat->id): ?>
                               <?php
                               array_push($alt_kategori,$ikinci);
                               if(!in_array($sub_category->id,$kat_id)){
                               array_push($kat_id,$sub_category->id);
                             }
                                ?>
                             <?php endif; ?>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>

                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </ul>
                    </div>
                  <?php for($i=0;$i<count($kat_id);$i++): ?>

                    <div class="col-md-4 kat_acilir" style="text-align:center;float:left;margin-left:0px;display:none;">
                      <ul class="list-group hover">
                        <?php $__currentLoopData = $alt_kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($kat_id[$i] == $kat->type && $kat->view == 1): ?>
                          <li class="list-group-item kat_ac"> <a href="<?php echo url('/') ?>/category/<?php echo e($kat->id); ?>"><?php echo e($kat->name); ?> <span class="glyphicon glyphicon-chevron-right"></span></a> </li>
                          <?php
                          if(!in_array($kat->id,$enkat_id)){
                            array_push($enkat_id, $kat->id);
                          }
                           ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </ul>
                    </div>

                  <?php endfor; ?>
                  <?php for($k=0;$k<count($enkat_id);$k++): ?>

                    <div class="col-md-4 kat_alt" style="text-align:center;float:right;margin-left:0px;display:none; width:215px;">
                      <ul class="list-group hover">
                        <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($enkat_id[$k] == $cate->type): ?>
                            <li class="list-group-item"><a href="<?php echo url('/') ?>/category/<?php echo e($cate->id); ?>"><?php echo e($cate->name); ?></a></li>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                      </ul>
                    </div>

                  <?php endfor; ?>
                  </div>






            </div>
          </li>
        <?php endif; ?>
<?php
  unset($alt_kategori);
  unset($kat_id);
  unset($enalt_kategori);
  unset($enkat_id);
 ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>


    </div>
  </nav>

  

  <nav  class="navbar navbar-default kat_mobil" style="margin-top:0px;display:none;">
    <div class="navbar-header">
        <div class="navbar-brand">
          Tüm Kategoriler
        </div>
        <button class="navbar-toggle" data-toggle="collapse" data-target="#menuackapa2"><div class="icon-bar"></div><div class="icon-bar"></div> <div class="icon-bar"></div></button>
    </div>

    <div class="collapse navbar-collapse" id="menuackapa2">
    <ul class="nav navbar-nav">

      <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $veri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($veri->type == 0 && $veri->view == 1): ?>
                  <li class="list-group-item"><a href="<?php echo url('/');?>/category/<?php echo e($veri->id); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo e($veri->name); ?> <span class="caret"></span></a>
                  <ul class="nav navbar-nav dropdown-menu">
                <?php $__currentLoopData = $all_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $veri2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $arastir = DB::table("category")->where('id',$veri2->id)->first();
                $arastir_2 = DB::table("category")->where('id',$arastir->type)->first();
                 ?>
                   <?php if($veri2->type != 0 && $veri2->view == 1 && $arastir_2->type != 0): ?>
                    <li class="list-group-item"><a href="<?php echo url('/');?>/category/<?php echo e($veri2->id); ?>"><?php echo e($veri2->name); ?></a></li>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </li>

                <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
  </div>
  </nav>
</div>
</div>
