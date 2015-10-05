<?php
/*
	断开连接
	api.php?a=op&m=disconnect
*/
	class opDisconnect extends skoo{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			return $true;
		}
	}