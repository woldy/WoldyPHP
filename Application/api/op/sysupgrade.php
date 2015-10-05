<?php
/*
	系统升级
	api.php?a=op&m=sysupgrade
*/
	class opSysupgrade extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			$version=array(
				'current'=>$current, 	//现版本
				'new'=>$new				//新版本
			);
			return $version;
		}
	}