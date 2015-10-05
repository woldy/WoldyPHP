<?php
/*
	获取U盘信息
	api.php?a=get&m=usbdisk
*/
	class getUsbdisk extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$fileInfo=array(
				'name'=>$name,				//项目名称
				'type'=>$type,				//类型，文件或文件夹
				'encrypted'=>$encryptd,		//是否加密
				'shared'=>$shared,			//是否被分享
				'createtime'=>$createtime,	//创建时间
				'size'=>$size,				//文件大小
			);

			$Usbdisk=array(
				'usb'=>$usb,			//是否存在USB盘
				'path'=>$path,			//当前路径
				'list'=>array(			//项目列表
					$fileInfo,$fileInfo,$fileInfo//.....
				)
			);
			$Usbdisk['count']=count($Usbdisk['list']); //文件总数
			return $Usbdisk;
		}
	}