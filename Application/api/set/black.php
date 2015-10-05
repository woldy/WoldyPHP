<?php
/*
	黑名单
	api.php?a=set&m=black
*/
	class setConnect extends skoo{
		public function run(){
			$auto=isset($_REQUEST['method'])?$_REQUEST['method']:'';

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