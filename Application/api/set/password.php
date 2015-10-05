<?php
/*
	密码管理
	api.php?a=set&m=password
*/
	class setPassword extends skoo{
		public function run(){
			$oldpwd=isset($_REQUEST['oldpwd'])?$_REQUEST['oldpwd']:'';
			$newpwd=isset($_REQUEST['newpwd'])?$_REQUEST['newpwd']:'';

			$result=$this->api($oldpwd,$newpwd);
			$this->json($result);
		}

		private function api($oldpwd,$newpwd){
			$password=array(
				'errcode'=>$errcode,
				'errmsg'=>$errmsg
			);
			return $password;
		}
	}