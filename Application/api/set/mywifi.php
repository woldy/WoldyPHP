<?php
/*
	我的Wifi
	api.php?a=set&m=mywifi
*/
	class setMywifi extends skoo{
		public function run(){
			$ssid=isset($_REQUEST['ssid'])?$_REQUEST['ssid']:'';
			$key=isset($_REQUEST['key'])?$_REQUEST['key']:'';

			$result=$this->api($ssid,$key);
			$this->json($result);
		}

		private function api($ssid,$key){
			shell_exec("uci set wireless.@wifi-iface[0].ssid='$ssid'");
	        shell_exec("uci set wireless.@wifi-iface[0].key='$key'");
	        shell_exec("uci set wireless.@wifi-iface[0].encryption=psk2");
	        shell_exec("uci commit");
			$mywifi=array(
				'errcode'=>$errcode,
				'errmsg'=>$errmsg
			);
			return $mywifi;
		}
	}