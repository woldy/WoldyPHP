<?php 
	class Route extends Woldy{
		static function dispatch(){
			//module=api
			//controller
			//action
			//mothod
			if(isset($_REQUEST['r'])){ //是否存在路由
				$r=str_replace('.','',$_REQUEST['r']);
				$route=explode('/',$r);
				$action=array_pop($route);
				$controller=array_pop($route);
				$path=implode('/', $route);

				if($controller==null){
					die('undefined action');
				}else{
					$apiFile=APP_PATH."api/$path/{$controller}Api.php";
					$apiName=ucfirst($controller).ucfirst($action).'Api';
				}
				
				if(file_exists($apiFile)){
					require_once($apiFile);
					$api=new $apiName;
					return $api->$action();
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