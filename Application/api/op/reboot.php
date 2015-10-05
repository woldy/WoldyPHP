<?php
/*
	重启系统
	api.php?a=op&m=reboot
*/
	class opReboot extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			return $true;
		}
	}