<?php
	#error_reporting(0);
	define('APP_PATH', dirname(__FILE__)."/../Application/");
	define('Core_PATH', dirname(__FILE__)."/phpCore/");
	require_once(Core_PATH.'Woldy.class.php');
	
	$app=new Woldy();
	
	if(isset($argv[1])){
		$app->cmd($argv[1]);
	}
	
	
	$app->init();

	exit;

	/*
			 	说明
		----------------------------
				所有功能大概分为三种类型：
				1、获取状态		无须操作
				2、系统设置		按钮、文本框+按钮、滑块
				3、设备操作		除登录外均只有一个按钮
	*/

	/*
		 		获取状态接口/返回字段
		----------------------------
		1、		api.php?a=get&m=system		
				【系统信息】	软件版本、硬件版本、激活时间、最后更新
							芯片型号、RAM、Flah、CPU1\2

		2、  	api.php?a=get&m=network		
				【联网信息】	是否联网、无线名称、无线密码、公网IP、内网IP、网关地址、子网掩码、dns服务器、连接时间

		3、  	api.php?a=get&m=security
				【安全信息】
							安全状态(列表)：检测项、检测内容、检测时间、检测结果、安全级别
							开关状态：wifi环境感知、上网安全检测、加密通道、隐身上网、安全上报、上报交互
							各项数值统计(列表):威胁名称、总数统计、日、周、月、季度、年统计

		4、  	api.php?a=get&m=netenv
				【网络环境】	无线ap数量、开放ap数量、与当前连接热点同名ap数量、
						 	同名ap(列表)：ap名称、mac地址、加密方式、是否保存密码、信号强度、连接次数
	
		5、  	api.php?a=get&m=loglist
				【日志列表】
						 	日志(列表)：动作名称、动作代码、操作mac、操作ip、操作时间、操作内容、操作结果、安全级别、日志类型

		6、  	api.php?a=get&m=conf
				【个人设置】 	自定义图片、我的wifi名称

		7、  	api.php?a=get&m=mgrlist 
				【管理信息】 	管理员数量
						  	管理员(列表)：管理员名称、管理员mac、绑定微信号、添加时间、上次登录、是否在线、超级管理

		8、  	api.php?a=get&m=blacklist
				【黑名单】		黑名单数量
							黑名单(列表)：客户端名称、客户端mac、操作者、拉黑时间

		9、  	api.php?a=get&m=clientlist
				【客户端】		客户端数量
							客户端(列表)：客户端名称、客户端mac、客户端ip、连入时间、是否安全

		10、  	api.php?a=get&m=aplist
				【AP列表】		AP数量
							AP(列表)：ap名称、ap mac、加密方式、是否保存过密码、信号强度、连入次数、是否自动连接

		11、  	api.php?a=get&m=savedlist 			
				【已保存AP】	AP数量
							AP(列表)：ap名称、加密方式、保存时间、经度、维度、是否在范围内、连接次数、是否自动连接

		12、  	api.php?a=get&m=usbdisk
				【U盘状态】	是否存在U盘、当前路径、文件总数
							文件(列表)：项目名称、项目类型、是否加密、是否分享、文件大小、创建时间

		13、  	api.php?a=get&m=share
				【共享信息】	文件总数
							文件(列表)：项目名称、项目类型、是否加密、是否分享、文件大小、创建时间
	*/

	/*
		 		系统设置接口/传入参数
		----------------------------
		1、		api.php?a=set&m=connect
				【联网设置】：SSID、密码、是否保存、是否自动连接

		2、  	api.php?a=set&m=mywifi
				【我的wifi】：SSID、密码

		3、  	api.php?a=set&m=password
				【密码设置】：原密码、新密码

		4、  	api.php?a=set&m=mannger
				【管理员设置】：mac地址

		5、  	api.php?a=set&m=radio
				【滑块开关】：名称(wifi环境感知、上网安全检测、加密通道、隐身上网、安全上报、上报交互),值

		6、  	api.php?a=set&m=black
				【黑名单】：mac地址,加入/移除

		7、  	api.php?a=set&m=kick
				【踢人】：mac地址,加入/移除

		8、  	api.php?a=set&m=mypic
				【自定义图片】:图片

		9、  	api.php?a=set&m=share
				【共享文件】:文件路径,有效期

		10、  	api.php?a=set&m=encode
				【加密文件】:文件路径,密钥

		11、  	api.php?a=set&m=delap
				【删除已保存ap】:id
	*/

	/*
		 		设备操作接口列表
		----------------------------
		1、		api.php?a=op&m=sysupgrade			系统升级
				返回版本信息并升级或提示无须升级

		2、  	api.php?a=op&m=reboot 				重启系统

		3、  	api.php?a=op&m=restore 				重置系统

		4、		api.php?a=op&m=login 				登录系统
				传入登录密码

		5、		api.php?a=op&m=reconnect 			重新连接
				返回成功

		6、		api.php?a=op&m=disconnect 			断开连接
				返回成功
	*/

	/*
		 		内部接口列表
		----------------------------
		1、		api.php?a=op&m=location 			上报位置
		2、		api.php?a=op&m=log 	 				上报日志
 	*/