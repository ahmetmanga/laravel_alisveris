<?php
	session_start();
	if($anahtar = substr(md5(rand(0,9999999)),-6)){
		$_SESSION['guvenlik'] = $anahtar;
			$en = 75;
			$boy = 35;
				$resim = imagecreate($en, $boy);
				$beyaz = imagecolorallocate($resim, 255, 255, 255);
				$siyah = imagecolorallocate($resim, 0,0,0);
				$rand = imagecolorallocate($resim, rand(0,255),rand(0,255),rand(0,255));
				imagefill($resim, 0,0,$rand);

				imagestring($resim,10,5,5, $_SESSION['guvenlik'], $beyaz);
				imageline($resim, 100, 19, 0, 19, $siyah);
				header("Content-Type:image/jpeg");
				imagejpeg($resim);
				imagedestroy($resim);

	}
?>
