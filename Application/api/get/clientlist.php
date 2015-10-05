<?php
/*
	获取客户端列表
	api.php?a=get&m=clientlist
*/
	class getClientlist extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$clientInfo=array(
				'name'=>$name,			//客户端名称
				'mac'=>$mac,			//客户端 mac
				'ip'=>$ip,				//客户端ip地址	
				'time'=>$time			//连入时间
				'state'=>$state			//状态(是否安全)
			);

			$clientList=array(	
				'list'=>array(
					$clientInfo,$clientInfo,$clientInfo//.....
				)
			);
			$clientList['count']=count($clientList['list']); //客户端总数
			return $clientList;
		}
	}