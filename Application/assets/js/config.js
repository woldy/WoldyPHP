	//配置
	api_base="api.php?r=api/";
	lib_js_path=appPath+"assets/js/library/"; 	//js库
	app_js_path=appPath+"assets/js/app/";			//页面js
	lib_css_path=appPath+"assets/css/library/";	//css库
	app_css_path=appPath+"assets/css/app/";		//页面css
	tpl_path=appPath+"tpl/"				//模板路径
	default_view="start";				//默认view
	lib_js=[							//js库列表

	];

	ui_js=[								//UI库列表、与页面有较大依赖。
		lib_js_path+"amazeui.js",
		lib_js_path+"amazeui.switch.min.js"
	];

	lib_css=[							//css模板列表
		"amazeui.min.css",
		"amazeui.switch.css"
	];

