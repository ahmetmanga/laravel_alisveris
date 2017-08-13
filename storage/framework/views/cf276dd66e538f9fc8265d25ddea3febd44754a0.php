<?php $__env->startSection('title'); ?>Sepetim <?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
      <div class="col-md-12">
        <?php if($sign == "guest"): ?>
          <div class="col-md-9">
            <div class="alert alert-info">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
              Üyeliğinize giriş yapmamış görünüyorsunuz. <br> Bir sonraki aşamada   <a href="<?php echo e(url('giris')); ?>"><b>Giriş Yapmanız</b></a> yada  <a href="<?php echo e(url('kayit')); ?>"><b>Kayıt Olmanız</b></a> gerekecek. <br>

            </div>
          </div>
        <?php endif; ?>
        <div class="col-md-9">
          <div class="panel panel-body">
            <h1 class="page-header text-primary">Sepetim</h1>
            <table class="table table-hover" >
              <thead>
                <td></td>
                <td></td>
                <td></td>
                <td>Fiyat</td>
              </thead>
              <tbody>
              <?php $__currentLoopData = $sepet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                  <td><a href="<?php echo url('/');?>/urun_detay/<?php echo e($value["urun_id"]); ?>">
                    <img src="<?php echo e($value["resim"]); ?>" width="100" height="100" alt="<?php echo e($value["isim"]); ?>">
                  </a></td>
                  <td>
                    <h3 class="text-primary" style="margin-top:0px;">
                      <a href="<?php echo url('/');?>/urun_detay/<?php echo e($value["urun_id"]); ?>" title="<?php echo e($value["isim"]); ?>"><?php if(strlen($value["isim"])>20): ?> <?php echo e(substr($value["isim"],0,20)); ?> ... <?php else: ?> <?php echo e($value["isim"]); ?> <?php endif; ?></a>
                    </h3>
                  <?php if($stok[$value["urun_id"]]->hizli_teslimat == 2): ?> <h4><span class="glyphicon glyphicon-ok"></span> Hızlı Teslimat</h4>
                  <?php elseif($stok[$value["urun_id"]]->stok == 0): ?> <h5>Kargoya veriliş süresi: <b style="color:red">5</b> <b> iş günü</b></h5>
                  <?php else: ?> <h5>Kargoya veriliş süresi: <b style="color:red">1</b> <b> iş günü</b></h5> <?php endif; ?>
                    <p><?php echo $aciklama[$value["urun_id"]]; ?></p>
                    <p><button class='btn btn-danger sepet_sil' veri="<?php echo e($value["urun_id"]); ?>" adet="<?php echo e($value["adet"]); ?>"><span class='glyphicon glyphicon-remove'></span></button></p>

                  </td>
                  <td> <div class="col-md-5 adet">
        <div class="adet_masaustu">
          <div class="col-md-1 adet-artis">
              <a  href="javascript:void(0)" veri="<?php echo e($value["urun_id"]); ?>" class="text-success arttir ajax">+</a>
          </div>
            <div class="col-md-1">
              <input type="number" name="adet"  class="adet_miktari" min="1" max="100" value="<?php echo e($value["adet"]); ?>">

              Adet
            </div>
            <div class="col-md-1 adet-azalis">
                <a href="javascript:void(0)" veri="<?php echo e($value["urun_id"]); ?>" class="text-danger azalt ajax">-</a>
            </div>
        </div>


        <div class="adet_mobil" style="display:none;line-height:200%;">
          <div class="col-md-1 adet-artis" style="font-size:15px;">
              <a  href="javascript:void(0)" veri="<?php echo e($value["urun_id"]); ?>" class="text-success arttir"><?php echo e($value["adet"]); ?></a>
          </div>

            <div class="col-md-1" style="margin-left:10%;">
              <input type="number" name="adet"  class="adet_miktari" min="1" max="100" value="1">
              Adet
            </div>
            <div class="col-md-2" style="float:right;font-size:15px;">
                <a href="javascript:void(0)" veri="<?php echo e($value["urun_id"]); ?>" class="text-danger azalt">Azalt</a>
            </div>
        </div>
        </div>
</td>
<td>
  <h4>
    <?php echo e($value["fiyat"]); ?> ₺</h4>
    <?php   ?>
</td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-3">
          <div class="panel panel-body" style="text-align:right;">
              <h2 class="page-header text-primary">Sipariş Özeti</h2>
              <p style="font-size:20px;">Toplam: <b><?php echo e($urun_adeti); ?> Ürün</b></p>
              <p style="font-color:#ddd">Ürün Tutarı :</p>
              <h1 style="margin-top:0px;"><?php echo e($toplam_ucret); ?> ₺</h1>
              <?php if($kargo == "ucretli"): ?>
              <p style="color:#333">+5 ₺ kargo ücreti</p>
            <?php endif; ?>
            <div class="bg-primary">
                <h2 style="margin-top:0px;text-align:center;color:white;">Toplam:
                  <?php if($kargo == "ucretli"): ?>
                    <?php echo e($toplam_ucret+5); ?> ₺
                  <?php else: ?>
                    <?php echo e($toplam_ucret); ?> ₺
                  <?php endif; ?>
                </h2>
            </div>
              <button type="button" class="btn btn-primary btn-lg fulle" name="button" onclick="window.location.href='<?php echo e(url('odeme_onayla')); ?>'" style="min-height:70px;font-size:25px;"><span class="glyphicon glyphicon-shopping-cart"></span> Alışverişi Tamamla</button>
          </div>
        </div>
      </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>