<?php
/*
	已保存密码wifi列表
	api.php?a=get&m=savedlist
*/
	class getSavedlist extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api($unique=true){
			$apInfo=array(
				'ssid'=>$ssid,			//ap 名称
				'enc'=>$enc,			//ap加密方式
				'time'=>$time,			//保存时间
				'inarea'=>$inarea,		//是否在范围内
				'lng'=>$lng,			//经度
				'lat'=>$lat,			//纬度
				'count'=>$count			//连接次数
			);

			$savedList=array(	
				'list'=>array(
					$apInfo,$apInfo,$apInfo//.....
				)
			);
			$savedList['count']=count($saved['list']); //ap总数
			return $savedList;
		}
	}