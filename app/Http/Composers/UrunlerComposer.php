<?php
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
use DB;
use App\Http\Controllers\UrunController;
class UrunlerComposer{

	protected $urunler;
		public function __construct(){
			$this->urunler = DB::table("product")->orderBy('ratings','DESC')->take(3)->get();
			foreach($this->urunler as $data){
				$data->ratings = UrunController::puan_hesaplat($data);
			}
		}

		public function compose(View $view){
			$view->with(['data'=>$this->urunler,'composer_type'=>'composer']);
		}
}
