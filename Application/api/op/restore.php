<?php
/*
    重置系统
    api.php?a=op&m=restore
*/
    class opRestore extends skoo{
        public function run(){
            $result=$this->api();
            $this->json($result);
        }

        private function api(){
            $device_id=shell_exec("ifconfig | grep HW -m1 | openssl md5 | awk '{print $2}'");
            shell_exec("cp -R /Skoo/Conf/* /etc");
            shell_exec("rm -f /Skoo/Web/inc/config.php");
            shell_exec("uci set wireless.@wifi-iface[0].ssid='Skoo_".substr(strtoupper($device_id),6,4)."'");
            shell_exec("uci commit");
            shell_exec("reboot");
            return true;
        }
    }