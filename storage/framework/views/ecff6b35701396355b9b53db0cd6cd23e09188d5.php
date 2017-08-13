<div class="panel panel-default panel-body">
<h2>
    <?php if(empty($duzenle)): ?> Yeni Adres Ekle <?php else: ?> Adres Düzenle <?php endif; ?></h2>
<hr>
  <?php if(empty($duzenle)): ?>
   <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/profil/adres_ekle" method="post">
  <?php else: ?>
   <form id="giris_form" class="form-group" role="form" action="<?php echo url('/') ?>/profil/adres_duzenle" method="post">
  <?php endif; ?>
  <div class="form-group <?php if($errors->has("name")): ?> has-error has-feedback <?php endif; ?>">
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  <?php if(!empty($duzenle)): ?>
  <input type="hidden" name="adres_id" value="<?php echo e($veri->id); ?>"> <?php endif; ?>
      <label>Adınız Soyadınız</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input type="text" name="name" value="<?php if(!empty($veri)): ?> <?php echo e($veri->ad_soyad); ?> <?php endif; ?>" placeholder="Adınız Soyadınız" class="form-control input-lg" required=""
      <?php if($errors->has("name")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("name")); ?> </div>
    </div>
    <div class="form-group <?php if($errors->has("tc_no")): ?> has-error has-feedback <?php endif; ?>">

      <label>TC Kimlik Numaranız</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
      <input type="text" name="tc_no" maxlength="11" value="<?php if(!empty($veri)): ?> <?php echo e($veri->tc_no); ?> <?php endif; ?>" placeholder="TC Kimlik Numaranız" class="form-control input-lg" required=""
      <?php if($errors->has("tc_no")): ?>
        id="inputError2" aria-describedby="inputError2Status">
    <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
    <span id="inputError2Status" class="sr-only">(error)</span>
    <?php else: ?>  > <?php endif; ?>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("tc_no")); ?> </div>
  </div>
    <div class="col-md-6 form-group <?php if($errors->has("phone_number")): ?> has-error has-feedback <?php endif; ?>">

      <label>Telefon Numarası</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
      <input type="tel" id="cepTel" name="phone_number"  value="<?php if(!empty($veri)): ?> <?php echo e($veri->cep_no); ?> <?php endif; ?>"  placeholder="Telefon Numaranız" class="form-control input-lg" required=""
      <?php if($errors->has("phone_number")): ?>
        id="inputError2" aria-describedby="inputError2Status">
  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
  <span id="inputError2Status" class="sr-only">(error)</span>
  <?php else: ?>  > <?php endif; ?>
    </div>
    <hr>
  </div>
  <div class="col-md-6 form-group <?php if($errors->has("adres_basligi")): ?> has-error has-feedback <?php endif; ?>">

    <label>Adres Başlığı</label>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-header"></i></span>
    <input type="text" id="adres_basligi" name="adres_basligi"  value="<?php if(!empty($veri)): ?> <?php echo e($veri->adress_type); ?> <?php endif; ?>"  placeholder="Adres Başlığı" class="form-control input-lg" required=""
    <?php if($errors->has("adres_basligi")): ?>
      id="inputError2" aria-describedby="inputError2Status">
<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
<span id="inputError2Status" class="sr-only">(error)</span>
<?php else: ?>  > <?php endif; ?>
  </div>
  <hr>
</div>

      <div class="col-md-6 form-group <?php if($errors->has("il")): ?> has-error has-feedback <?php endif; ?>">

      <label>İl Seçin</label>
      <div class="input-group">
        <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>
          <select class="input input-lg" name="il" style="border-top-left-radius:0px; border-bottom-left-radius:0px;">
              <option value="0">Seçiniz</option>
              <?php $__currentLoopData = $iller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($value->il_no); ?>"><?php echo e($value->isim); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
    </div>
    <hr> <div class="text-warning">
    <?php echo e($errors->first("il")); ?> </div>
  </div>
  <div class="col-md-6 form-group <?php if($errors->has("ilce")): ?> has-error has-feedback <?php endif; ?>">

  <label>İlçe Seçin</label>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-right"></i></span>
      <select class="input input-lg" name="ilce" style="border-top-left-radius:0px; border-bottom-left-radius:0px;">

      </select>
</div>
<hr> <div class="text-warning">
<?php echo e($errors->first("ilce")); ?> </div>
</div>

<div class="form-group <?php if($errors->has("adres")): ?> has-error has-feedback <?php endif; ?>">

  <label>Adres</label>
  <div class="input-group">
  <?php if(!empty($veri)) $adres = explode("<br />",$veri->adress); ?>
    <textarea name="adres" rows="8" cols="60"><?php if(!empty($veri)): ?> <?php echo e($adres[0]); ?> <?php endif; ?></textarea>
  </div>
<hr> <div class="text-warning">
<?php echo e($errors->first("adres")); ?> </div>
</div>
    <input type="submit" name="adres_ekle" id="adres_ekle"  value="Adresi Kaydet" class="btn btn-primary btn-lg fulle">
    </form>
</div>
