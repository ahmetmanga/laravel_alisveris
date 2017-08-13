<?php $__env->startSection('title'); ?>Sipariş Detayı<?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
	
		<div class="col-md-12">
					<div class="col-md-12 panel panel-body">
					<h2 class="page-header" style="color:#666666;margin-top: 0px;"><span class="glyphicon glyphicon-chevron-right"></span> Sipariş Detayları</h2>
						<table class="table table-responsive table-bordered">
							<tbody>
								<tr style="vertical-align: middle;">
									<td><h5>Sipariş No</h5><h4><?php echo e($data->id); ?></h4></td>
									<td><h5>Tarih</h5><h4><?php echo e($data->created_at); ?></h4></td>
									<td><h5>Ödeme Şekli</h5><h4><?php echo e($data->odeme_yontemi); ?> <?php if($data->odeme_yontemi == "Kredi Kartı"): ?> | <b><?php echo e($data->taksit["banka"]); ?> <?php echo e($data->taksit["taksit"]); ?> Taksit</b> <?php endif; ?></h4></td>
									<td><h5>Sipariş Durumu</h5><h4><b><?php echo $data->siparis_durumu; ?></b></h4></td>
									<td><h5>Toplam Tutar</h5><h3><b><?php echo e($data->toplam_tutar); ?> ₺</b></h3></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="col-md-12 panel panel-body">
						<table class="table table-responsive table-bordered table-hover">
							<tbody>
								<tr>
								<?php $__currentLoopData = $data->urunler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
									<td class="middle"><img src="<?php echo e($value["resim"]); ?>" width="100" height="100"></td>
									<td class="middle">
									<p><a href="<?php echo e(url('urun_detay')); ?>/<?php echo e($value["urun_id"]); ?>" class="text-primary"><?php echo e($value["isim"]); ?></a></p>
									<p><?php echo e($value["adet"]); ?> Adet | <b><?php echo $data->siparis_durumu; ?></b></p>
									</td>
									<td class="middle"><a href="<?php echo e(url('urun_detay')); ?>/<?php echo e($value["urun_id"]); ?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-comment"></span> Yorum Yazın</a></td>
									<td class="middle"><?php echo $value["extra"]; ?></td>
									<td class="middle"><h4><b><?php echo e($value["fiyat"]); ?> ₺</b></h4></td>
								</tr>
								 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>

				<div class="col-md-6 panel panel-body">
					<table class="table table-responsive table-bordered table-condensed">
						<tr  colspan="1">
							<td><h4>İsim Soyisim</h4></td>
							<td><h4><b><?php echo e($adresler->ad_soyad); ?></b></h4></td>
						</tr>
						<tr>
							<td><h4>Adres Başlığı</h4></td>
							<td><h4><b><?php echo e($adresler->adress_type); ?></b></h4></td>
						</tr>
						<tr>
							<td><h4>Adres</h4></td>
							<td><h4><b><?php echo $adresler->adress; ?></b></h4></td>
						</tr>
						<tr>
							<td><h4>Telefon Numarası</h4></td>
							<td><h4><b><?php echo e($adresler->cep_no); ?></b></h4></td>
						</tr>
						<tr>
							<td><h4>Kimlik Numarası</h4></td>
							<td><h4><b><?php echo e($adresler->tc_no); ?></b></h4></td>
						</tr>
					</table>
				</div>
		
		</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>