<?php
/*
	重新连接
	api.php?a=op&m=reconnect
*/
	class opDReconnect extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			return $true;
		}
	}