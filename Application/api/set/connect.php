<?php
/*
	联网设置
	api.php?a=set&m=connect
*/
	class setConnect extends skoo{
		public function run(){
			$ssid=isset($_REQUEST['ssid'])?$_REQUEST['ssid']:'';
			$key=isset($_REQUEST['key'])?$_REQUEST['key']:'';
			$save=isset($_REQUEST['save'])?$_REQUEST['save']:'';
			$auto=isset($_REQUEST['auto'])?$_REQUEST['auto']:'';

			$result=$this->api($ssid,$key,$save,$auto);
			$this->json($result);
		}

		private function api($ssid,$key,$save,$auto){
			$enc=trim(shell_exec("cat /tmp/aplist | grep '$ssid' -m 1 | awk -F '$ssid' {'print \$2'} |awk {'print $2'}")); //加密方式
			$gateway=shell_exec("route -n |grep apcli0| awk '$1~/0.0.0.0/ {print $2}'"); //网关地址
			$ssid_now=shell_exec("uci get wireless.@wifi-iface[0].ApCliSsid"); //当前ssid
	        if(trim($ssid_now)==$ssid && trim($gateway)!=''){
	            $errcode=3;//不需要连接
	            $errmsg='当前已连接';
	        }else{
	        	if($enc=='NONE' || $key==''){ //若为空
		            $ApCliAuthMode='NONE';
		            $ApCliEncrypType='NONE';
		            
		        }else{ //否则，/ 前面是mode，后面是type
		            $e=explode('/',$enc);
		            if(strpos($enc,'WPA2PSK')>0){
		                $ApCliAuthMode='WPA2PSK';
		            }
		            if(strpos($enc,'AES')>0){
		                $ApCliEncrypType='AES';
		            }
		        }

		        shell_exec("cp -f /etc/dnsmasq.conf.y /etc/dnsmasq.conf"); 
		        shell_exec("/etc/init.d/dnsmasq restart");    //重置dns
		        shell_exec("uci set wireless.@wifi-iface[0].ApCliSsid='$ssid'"); //写入配置
		        shell_exec("uci set wireless.@wifi-iface[0].ApCliAuthMode='$ApCliAuthMode'");
		        shell_exec("uci set wireless.@wifi-iface[0].ApCliEncrypType='$ApCliEncrypType'");
		        shell_exec("uci set wireless.@wifi-iface[0].ApCliPassWord='$key'");
		        shell_exec("uci commit"); //提交
		        pclose(popen("nohup /Skoo/Box/misc/reload.sh &","r")); //重置
		        $errcode=0;
		        $errmsg='连接成功';
	        }
			$connect=array(
				'errcode'=>$errcode,
				'errmsg'=>$errmsg
			);
			return $connect;
		}
	}