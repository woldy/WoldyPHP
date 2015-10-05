<?php
/*
	获取安全状态
	api.php?a=get&m=security
*/
	class getSecurity extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){

			$state=array(						//状态
				'name'=>$name,					//检测项
				'content'=>$content,			//检测内容
				'time'=>$time,					//检测时间
				'result'=>$result,				//检测结果
				'level'=>$level					//安全级别
			);

			$count=array(
				'name'=>$name,					//威胁名称
				'count'=>$count,				//总数统计
				'daycount'=>$daycount,			//今日统计
				'weekcount'=>$weekcount,		//本周统计
				'mouthcount'=>$mouthcount,		//本月统计
				'quartecount'=>$quartecount,	//本季统计
				'yearcount'=>$yearcount,		//本年统计		
			);

			$security=array(
				'state'=>array(
					$state,	$state，$state，$state//....	一坨检测结果	
				),

				'option'=>array( 					//开关状态
					'envscan'=>$envscan,			//wifi环境感知
					'netscan'=>$netscan,			//上网安全检测
					'tunnel'=>$tunnel,				//加密通道
					'cryptonym'=>$cryptonym,		//隐身上网
					'report'=>$report,				//安全上报
					'interactive'=>$interactive		//上报交互
				),

				'count'=>array(						//各项威胁数值统计
					'name1'=>'value1',
					'name2'=>'value2',
					//......
				)
			);

			return $security;
		}
	}