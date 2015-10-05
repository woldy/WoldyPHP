<?php
/*
	管理员设置
	api.php?a=set&m=mannger
*/
	class setMannger extends skoo{
		public function run(){
			$mac=isset($_REQUEST['mac'])?$_REQUEST['mac']:'';
			$act=isset($_REQUEST['act'])?$_REQUEST['act']:''; //add or del

			$result=$this->api($mac,$act);
			$this->json($result);
		}

		private function api($ssid,$key,$save,$auto){
			$connect=array(
				'errcode'=>$errcode,
				'errmsg'=>$errmsg
			);
			return $login;
		}
	}