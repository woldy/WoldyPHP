<?php
/*
	获取网络环境
	api.php?a=get&m=netenv
*/
	class getNetenv extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){

			$apInfo=array(
				'ssid'=>$ssid,								//ap 名称
				'bssid'=>$bssid,							//ap mac
				'enc'=>$enc,								//ap加密方式
				'saved'=>$saved,							//是否保存密码	
				'signal'=>$signal							//信号强度
				'count'=>$count								//连接次数
			);

			$netenv=array(
				'apcount'=>$openap,							//无线ap数量
				'openap'=>$openap,							//开放ap数量
				'samecount'=>$samecount,				  	//与当前连接热点同名ap数量
				'aplist'=>array($apInfo,$apInfo,$apInfo)  	//同名ap列表
			);

			return $netenv;
		}
	}