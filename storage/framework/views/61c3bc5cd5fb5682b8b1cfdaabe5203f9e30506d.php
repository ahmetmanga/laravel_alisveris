<?php $__env->startSection('title'); ?><?php echo e($data->name); ?> -- Yorumlar <?php $__env->stopSection(); ?>
<?php $__env->startSection('degisken'); ?>
	<div class="col-md-12">
	<div class="panel panel-body">
				<h2 class="page-header text-primary"><?php echo e($data->name); ?></h2>

		<table class="table table-hover table-bordered">
			<thead>
				<tr>
				<td></td>
				<td>Ürün</td>
				<td>Fiyat</td>
				<td>Puan</td>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td><img src="<?php echo e($resim); ?>" width="50" height="50"></td>
					<td><a href="<?php echo e(url('urun_detay')); ?>/<?php echo e($data->id); ?>" style="font-size:20px;"><?php echo e($data->name); ?></a></td>
					<td><h4><?php echo e($data->price); ?> ₺</h4></td>
					<td class="puan_renk">
						<h3 class="puan_renk"><?php for($i=0;$i<$data->ratings;$i++): ?>
						<span class="glyphicon glyphicon-star"></span>
						<?php endfor; ?>
						<?php for($i=0;$i<5-$data->ratings;$i++): ?>
						<span class="glyphicon glyphicon-star-empty"></span>
						<?php endfor; ?></h3>
					</td>
				</tr>
			</tbody>
		</table>
		<h2 class="page-header text-primary">Yorumlar <span class="glyphicon glyphicon-chevron-right"></span></h2>
	</div>
			<div class="row">
			
				<?php $__currentLoopData = $yorumlar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yorum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          	  
                               <div class="col-md-8 panel panel-body order" style="min-height:200px;margin-left:10%;margin-right:10%;">
                              
                               	 <div class="row">
                               	 	<div class="col-md-12">
                                   <div class="col-md-8">
                                   <h2> <?php echo e($yorum->yorum_baslik); ?></h2>
                                 </div>
                                 
                                 <div class="col-md-4 puan_renk pull-right">
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
                                <div class="col-md-12" style="color:#919191;">
                                  <span class="glyphicon glyphicon-user"></span> <?php echo e(substr($yorum->user_id,0,strlen($yorum->user_id)/2)); ?> <?php for($i=0;$i<strlen($yorum->user_id)/2;$i++): ?>*<?php endfor; ?> -  <span class="glyphicon glyphicon-time"></span> <?php echo e($yorum->created_at); ?>

                                 </div>
                               </div>
									
									
                                
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <div class="sayfa_no" style="text-align:center;"></div>
			</div>
	
	</div>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('sayfa.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>