<?php
	class Template extends Woldy{
		static function Create($type,$name,$file){ //创建默认Api模板
			$tpl=require('template/'.$type.'.tpl.php');
			$apiDir=dirname($file);
			if (!is_dir($apiDir)){ //创建目录
				mkdir($apiDir,0555,true);
			} 
			if (!file_exists($file)){ //写入文件
				file_put_contents($file,$tpl); 
				die('file ['.$file.'] not exists,so i created it.' );
			} 
		}
	}