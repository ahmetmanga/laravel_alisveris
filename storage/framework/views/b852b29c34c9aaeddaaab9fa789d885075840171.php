<?php $__env->startSection('title'); ?><?php echo e($data->name); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
  <div class="modal fade" id="yorum_yap">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-heading">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
          </div>
          <div class="modal-body">
            <?php echo $__env->make('sayfa.yorum', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          </div>
      </div>
    </div>
  </div>
<div class="col-md-12">
  <?php if(!empty($errors)): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?php echo e($error); ?>

        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
  <div class="panel panel-body" style="border-radius:0px;">
    <div class="col-md-6">
      <div class="carousel slide" data-ride="carousel" id="urun_slayt">
          <ol class="carousel-indicators" style="bottom:0;">
            <?php $image = explode("*resim*",$data->resim); ?>
           <?php if(strpos($data->resim,"*resim*")): ?>
              <?php for($i=0;$i<count($image);$i++): ?>
                  <li data-target="#urun_slayt" <?php if($i==0): ?> class="active" <?php endif; ?> data-slide-to="<?php echo e($i); ?>"></li>
              <?php endfor; ?>
           <?php else: ?>
               <li data-target="#urun_slayt" class="active" data-slide-to="0"></li>
          <?php endif; ?>
              </ol>
              <div class="carousel-inner">

                <?php if(strpos($data->resim,"*resim*")): ?>
                   <?php for($i=0;$i<count($image);$i++): ?>
                     <div class="item <?php if($i== 0): ?> active <?php endif; ?>">
        <a  data-target="#<?php echo e($i); ?>" data-toggle="modal"><img style="margin-left:10%;" width="500" height="500" src="<?php echo e($image[$i]); ?>" alt="<?php echo e($data->name); ?>"></a>

                     </div>

                   <?php endfor; ?>
                <?php else: ?>
                  <div class="item active">
     <a href="#" data-target="#1" data-toggle="modal"><img style="margin-left:10%;" src="<?php echo e($data->resim); ?>" width="500" height="500" alt="<?php echo e($data->name); ?>"></a>

                  </div>
               <?php endif; ?>


              </div>
        <a href="#urun_slayt" class="carousel-control left" style="width:7%;" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></a>
        <a href="#urun_slayt" class="carousel-control right" style="width:7%;" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></a>

      </div>
      <?php if(strpos($data->resim,"*resim*")): ?>
        <?php for($i=0;$i<count($image);$i++): ?>
          <div class="modal fade" id="<?php echo e($i); ?>">
              <div class="modal-dialog" style="width:800px;height:800px;">
                <div class="modal-content">
                  <div class="modal-header">
                  <a href="#" class="close" data-dismiss="modal">&times;</a>
                  </div>
                    <div class="modal-body">
                      <img src="<?php echo e($image[$i]); ?>" width="775" height="775" alt="<?php echo e($data->name); ?>">
                    </div>

                </div>
              </div>
          </div>
        <?php endfor; ?>
      <?php else: ?>
        <div class="modal fade" id="1">
            <div class="modal-dialog" style="width:800px;height:800px;">
              <div class="modal-content">
                <div class="modal-header">
                <a href="#" class="close" data-dismiss="modal">&times;</a>
                </div>
                  <div class="modal-body">
                    <img src="<?php echo e($data->resim); ?>" width="775" height="775" alt="<?php echo e($data->name); ?>">
                  </div>

              </div>
            </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-6" style="background-color:#ddd;height:100%;">
      <div class="row">
        <div class="col-md-12">
          <h3><?php echo e($data->name); ?></h3>
          <a class="text-primary" style="font-weight:bold;margin-top:2%;" href="<?php echo e(url('category/'.$kat->id)); ?>"><?php echo e($kat->name); ?></a>
        </div>
      </div>
    <div class="row">
      <div class="col-md-6" style="margin-top:5%;">

      <?php if($data->old_price != 0.00): ?>
        <div class="fiyat_anadiv fiyat_anadiv-buyuk">
            <div class="indirim indirim-buyuk">
              %<?php echo e(round(100 - (($data->price/$data->old_price)*100))); ?>

            </div>
            <div style="float:right; margin-right:5px;">

                <div class="old_price old_price-buyuk">
                <?php echo e($data->old_price); ?> ₺
                </div>
                <div class="price price-buyuk">
                 <?php echo e($data->price); ?> ₺
                </div>

            </div>
        </div>
      <?php else: ?>
        <div class="price price-buyuk">
          <?php echo e($data->price); ?>

        </div>
    <?php endif; ?>

      </div>
      <div class="col-md-5 col-md-offset-1 puan_renk" id="puanla" style="margin-top:5%;">
        <?php   $ratings = floor($data->ratings); ?>
          <h4><a href="#" data-toggle="modal" data-target="#yorum_yap">Yorum Yap</a> | <a href="#urun_detay_tab">Yorumlar (<?php echo e($yorum_sayisi); ?>)</a></h4>
          <h3 class="puan_renk">
          <?php for($i=0;$i<$ratings;$i++): ?>
            <span class="glyphicon glyphicon-star"></span>
          <?php endfor; ?>
          <?php for($i=0;$i<5-$ratings;$i++): ?>
            <span class="glyphicon glyphicon-star-empty"></span>
          <?php endfor; ?>
</h3>


      </div>
    </div>
    <hr>
    
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    <input type="hidden" name="urun_id" value="<?php echo e($data->id); ?>">
    <div class="row" style="margin-top:6%;">
      <div class="col-md-12">
      <?php if($data->view != 0 && $stok->stok > 0): ?>
        <div class="col-md-3 adet">
          <div class="adet_masaustu">
            <div class="col-md-1 adet-artis">
                <a  href="javascript:void(0)" class="text-success arttir">+</a>
            </div>
              <div class="col-md-1" style="margin-left:10%;">
                <input type="number" name="adet" class="adet_miktari" min="1" max="100" value="1">
                Adet
              </div>
              <div class="col-md-1 adet-azalis">
                  <a href="javascript:void(0)" class="text-danger azalt">-</a>
              </div>
          </div>

          
          <div class="adet_mobil" style="display:none;line-height:200%;">
            <div class="col-md-1 adet-artis" style="font-size:15px;">
                <a  href="javascript:void(0)" class="text-success arttir">Arttır</a>
            </div>

              <div class="col-md-1" style="margin-left:10%;">
                <input type="number" name="adet" class="adet_miktari" min="1" max="100" value="1">
                Adet
              </div>
              <div class="col-md-2" style="float:right;font-size:15px;">
                  <a href="javascript:void(0)" class="text-danger azalt">Azalt</a>
              </div>
          </div>
          </div>
          <div class="col-md-4 col-md-offset-1" >
            <button type="button" name="sepete_ekle" class="btn btn-lg fulle btn-primary" style="min-height:50px;">
              <span class="glyphicon glyphicon-shopping-cart"></span> Sepete Ekle</button>
          </div>
        <?php else: ?>
          <button type="button" class="btn btn-primary btn-lg" disabled name="button">Stokta Yok</button>
          <h4>Bu ürün geçici olarak temin edilemiyor.</h4>
        <?php endif; ?>

      </div>
    </div>

    <div class="row" style="margin-top:5%;margin-bottom:2%;">
      <?php if($data->view != 0): ?>
        <div class="col-md-12">
          <?php if($stok->stok < 20 && $stok->stok != 0): ?>
            <h4 style="font-weight:bold;">Bu ürün hızla tükeniyor! <br> <br> Kalan adet: <font color="red"><?php echo e($stok->stok); ?></font></h4>
          <?php endif; ?>
    </div>
  <?php endif; ?>
        <?php if($data->view != 0): ?>
          <div class="col-md-12">
            <?php if($stok->stok == 0): ?>
              <h5>Tahmini Kargoya Veriliş Süresi : <b>5 İş Günü</b></h5>
            <?php else: ?>
              <h5>Tahmini Kargoya Veriliş Süresi: <b>1 İş Günü</b></h5>
            <?php endif; ?>
      </div>
    <?php endif; ?>

          <?php
            if(strpos($data->color_type,"**")){
              $ex = explode("**",$data->color_type);
              echo "
                          <div class='col-md-12' style='margin-top:5%;margin-bottom:5%;'>
                            <select name='extra' class='input input-lg'><option>Renk Seçiniz</option>";
                      for($i=0;$i<count($ex);$i++){
                        echo "<option value=".$i.">".str_replace(['--','//'],[' ',' '],$ex[$i])." ₺</option>";
                      }
                      echo "</select> </div>";
                      }
           ?>




      <div class="col-md-12" style="margin-bottom:5%;">
        <?php if($stok->kargo == 1): ?>
            <img src="http://design.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/kargo_bedava.png" alt="Kargo Bedava">
          <?php endif; ?>
          <?php if($stok->stok > 100): ?>
            <img src="http://design.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/fast_shipping.png" alt="Süper Hızlı">
          <?php endif; ?>
        <?php if($stok->hizli_teslimat == 2): ?>
            <img src="https://images.hepsiburada.net/hbv2/ProductDetails/storefront_widgets_small/icon_1497508515143.png" alt="Hızlı Teslimat">
         <?php endif; ?>

      </div>
    </div>

    </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-body" style="border-radius:0px;">
      <ul class="nav nav-tabs" id="urun_detay_tab">
      				<li class="active"><a href="#1" data-toggle="tab">Ürün Açıklaması</a></li>
      				<li><a href="#2" data-toggle="tab">Kampanyalar</a></li>
      				<li><a href="#3" data-toggle="tab">Yorumlar (<?php echo e($yorum_sayisi); ?>)</a></li>
      				<li><a href="#4" data-toggle="tab">Taksit</a></li>
              <li><a href="#5" data-toggle="tab">İade Koşulları</a></li>
      			</ul>
            <div class="tab-content">
            				<div id="1" class="tab-pane fade panel-body in active ">
                        <?php echo $data->comment; ?>

            				</div>
            				<div id="2" class="tab-pane fade panel-body">
            					Eklenecek.
            				</div>
            				<div id="3" class="tab-pane fade panel-body">
                         <div class="col-md-3"><h2 class="page-header"><button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#yorum_yap" name="button">Yorum Yap</button></h2></div>
                         <?php if($yorum_sayisi>10): ?>
                         <div class="col-md-4 col-md-offset-5">
                           <h2 class="page-header"><a href="<?php echo e(url('urun_detay/yorumlar')); ?>/<?php echo e($data->id); ?>" class="btn btn-lg btn-primary fulle" style="min-height:40px;">Tüm Yorumları Oku</a></h2>
                         </div>
                         <?php endif; ?>

                         <?php if(count($yorumlar) == 0): ?> <h2>Bu ürün için hiç yorum yapılmamış!</h2> <?php else: ?>
                             <?php $__currentLoopData = $yorumlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yorum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <div class="row">
                                 <div class="col-md-12">
                                   <div class="col-md-4">
                                   <h2> <?php echo e($yorum->yorum_baslik); ?></h2>
                                 </div>
                                 <div class="col-md-4" style="color:#919191;">
                                  <span class="glyphicon glyphicon-user"></span> <?php echo e(substr($yorum->user_id,0,strlen($yorum->user_id)/2)); ?> -  <span class="glyphicon glyphicon-time"></span> <?php echo e($yorum->created_at); ?>

                                 </div>
                                 <div class="col-md-4 puan_renk">

                                     <?php for($i=0;$i<$yorum->puan;$i++): ?>
                                       <span class="glyphicon glyphicon-star"></span>
                                     <?php endfor; ?>
                                     <?php for($i=0;$i<5-$yorum->puan;$i++): ?>
                                       <span class="glyphicon glyphicon-star-empty"></span>
                                     <?php endfor; ?>

                                 </div>
                                 </div>
                               </div>
                                <br>
                                <?php echo $yorum->yorum; ?>


                                <hr>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>

                    </div>
            				<div id="4" class="tab-pane fade panel-body">
            					<?php if($data->price >= 100): ?>
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
                                                      <?php if($data->price >= 300): ?>
                                                        <?php $aylik_tutar = (round($data->price/$i+($i*2/$data->price)*100)); ?>
                                                          <td>Aylık Tutar: <b><?php echo e($aylik_tutar); ?> ₺</b> Toplam: <u><?php echo e($aylik_tutar*$i); ?></u> ₺</td>
                                                      <?php else: ?>
                                                        <td class="bg-danger"></td>
                                                      <?php endif; ?>


                                                      <?php else: ?>
                                                        <td>Aylık Tutar: <b><?php echo e(round($data->price/$i)); ?> ₺</b> Toplam: <u><?php echo e($data->price); ?></u> ₺</td>
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
                    <div id="5" class="tab-pane fade panel-body">
                      İncelediğiniz ürün, doğrudan üretici firma tarafından size kargoyla gönderilecektir. İade işlemlerinizi aşağıdaki şekilde yapmalısınız: <br />

Ürünün adresinize teslim tarihinden itibaren 14 gün içinde "Sipariş Takibi" sayfasından "İade ve Geri gönderim" başvurusunda bulunarak iade sürecinizi başlatabilirsiniz. <br>

Başvurunuz sonrasında “Hesabım” sayfasında bulunan başvuru takibi bölümünde gösterilen kargo gönderi kodu ile göndermeniz gerekmektedir. İadenizin kabul edilmesi için, ürünün hasar görmemiş ve kullanılmamış olması gerekmektedir. <br>

İade etmek istediğiniz ürün, tarafımızdan üretici firmaya ulaştırılacak ve iade işlemleriniz Hepsiburada.com tarafından takip edilecektir. <br>

Daha detaylı bilgi için Yardım sayfasını ziyaret edebilirsiniz. <br>

* Bedel İadesi: İade işlemi sonuçlandıktan sonra bedel ödemesi kredi kartınıza/banka hesabınıza 24 saat içinde yapılmaktadır. Ödeme işlemlerinin hesabınıza yansıma süresi bankanıza göre değişkenlik gösterebilir. <br>
                    </div>
            			</div>

    </div>
  </div>
  <div class="col-md-12">
      <div class="panel panel-body">
          <h2 class="page-header"><a href="<?php echo e(url('category')); ?>/<?php echo e($kat->id); ?>"><?php echo e($kat->name); ?></a> Kategorisindeki Çok Satanlar</h2>
            <table class="table  table-responsive">
                    <tbody>
                      <?php $__currentLoopData = $cok_satilanlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                  <td><img src="<?php echo e($value->resim); ?>" width="50" height="50"></td>
                                  <td><h3><a href="<?php echo e(url('urun_detay')); ?>/<?php echo e($value->id); ?>"><?php echo e($value->name); ?></a></h3></td>
                                  <td><div class="progress">
                                    <div class="progress-bar" style="width: <?php if($value->satis_miktari<10): ?>
                                              <?php echo e($value->satis_miktari*2); ?>px; <?php else: ?> <?php echo e($value->satis_miktari); ?>px; <?php endif; ?>
                                     "><b><?php echo e($value->satis_miktari); ?></b></div></div></td> 
                                </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>  

       </div>              
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>