<?php
	class Step1Step1Api extends Woldy{
		public function run($mothod,$type){
			if(empty($type)){
				$result=$this->$mothod();
			}
			else{
				$result=$this->$mothod.'_'.$type();
			}
			$this->json($result);
		}
		public function get(){
			$result=true;
			return $result;
		}
		
		public function set(){
			$result=true;
			return $result;
		}
		
		public function op(){
			$result=true;
			return $result;
		}
	}	