<?php
/*
	获取个人设置
	api.php?a=get&m=conf
*/
	class getConf extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$conf=array(
				'pic'=>$pic,			//自定义图片
				'mywifi'=>$myfiwi		//我的wifi名称
			);

			return $conf;
		}
	}