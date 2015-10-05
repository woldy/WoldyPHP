<?php
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
			self::dispatch();
		}
		
		private function getConf(){
			return require APP_PATH.'data/config/'.__CLASS__.'.config.php';
		}
		//返回json数据
		public function json($msg,$errcode=0){
			if(is_array($msg)){
				if(!isset($msg['errcode'])){
					$msg['errcode']=0;
				}
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
		
		private function dispatch(){
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
				}else{
					$apiFile=APP_PATH.$modulePath."/$controller/$action.php";
				}
				
				$apiName=ucfirst($controller).ucfirst($action).'Api';
				if(file_exists($apiFile)){
					require_once($apiFile);
					$api=new $apiName;
					$ret=$api->run($mothod,$type);
				}
				else{
					self::createApi($apiName,$apiFile);
				}
				
			}else{
					die('undefined router');
			}
		}
		
		private function createApi($apiName,$apiFile){ //创建默认Api模板
 
			 $apiTemplate=<<<EOF
<?php
	class $apiName extends Woldy{
		public function run(\$mothod,\$type){
			if(empty(\$type)){
				\$result=\$this->\$mothod();
			}
			else{
				\$result=\$this->\$mothod.'_'.\$type();
			}
			\$this->json(\$result);
		}
		public function get(){
			\$result=true;
			return \$result;
		}
		
		public function set(){
			\$result=true;
			return \$result;
		}
		
		public function op(){
			\$result=true;
			return \$result;
		}
	}	
EOF;

		$apiDir=dirname($apiFile);
		if (!is_dir($apiDir)){ //创建目录
			mkdir($apiDir);
		} 
		if (!file_exists($apiFile)){ //写入文件
			file_put_contents($apiFile,$apiTemplate); 
			die('file ['.$apiFile.'] not exists,so i created it.' );
		} 
	}
}



