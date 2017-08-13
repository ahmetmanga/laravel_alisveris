<div class="col-md-3">
	<div class="panel panel-body">
		<h3 class="page-header middle"><span class="glyphicon glyphicon-user"></span> <?php echo e(Auth::user()->name); ?></h3>
		<ul class="list-group hover">
			<li class="list-group-item"><a href="<?php echo e(url('siparisler')); ?>">Siparişlerim</a></li>
			<li class="list-group-item"><a href="<?php echo e(url('profil/adreslerim')); ?>">Adreslerim</a></li>
			<li class="list-group-item"><a href="<?php echo e(url('profil/bilgi_duzenle')); ?>">Bilgileri Düzenle</a></li>
			<li class="list-group-item"><a href="<?php echo e(url('profil/sifre_islemleri')); ?>">Şifre İşlemleri</a></li>

		</ul>
	</div>
</div>