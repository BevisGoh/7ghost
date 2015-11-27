<?php
	//error_reporting(0);
	require './_admin/init.php';
	//读取配置信息
	$config  = d('config')->get();
	
	//当前根url
	$rootUrl = 'http://'.$_SERVER['HTTP_HOST'].siteUri();
	$snoopy = new Snoopy();
	$uri = substr($_SERVER['REQUEST_URI'],strlen(siteUri()));
	//匹配自定义页面，合并参数
	foreach($config['pages'] as $page){
		if(@ereg($page['uri'],$uri)){
			if(!empty($page['replaces'])){
				$config['replaces'] = array_merge($config['replaces'],$page['replaces']);
			}
			if(!empty($page['host'])){
				$uri = substr($uri,strlen(dirname($page['uri']))+1);
			}else{
				unset($page['host']);
			}
			unset($config['pages']);
			$config = array_merge($config,$page);
			break;
		}
	}
	//获取要请求的url
	$url = $config['host'].$uri;
	//当前请求的文件后缀
	$thisExt = pathinfo($_SERVER['PATH_INFO'],PATHINFO_EXTENSION);
	//静态文件
	if(in_array($thisExt,explode("|",$config['diyStatic']))){
		$filename = dirname(ADIR).'/'.substr($_SERVER['REDIRECT_URL'],strlen(siteUri()));
		//如果存在，直接输出
		if(is_file($filename)){
			echo file_get_contents($filename);
			exit();
		}
	}
//-------------设置请求头信息------------
	//设置cookie
	switch($config['cookies']){
		case 1://全局cookies
			$snoopy->cookies = get_cache('cookies');
			break;
		case 2://自定义COOKIES
			$snoopy->cookies = $config['diyCookies'];
			break;
		default://传统cookies
			$snoopy->cookies = $_COOKIE;
			break;
	}
	
	//设置agent
	switch($config['agent']){
		case 1://不伪造
			break;
		case 2://自定义agent
			$snoopy->agent = $config['diyAgent'];
			break;
		default://使用客户端agent
			$snoopy->agent = $_SERVER['HTTP_USER_AGENT'];
			break;
	}
	
	
	//设置referer
	switch($config['referer']){
		case 1://自定义referer
			$snoopy->referer = $config['diyReferer'];;
			break;
		default://自动伪造
			$snoopy->referer = str_replace($rootUrl,$config['host'],$_SERVER['HTTP_REFERER']);
			if($snoopy->referer==$_SERVER['HTTP_REFERER'])
			$snoopy->referer = '';
			break;
	}
	
	//设置ip
	switch($config['ip']){
		case 1://使用客户端ip
			$snoopy->rawheaders["X_FORWARDED_FOR"] = get_ip(); //伪装ip 
			break;
		case 2://自定义ip
			$snoopy->referer = $config['diyReferer'];;
			break;
		default://使用服务器ip
			break;
	}
	
	//-------其他头信息 begin--
	
	//-------其他头信息 end----
	
	//是否补全链接
	$snoopy->expandlinks = true;
	
//--------------抓取网页-----------------
	//判断是POST还是GET
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$snoopy->submit($url,$_POST);
	}else{
		$snoopy->fetch($url);
	}
//---------------处理返回信息------------
		//设置cookie
	switch($config['cookies']){
		case 1://全局cookies
			$snoopy->cookies = set_cache('cookies');
			break;
		default:
			break;
	}
	$contentType = send_header($snoopy->headers);
	$charset = empty($contentType[1])?'utf-8':$contentType[1];
	$charset = trim($charset,"\n\r");
	
	//替换域名 relativeHTML relativeCSS
	if(empty($config['replaceDomain'])){
		if(in_array($thisExt,array('','php','html'))){
			//替换域名
			$snoopy->results = str_replace($config['host'],$rootUrl,$snoopy->results);
		}
	}
	
	//替换相对地址relativeHTML
	if(empty($config['replaceDomain'])){
		if(in_array($thisExt,array('','php','html'))){
			$snoopy->results = str_replace('="/','="'.siteUri(),$snoopy->results);
			$snoopy->results = str_replace('=\'/','=\''.siteUri(),$snoopy->results);
			$snoopy->results = preg_replace('/<base href=.*?\/>/','',$snoopy->results);
		}
	}
	
	//替换CSS相对地址
	if(empty($config['relativeCSS'])){
		if(in_array($thisExt,array('css'))){
			$snoopy->results = str_replace('url("/','url("'.siteUri(),$snoopy->results);
		}
	}
	
	//内容替换
	if(is_array($config['replaces'])&&!empty($config['replaces']))
	
	foreach($config['replaces'] as $replace){
		$seach = addcslashes(iconv("gb2312",$charset,v($replace['seach'])),'/');
		$replace = iconv("GB2312",$charset,v($replace['replace']));
		$snoopy->results = preg_replace('/'.$seach.'/',$replace,$snoopy->results);
	}
	
	//模版
	if(!empty($config['template'])){
		@include(ADIR.'data/tpl/'.$config['template']);
		exit();
	}
	//静态文件
	if(in_array($thisExt,explode("|",$config['diyStatic']))){
		$filename = dirname(ADIR).'/'.substr($_SERVER['REDIRECT_URL'],strlen(siteUri()));
		save_file($filename,$snoopy->results);
	}
	
	//输出
	echo $snoopy->results;
	//echo htmlspecialchars($snoopy->results);