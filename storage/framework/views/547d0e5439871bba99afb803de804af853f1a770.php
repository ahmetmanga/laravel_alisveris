<?php $__env->startSection('title'); ?>Siparişler <?php $__env->stopSection(); ?>

<?php $__env->startSection('degisken'); ?>
	<div class="col-md-12 panel panel-body">
				
				<table id="siparisler" class="table table-bordered"  style="margin-left:5%;width:90%">
					<tbody>
						<?php $__currentLoopData = $siparisler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr class="adresler">
							<td>
								<div class="col-md-12"  style="min-height: 250px;border:1px solid #ddd;text-align:center;">
									<div class="col-md-2">
									<div class="col-md-12"><h5 class="text-muted">Sipariş Tarihi</h5><h5> <?php echo e($value->created_at); ?></h5></div>
								<div class="col-md-12"><h4>Sipariş No <b>1<?php echo e($value->id); ?></b></h4></div>
								<div class="col-md-12"><h4 class="text-primary"><?php echo e($value->user_id); ?></h4></div>
								<div class="col-md-12"><h4>Adres</h4></div>
								<br>
								<div class="col-md-12"><?php echo substr($value->adres_bilgileri,0,50); ?>...</div>
								<div class="col-md-12"><h4>Toplam Tutar</h4><h4> <b><?php echo e($value->toplam_tutar); ?> ₺</b></h4></div>	
								</div>
							
								<div class="col-md-8" style="min-width: 50px;min-height: 300px;">
									<h3 style="text-align: left;">Sipariş Durumu : <?php echo $value->siparis_durumu; ?></h3>
									<table class="table table-responsive table-bordered" style="margin-top: 2%;">
										<tbody>
											<?php $__currentLoopData = $value->urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $urun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><img src="<?php echo e($urun["resim"]); ?>" width="100" height="100"></td>
													<td><h3><a href="<?php echo e(url('urun_detay')); ?>/<?php echo e($urun["urun_id"]); ?>"><?php echo e($urun["isim"]); ?></a></h3></td>
													<td style="vertical-align: middle;"><?php echo $urun["extra"]; ?></td>
												</tr>			
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
									</table>
										

								</div>
								<div class="col-md-2">
									<a style=" margin-top:50%;" href="<?php echo e(url('siparis_detay')); ?>/<?php echo e($value->id); ?>" class="btn btn-primary btn-lg fulle">Sipariş Detayları</a>
									<a style=" margin-top:25%;" href="#" class="btn btn-primary btn-lg fulle">İade Et</a>
								</div>
								</div>
								
							</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					</tbody>

				</table>
				<br>
		<div class="col-md-12 adres_sayfa" style="text-align: center;"></div>
		
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>