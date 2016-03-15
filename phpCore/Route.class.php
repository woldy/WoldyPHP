<?php 
	class Route extends Woldy{
		static function dispatch(){
			require('Auth.class.php');
			//module=api
			//controller
			//action
			//mothod
			if(isset($_REQUEST['r'])){ //是否存在路由
				$r=str_replace('.','',$_REQUEST['r']);
				$route=explode('/',$r);
				$config=self::getConf();
				if($config['module'] && in_array($route[0],$config['module'])){ //指定模块
					$module=$route[0];
					$controller=$route[1];
					$action=$route[2];
					$mothod=isset($route[3])?$route[3]:'';
					$type=isset($route[4])?$route[4]:'';
				}else{
					$module='api';//默认模块
					$controller=$route[0];
					$action=$route[1];
					$mothod=isset($route[2])?$route[2]:'';
					$type=isset($route[3])?$route[3]:'';
				}
				$modulePath=$module=='api'?'api':'api/'.$module;
				
				if($controller==null){
					die('undefined action');
				}else if($action==$controller){
					$apiFile=APP_PATH.$modulePath."/$controller.php";
					$apiName=ucfirst($controller).'Api';
				}else{
					$apiFile=APP_PATH.$modulePath."/$controller/$action.php";
					$apiName=ucfirst($controller).ucfirst($action).'Api';
				}
				
				if(file_exists($apiFile)){
					Auth::check($controller);
					require_once($apiFile);
					$api=new $apiName;
					$ret=$api->run($mothod,$type);
				}
				else{
					require_once('Template.class.php');
					Template::Create('api',$apiName,$apiFile);
				}
				
			}else{
					die('undefined router');
			}	
		}	
	}