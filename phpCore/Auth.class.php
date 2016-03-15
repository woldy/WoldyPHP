<?php 
	class Auth extends Woldy{
		static function check($controller){
			$anyone=self::getConf('Auth')['anyone'];
			if(!in_array($controller,$anyone)){
				if(!self::verify()){
					//未通过验证
					self::json('请登录！','-1');
					exit();
				}
			}
		}
		
		static function verify(){
			if($_SESSION['admin']==1){
				return true;
			}else{
				return false;
			}
		}
	}