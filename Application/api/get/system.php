<?php
/*
    获取系统信息
    api.php?a=get&m=system
*/
    class getSystem extends skoo{
        public function run(){
            $result=$this->api();
            $this->json($result);
        }

        private function api(){
            $softver=trim(shell_exec("cat /etc/openwrt_version"));//软件版本
            $hardver='Skoo! v0.0.1';//硬件版本
            $regtime='';//注册时间
            $lasttime='';//上次使用
            $uptime='';//最后更新
            $system=array(
                'softver'=>$softver,        //软件版本
                'hardver'=>$hardver,        //硬件版本
                'regtime'=>$regtime,        //注册时间
                'lasttime'=>$lasttime,      //上次使用
                'uptime'=>$uptime           //最后更新
            );

            return $system;
        }
    }