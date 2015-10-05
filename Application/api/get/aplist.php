<?php
/*
    获取wifi列表
    api.php?a=get&m=aplist
*/
    class getAplist extends skoo{
        public function run(){
            $unique=isset($_REQUEST['unique']) && $_REQUEST['unique']=='false' ? false:true;
            $result=$this->api($unique);
            $this->json($result);
        }

        private function api($unique=true){
            
            // $apInfo=array(
            //     'ssid'=>$ssid,          //ap 名称
            //     'bssid'=>$bssid,        //ap mac
            //     'enc'=>$enc,            //ap加密方式
            //     'saved'=>$saved,        //是否保存密码    
            //     'signal'=>$signal,      //信号强度
            //     'count'=>$count         //连接次数
            // );
            $apList=array();
            $apList['list']=$this->getWifi('/tmp/aplist');
            $apList['count']=count($apList['list']); //ap总数
            return $apList;
        }

        private function getWifi($file_dir){
            if(!file_exists('/tmp/aplist')){
                die('not found wififile');
            }
            $file_arr=file($file_dir);//将每行文本转换成数组
            unset($file_arr[count($file_arr)-1]);//去除最后一行空行
            unset($file_arr[0]);//去除第一行标题
            $file_arr=array_values($file_arr);//重置索引
            $count=count($file_arr);
            $data=array();
            for($i=0;$i<$count;$i++){
                $data[$i]['ch']=trim(substr($file_arr[$i],0,4));
                $data[$i]['ssid']=trim(substr($file_arr[$i],4,33));//ap 名称
                $data[$i]['bssid']=trim(substr($file_arr[$i],37,20));//ap mac
                $data[$i]['security']=trim(substr($file_arr[$i],57,23));//ap加密方式
                $data[$i]['siganl']=trim(substr($file_arr[$i],80,9));//信号强度
                $data[$i]['mode']=trim(substr($file_arr[$i],89,8));
                $data[$i]['extch']=trim(substr($file_arr[$i],97,7));
                $data[$i]['nt']=trim(substr($file_arr[$i],104,2));
                $data[$i]['saved']=true;
                $data[$i]['count']=0;
            }
            unset($file_arr);
            //按信号强度对数组进行排序
            $siganl=array();
            foreach ($data as $key=>$value){
                $siganl[$key] = $value['siganl'];
            }
            array_multisort($siganl,SORT_NUMERIC,SORT_DESC,$data);
            unset($siganl);
            //去掉重复的wifi
            $tmp_arr=array();
            for($i=0; $i<$count; $i++){
                if(!in_array($data[$i]['ssid'], $tmp_arr)){
                    $tmp_arr[] = $data[$i]['ssid'];
                }else{
                    unset($data[$i]);
                }
            }
            unset($tmp_arr);
            $data=array_values($data);
            return $data;
        }
    }