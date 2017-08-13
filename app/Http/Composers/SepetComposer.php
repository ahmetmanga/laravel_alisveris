<?php
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
use  Auth;
use Session;
class SepetComposer{

	protected $sepet_composer;
	protected $toplam_tutar=0;
		public function __construct(){
				$this->sepet_composer = Session::get('sepet');
				if(count($this->sepet_composer) != 0){
				foreach($this->sepet_composer as $veri){
					 $this->toplam_tutar += $veri["fiyat"];
				} }
		}

		public function compose(View $view){
			$view->with(['sepet_composer'=>$this->sepet_composer,'toplam_tutar'=>$this->toplam_tutar]);
		}
}
