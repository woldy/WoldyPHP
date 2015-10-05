<?php
/*
	获取管理员列表
	api.php?a=get&m=mgrlist
*/
	class getMgrlist extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$mgrInfo=array(
				'name'=>$name,			//管理员 名称
				'mac'=>$mac,			//管理员 mac
				'wxname'=>$wxname,		//绑定微信号	
				'addtime'=>$addtime,	//添加时间
				'lasttime'=>$lasetime,	//上次登录时间
				'online'=>$online,		//是否在线
				'supper'=>$supper		//超级管理
			);

			$mgrList=array(	
				'list'=>array(
					$mgrInfo,$mgrInfo,$mgrInfo,$mgrInfo//.....
				)
			);
			$mgrList['count']=count($mgrList['list']); //管理员总数
			return $mgrList;
		}
	}