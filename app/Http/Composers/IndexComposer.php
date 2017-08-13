<?php
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
class IndexComposer{

	protected $data = [];

		public function __construct(){
			$data2 = \App\Product::where('view',1)->orderBy('ratings','DESC')->paginate(40);
			foreach($data2 as $value){
				$value->ratings = \App\Http\Controllers\UrunController::puan_hesaplat($value);
				$this->data[$value->id] = $value;
			}
		}

		public function compose(View $view){
			$view->with('data',$this->data);
		}
}
