<?php
/*
    获取网络设置
    api.php?a=get&m=network
*/
    class getNetwork extends skoo{
        public function run(){
            $result=$this->api();
            $this->json($result);
        }

        private function api(){
            $ssid=trim(shell_exec("uci get wireless.@wifi-iface[0].ApCliSsid"));//无线名称
            $key=trim(shell_exec("uci get wireless.@wifi-iface[0].ApCliPassWord"));//无线密码
            $nip=trim(shell_exec("ifconfig | grep apcli0 -A3 | grep 'inet addr' | awk {'print $2'} | awk -F ':' {'print $2'}")); //内网ip
            
            if(!$nip){
                $isConnect=false;//是否联网
                $pip='';//公网ip
            }else{
                $isConnect=true;//是否联网
                $pip=$this->get_IP();//公网ip
            }
            
            $gateway=trim(shell_exec("route -n |grep apcli0| awk '$1~/0.0.0.0/ {print $2}'")); //网关地址
            $mask=trim(shell_exec("ifconfig | grep apcli0 -A2 | grep Mask | awk -F 'Mask:' {'print $2'}"));//子网掩码
            $dns=trim(shell_exec("cat /tmp/resolv.conf.auto | grep nameserver | awk {'print $2'}")); //子网掩码
            $time=shell_exec("cat /proc/uptime| awk -F. '{run_days=$1 / 86400;run_hour=($1 % 86400)/3600;run_minute=($1 % 3600)/60;run_second=$1 % 60;printf(\"%d天%d时%d分%d秒\",run_days,run_hour,run_minute,run_second)}'"); //连接时间
            $network=array(
                'isConnect'=>$isConnect,    //是否联网
                'ssid'=>$ssid,              //无线名称
                'key'=>$key    ,            //无线密码
                'nip'=>$nip,                //内网ip
                'pip'=>$pip,                //公网ip
                'gateway'=>$gateway,        //网关地址
                'mask'=>$mask,              //子网掩码
                'dns'=>$dns,                //dns服务器
                'time'=>$time               //连接时间
            );

            return $network;
        }

        private function get_IP(){
            $str=file_get_contents('http://1111.ip138.com/ic.asp');
            $pattern='/\d{1,3}(.\d{1,3}){3}/';
            $pip=array();
            preg_match_all($pattern, $str, $pip, PREG_SET_ORDER);
            return $pip[0][0];
        }
    }