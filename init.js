version=0.16
appPath="./Application/";
corePath="./WoldyPHP/"
api_base="/WoldyPHP/api.php?r=";
$LAB
	.script(appPath+"assets/js/config.js?ver="+version).wait()
	.script(corePath+"jsCore/jquery.min.js?ver="+version).wait()
	.script(corePath+"jsCore/Woldy.js?ver="+version).wait(function(){
		init();
	});

 