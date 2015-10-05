<?php
/*
	获取日志列表
	api.php?a=get&m=loglist
*/
	class getLoglist extends skoo{
		public function run(){
			$type=isset($_REQUEST['type']) && in_array($_REQUEST['type'],array('sec','sys','all'))?$_REQUEST['type']:'all';
			$result=$this->api($type);
			$this->json($result);
		}

		private function api($type){
			$logInfo=array(
				'actname'=>$actname,	//动作名称
				'actcode'=>$actcode,	//动作代码
				'actmac'=>$actmac,		//操作mac
				'actip'=>$actmac,		//操作ip
				'acttime'=>$acttime,	//操作时间
				'content'=>$content,	//操作内容
				'result'=>$result,		//操作结果	
				'level'=>$level,		//安全级别
				'type'=>$type			//日志类型sys、sec
			);

			$logList=array(	
				'list'=>array(
					$logInfo,$logInfo,$logInfo,$logInfo//.....
				)
			);
			$logList['count']=count($logList['list']); //日志总数
			return $logList;
		}
	}