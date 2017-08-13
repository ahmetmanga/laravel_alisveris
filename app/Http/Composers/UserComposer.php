<?php
namespace App\Http\Composers;
use Illuminate\Contracts\View\View;
use  Auth;
class UserComposer{

	protected $user;

		public function __construct(){
			if(Auth::check()){
				if(Auth::user()->yetki == 1){
					$this->user = 1;
				}else{
					$this->user = 0;
				}
			}else{
				$this->user = 2;
			}
		}

		public function compose(View $view){
			$view->with('user',$this->user);
		}
}
