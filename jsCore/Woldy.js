	page=get('p'); 



	//初始化、加载common库
	function init(){
		if(page==null){
			page=default_page;
		}
		$LAB.setGlobalDefaults({AllowDuplicates:true});  //允许重复加载
		initLab();
	}
	
	//加载各种库
	function initLab(){	
		loadJs(app_js_path+"common.js?ver="+version);

    	for (var i = 0; i < lib_css.length; i++) {
        	 loadCss(lib_css_path+lib_css[i]); //必要的css
    	};

    	if(lib_js.length>0){
			loadJS(lib_js,true);//必要的js
		}
       	
    	loadCss(app_css_path+"common.css?ver="+version);
    	loadCss(app_css_path+page+".css?ver="+version);
    	loadJs(app_js_path+page+".js?ver="+version);
	}

	//加载模板
	function loadTpl(path,element,isPage){
		$.ajax({  
         	type:'get',      
         	url:tpl_path+path+"?ver="+version,   
         	dataType:'html',  
         	success:function(data){
         		$(element).html($(element).html()+data);
     //     		if(isModel){
          			model_js=ui_js.slice(0);
     //     			if(model_path!=view){
     //     				model_js.push(app_js_path+model_path+".js?ver="+version);
     //     			}     
					loadJs(model_js,true); //加载js  
					if(isPage) pagelInit();
					// loadCss(app_css_path+model_path+".css?ver="+version); //加载对应css
     //     		}
         	}  
     	});  
	}


 

	//加载JS
	function loadJs(path,init){
		
		if(typeof(path)=='string'){
    			$LAB.script(path);
		}else if(typeof(path)=='object'){
			jsLink='';
			for (var i = 0; i < path.length; i++) {
				jsLink=jsLink+'.script("'+path[i]+'").wait()';
    		};
    		if(init){
    			jsLink="$LAB"+jsLink+'.wait(function(){pageInit();})';
    		}else{
    			//jsLink="$LAB"+jsLink;
			}
			//console.log(path);
			//console.log(jsLink);
    		eval(jsLink);	
		}
		
	}

	//移除JS
	function removeJs(path){
		$("script[src$='"+path+"']").remove(); 
	}

	//移除CSS
	function removeCss(path){
		$("link[href$='"+path+"']").remove(); 
	}

	//加载css
	function loadCss(path){
		var head = document.getElementsByTagName('head')[0];
        var link = document.createElement('link');
        link.href = path;
        link.rel = 'stylesheet';
        link.type = 'text/css';
        head.appendChild(link);
	}

	function getUrlParams() {
  		var search = window.location.search;
  		// 写入数据字典
  		var tmparray = search.substr(1, search.length).split("&");
  		var paramsArray = new Array;
  		if (tmparray != null) {
   			for (var i = 0; i < tmparray.length; i++) {
   				var reg = /[=|^==]/;    // 用=进行拆分，但不包括==
    			var set1 = tmparray[i].replace(reg, '&');
    			var tmpStr2 = set1.split('&');
    			var array = new Array;
    			array[tmpStr2[0]] = tmpStr2[1];
   				paramsArray.push(array);
   			}
  		}
  		// 将参数数组进行返回
  		return paramsArray;
 	}

	//取GET方法参数
	function get(name){
		var paramsArray = getUrlParams();
  		if (paramsArray != null) {
  			for (var i = 0; i < paramsArray.length; i++) {
    			for (var j in paramsArray[i]) {
     				if (j == name) {
      					return paramsArray[i][j];
     				}
    			}
   			}
  		}
  		return null;
	}

	//设置title
	function title(text){
		$("title").html(text); 
	}

	//检查函数是否存在
	function function_exists(funcName) {
    	try {
        	if (typeof(eval(funcName)) == "function") {
            	return true;
        	}
    	} catch(e) {}
    	return false;
	}

	//模块初始化
	function pagelInit(){
    	if(function_exists('pageStart')){
    		pageStart();
    	} 
	}
	
	function Api(act,data,callback){  //框架Api调用
		apipath=page+"/";
		//console.log(op);
        $.ajax({  
            type: "post",  
            url: api_base+apipath+act,
            data: data,  
            success: callback,  
            error: function (data){
				data.errcode=1;
				//alert('请求失败！');
				callback();
				console.log('请求失败！'+apipath);
            }  
		});  
	}
	
	function render(data,hideno){
		if(typeof(data)=='string'){
			alert(data);
		};
		if(typeof(arguments[1])=='undefined'){
			hideno=false;
		}else{
			hideno=true;
		}
		if(data.errcode==-1){
			jump('/');
		}
		
		$.each(data.render,function(key,value){
			obj=$('#v_'+key)[0];
			if(!obj){
				return true;
			}
			
			console.log(key+"---"+typeof(key));
			
			objType=obj.type;
			
			if(objType=='text' || objType=='password'){ //文本框或密码框
				$(obj).val(value);
			}else if(objType=='checkbox'){	//滑块
				state=value=='on'?true:false;
				$(obj).bootstrapSwitch('state', state);
			}else{ //标签
				if((value==null ||value=='') && hideno){
					$(obj).parent().hide();
				}else{
					$(obj).parent().show();
				}
				$(obj).html(value);
			}
		});
		has_render=true;
	}