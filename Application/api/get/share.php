<?php
/*
	获取共享文件
	api.php?a=get&m=share
*/
	class getShare extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$fileInfo=array(
				'name'=>$name,				//项目名称
				'type'=>$type,				//类型，文件或文件夹
				'encrypted'=>$encryptd,		//是否加密shared	
				'shared'=>$shared,			//是否被分享
				'createtime'=>$createtime,	//创建时间
				'size'=>$size				//文件大小
			);

			$share=array(
				'list'=>array(			//项目列表
					$fileInfo,$fileInfo,$fileInfo//.....
				)
			);
			$share['count']=count($share['list']); //文件总数
			return $share;
		}
	}