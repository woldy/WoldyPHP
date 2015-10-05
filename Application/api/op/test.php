<?php
/*
	test
	api.php?a=op&m=test
*/
	class opTest extends woldy{
		public function run(){
			$result=$this->api();
			$this->json($result);
		}

		private function api(){
			 config::del('xxx');
			return config::all();
		}
	}