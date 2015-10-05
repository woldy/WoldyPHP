<?php
/*
	获取黑名单列表
	api.php?a=get&m=blacklist
*/
	class getBlacklist extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$clientInfo=array(
				'name'=>$name,			//客户端名称
				'mac'=>$mac,			//客户端 mac
				'mannger'=>$mannger,	//操作员	
				'time'=>$time			//拉黑时间
			);

			$blackList=array(	
				'list'=>array(
					$clientInfo,$clientInfo,$clientInfo//.....
				)
			);
			$blackList['count']=count($blackList['list']); //黑名单总数
			return $blackList;
		}
	}