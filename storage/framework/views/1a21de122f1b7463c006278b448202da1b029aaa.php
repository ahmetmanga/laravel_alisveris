<?php $__env->startSection('title'); ?>Ödeme <?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>

      <div class="col-md-12">
        <div class="col-md-9">
          <div class="col-md-6 panel panel-body">
            <h2 class="text-primary" style="float:left;">Merhaba, <?php echo e($isim); ?> </h2>
</p>
          </div>
          <div class="col-md-3 col-md-offset-3 panel panel-body">
            <h2><a class="pull-right" href="<?php echo e(url('sepetim')); ?>"><span class="glyphicon glyphicon-chevron-left"></span> Sepete Dön</a></h2>
          </div>
        <div class="col-md-12 panel panel-body">
          <h2 class="page-header text-primary">Sepetinizdeki Ürünler</h2>
            <table class="table table-hover table-bordered">
              <thead>
                <tr>
                  <td>Ürün</td>
                  <td>Kargoya Veriliş</td>
                  <td>Kargo Seçeneği</td>
                  <td>Adet</td>
                  <td>Toplam</td>
                </tr>
              </thead>
              <tbody>
                <?php $__currentLoopData = $sepet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <tr>
                    <td>
                      <h4 class="text-primary" style="margin-top:0px;">
                        <a href="<?php echo url('/');?>/urun_detay/<?php echo e($value["urun_id"]); ?>" title="<?php echo e($value["isim"]); ?>"><?php echo e($value["isim"]); ?></a>
                      </h4>
                    </td>
                    <td>
                    <?php if($stok[$value["urun_id"]]->hizli_teslimat == 2): ?> <h4><span class="glyphicon glyphicon-ok"></span> Hızlı Teslimat</h4>
                    <?php elseif($stok[$value["urun_id"]]->stok == 0): ?> <h5>Kargoya veriliş süresi: <b style="color:red">5</b> <b> iş günü</b></h5>
                    <?php else: ?> <h5>Kargoya veriliş süresi: <b style="color:red">1</b> <b> iş günü</b></h5> <?php endif; ?>
                    </td>
                  <td><?php if($stok[$value["urun_id"]]->kargo == 1): ?>
                    Ücretsiz Kargo <?php else: ?>
                      Standart Kargo <?php endif; ?>
                  </td>
                  <td class="middle"><?php echo e($value["adet"]); ?></td>
                  <td>
                    <h4>
                      <?php echo e($value["fiyat"]); ?> ₺</h4>
                      <?php   ?>
                  </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <?php if($kargo == "ucretsiz"): ?>
              <hr>
              <div class="panel panel-primary panel-body">
                <h4>Sepetinizdeki ürünlerden biri ücretsiz kargo. Sizden kargo ücreti alınmayacaktır.</h4>
              </div>
            <?php endif; ?>
        </div>
        <div class="col-md-12 panel panel-body">
          <h2 class="page-header text-primary">Teslimat Bilgileri <button type="button" data-toggle="modal" data-target="#adres_ekle" class="pull-right btn btn-primary btn-lg" name="button">Yeni Adres Ekle</button></h2>

          <div class="modal fade" id="adres_ekle">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-heading">
                  <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>
                <div class="modal-body">
                  <?php echo $__env->make('sayfa.adres_ekle_form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 panel panel-body adres_sayfa" style="text-align:center; <?php if(count($adresler) <= 4): ?> display:none; <?php endif; ?>">
        </div>
        <form action="<?php echo e(url('odeme_onayla')); ?>" method="post">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <?php $__currentLoopData = $adresler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-6 adresler">
            <div class="panel  panel-body" style="min-height:175px;">
              <h3><?php echo e($value->adress_type); ?> <input type="radio" class="pull-right adresler_radio" name="adres" value="<?php echo e($value->id); ?>"></h3>
              <?php echo $value->adress; ?>

              <h4><?php echo e($value->ad_soyad); ?> - <?php echo e($value->cep_no); ?></h4>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-md-12">
              <div class="col-md-5 panel panel-body">
                <h4 class="page-header text-primary">Ödeme Yöntemi</h4>
                <ul class="list-group hover">
          <li class="list-group-item secili">Havale/Eft <input class="input_radio" type="radio" name="odeme" value="0"></li>
          <li class="list-group-item secili"  id="kredi_karti">Kredi Kartı <input class="input_radio" type="radio" name="odeme" value="1"></li>

                </ul>
              </div>
              <div class="col-md-5 col-md-offset-2 panel panel-body">
                <h4 class="page-header text-primary">Kargo</h4>
                <ul class="list-group">
                  <li class="list-group-item secili">Standart Kargo - <?php if($kargo == "ucretli"): ?> <b>5.00 ₺</b> <?php else: ?> <b>Ücretsiz</b> <?php endif; ?> <input type="radio" <?php if($kargo == "ucretli"): ?> fiyat="5" <?php else: ?> fiyat="0" <?php endif; ?> class="input_radio" name="kargo" value="0" <?php if($hizli != 2): ?> checked <?php endif; ?>></li>
                  <?php if($hizli == 2): ?> <li class="list-group-item secili">Hızlı Teslimat - <b>10.00 ₺</b> <input type="radio" class="input_radio" fiyat="10" name="kargo" value="1"></li> <?php endif; ?>
                </ul>
              </div>
            </div>
          <div class="col-md-12 panel panel-body" style="display:none;" id="taksit_secenekleri">
            <?php if($toplam_ucret >= 100): ?>
              <table class="table table-responsive table-hover table-bordered">
                <thead>
                  <tr>
                    <td>Taksitler</td>
                    <?php $__currentLoopData = $bankalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <td><?php echo e($banka->banka_ismi); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tr>
                </thead>
                <tbody>
                     <?php for($i=2;$i<=6;$i++): ?>
                                <tr>
                                  <td><?php echo e($i); ?> Taksit</td>
                                  <?php $__currentLoopData = $bankalar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <?php $taksit = explode(",",$banka->taksitler); ?>
                                      <?php if(in_array($i,$taksit)): ?>
                                          <?php if($i>3): ?>
                                            <?php if($toplam_ucret >= 300): ?>
                                              <?php $aylik_tutar = (round($toplam_ucret/$i+($i*2/$toplam_ucret)*100)); ?>
                                                <td class="secili">Aylık Tutar: <b><?php echo e($aylik_tutar); ?> ₺</b> Toplam: <u><?php echo e($aylik_tutar*$i); ?></u> ₺ <input type="radio" class="input_radio" name="taksit" value="<?php echo e($i); ?><?php echo e($banka->id); ?>"></td>
                                            <?php else: ?>
                                              <td class="bg-danger"></td>
                                            <?php endif; ?>


                                            <?php else: ?>
                                              <td class="secili">Aylık Tutar: <b><?php echo e(round($toplam_ucret/$i)); ?> ₺</b> Toplam: <u><?php echo e($toplam_ucret); ?></u> ₺ <input type="radio" class="input_radio" name="taksit" value="<?php echo e($i); ?><?php echo e($banka->id); ?>"></td>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <td class="bg-danger"></td>
                                        <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                     <?php endfor; ?>


                </tbody>
              </table>
            <?php else: ?>
              <h3>Önemli Not</h3>
              <br>
              <h4>Taksitli alışveriş için sipariş tutarınız 100 ₺ ve üzerinde olmalıdır.</h4>
              <h4>300 ₺ altındaki siparişlerinizde en çok 3 taksit imkanından faydalanabilirsiniz.</h4>
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-3">
        
          <div class="col-md-12">
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
                 <font id="toplam_fiyat">
                  <?php if($kargo == "ucretli"): ?>
                    <?php echo e($toplam_ucret+5); ?> ₺
                  <?php else: ?>
                    <?php echo e($toplam_ucret); ?> ₺
                  <?php endif; ?></font>
                </h2>
            </div>
              <button type="submit" class="btn btn-primary btn-lg fulle" name="button" onclick="window.location.href='<?php echo e(url('odeme_onayla')); ?>'" style="min-height:70px;font-size:25px;">Siparişi Onayla</button>
          </div>
          </div>
           </form>
          
          <div class="col-md-12"><div class="panel panel-body">
            <h2 class="page-header text-primary">Kupon Kullan</h2>
                <form method="post" action="<?php echo e(url('odeme_onayla/kupon')); ?>">
                  <?php echo e(csrf_field()); ?>

                <div class="col-md-12"><input type="text" name="kupon_kodu" class="input input-lg" required placeholder="Kupon Kodu">
               </div> 
               <div class="col-md-12" style="margin-top: 3%;"> <input type="submit" name="kupon_submit" value="Kullan" class="btn btn-primary btn-lg fulle"></div>
                </form>
        </div></div>
        </div>
     
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>