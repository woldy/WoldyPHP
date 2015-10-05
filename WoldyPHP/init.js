appPath="./Application/";
corePath="./WoldyPHP/"
$LAB
	.script(appPath+"assets/js/config.js").wait()
	.script(corePath+"jsCore/jquery.min.js").wait()
	.script(corePath+"jsCore/Woldy.js").wait(function(){
		init();
	});

 