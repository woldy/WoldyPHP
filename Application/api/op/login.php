<?php
/*
	登录
	api.php?a=op&m=login
*/
	class opLogin extends skoo{
		public function run(){
			$password=isset($_REQUEST['password'])?$_REQUEST['password']:'';
			$result=$this->api($password);
			$this->json($result);
		}

		private function api($password){

			$login=array(
				'errcode'=>$errcode,
				'errmsg'=>$errmsg
			);
			return $login;
		}
	}