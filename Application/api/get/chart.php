<?php
/*
    获取图表设置
    api.php?a=get&m=chart
*/
    class getNetwork extends skoo{
        public function run(){
            $result=$this->api();
            $this->json($result);
        }

        private function api(){
            $option=array(
                

            );
        }

 
    }