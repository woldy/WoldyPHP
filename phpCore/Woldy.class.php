<?php
	session_start();
	class Woldy{
		//自动加载类
		function __construct(){
			spl_autoload_register(function($cls){
				if(strpos($cls,'Model')>0){ //是模型
					$cls=str_replace('_','/',$cls);
					require APP_PATH.'/model/' . $cls . '.class.php';
				}else{ //是类库
					require APP_PATH.'/library/' . $cls . '.class.php';
				}
			});
		}

		public function init(){
			date_default_timezone_set('PRC');
			require('Route.class.php');
			Route::dispatch();
		}
		
		
		public function cmd($p){	
			parse_str($p,$_REQUEST);
		}
		
		public function getConf($class=''){
			if(empty($class)){
				$class=__CLASS__;
			}
			return require APP_PATH.'data/config/'.$class.'.config.php';
		}
		//返回json数据
		public function json($msg,$errcode=0){
			if(is_array($msg)){
				if(!isset($msg['errcode'])){
					$msg['errcode']=0;
				};
				$result=$msg;
			}
			else{
				$result=array(
					'errcode'=>$errcode,
					'msg'=>$msg,
				);
			}
			header("Content-type: application/json");
			echo json_encode($result);
		}
		
		public function shell($cmd){
			$shell=trim(shell_exec($cmd));
			return $shell;
		}
 
		

}



