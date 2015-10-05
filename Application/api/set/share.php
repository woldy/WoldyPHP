<?php
/*
	联网设置
	api.php?a=set&m=connect
*/
	class setConnect extends skoo{
		public function run(){
			$auto=isset($_REQUEST['auto'])?$_REQUEST['auto']:'';

			$result=$this->api($ssid,$key,$save,$auto);
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