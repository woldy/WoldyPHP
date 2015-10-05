	view=get('v'); 	//主视图
	model=get('m');	//模型视图
	model_path='';


	//初始化、加载common库
	function init(){
		if(view==null){
			view=default_view;
		}
		model_path=view;
		$LAB.setGlobalDefaults({AllowDuplicates:true});  //允许重复加载
		initLab();
    	if(model){
    		loadModel(model);
    	}
	}
	
	//加载各种库
	function initLab(){	
		loadJs(app_js_path+"common.js");

    	for (var i = 0; i < lib_css.length; i++) {
        	 loadCss(lib_css_path+lib_css[i]);
    	};

    	if(lib_js.length>0){
			loadJS(lib_js,true);
		}
       	
    	loadCss(app_css_path+"common.css");
    	loadCss(app_css_path+view+".css");
    	loadJs(app_js_path+view+".js");
	}

	//加载模板
	function loadTpl(path,element,isModel){
		$.ajax({  
         	type:'get',      
         	url:tpl_path+path,  
         	cache:false,  
         	dataType:'html',  
         	success:function(data){
         		$(element).html($(element).html()+data);
         		if(isModel){
         			model_js=ui_js;
         			if(model_path!=view){
         				model_js.push(app_js_path+model_path+".js");
         			}     
					loadJs(model_js,true); //加载js  
					loadCss(app_css_path+model_path+".css"); //加载对应css
         		}
         	}  
     	});  
	}


	//加载模块
	function loadModel(model,reload){
    	if(reload){
			removeModel();
    	}
    	model_path=view+"/"+model;
    	loadTpl(model_path+'.tpl','.wp',true); //加载模型模板与相应css
	}

	//移除模块
	function removeModel(){
    	$('.wp').html('');
    	removeCss(app_css_path+model_path+".css")
    	removeJs(app_js_path+model_path+".js")
	}

	//加载JS
	function loadJs(path,init){
		if(typeof(path)=='string'){
    			$LAB.script(path);
		}else{
			jsLink='';
			for (var i = 0; i < path.length; i++) {
				jsLink=jsLink+'.script("'+path[i]+'").wait()';
    		};
    		if(init){
    			jsLink="$LAB"+jsLink+'.wait(function(){modelInit();})';
    		}else{
    			jsLink="$LAB"+jsLink;
    		}
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

	//取GET方法参数
	function get(name){
     	var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     	var r = window.location.search.substr(1).match(reg);
     	if(r!=null)return  unescape(r[2]); return null;
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
	function modelInit(){
    	if(function_exists('pageStart')){
    		pageStart();
    	} 
	}
	
	function Api(op,data,callback){  //框架Api调用
		if(model===null){
			apipath=view+'/'+view+'/';
		}else{
			apipath=view+'/'+model+'/';
		}
		
        $.ajax({  
            type: "post",  
            url: api_base+apipath+op,
            data: data,  
            success: callback,  
            error: function () {  
				alert('请求失败！');
            }  
		});  
	}
	
	function render(data){
		if(typeof(data)=='string'){
			alert(data);
		};
		$.each(data.render,function(key,value){
			obj=$('#v_'+key)[0];
			if(!obj){
				return true;
			}
			objType=obj.type;
			
			if(objType=='text' || objType=='password'){ //文本框或密码框
				$(obj).val(value);
			}else if(objType=='checkbox'){	//滑块
				state=value=='on'?true:false;
				$(obj).bootstrapSwitch('state', state);
			}else{ //标签
				$(obj).html(value);
			}
		});
	}