<?php
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
class CategoryComposer{

	protected $category;

		public function __construct(){
			$this->category = \App\Category::get();

		}

		public function compose(View $view){
			$view->with('all_category',$this->category);
		}
}
