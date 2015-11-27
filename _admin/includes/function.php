<?php
//输入
function _e($str){
	echo $str;
}
//模版
function tpl($name){
	return ADIR.'template/'.$name.'.php';
}
//widget
function w($name){
	require_once(ADIR.'includes/widget.php');
    return new widget($name);
}
//data
function d($name){
	require_once(ADIR.'includes/data.php');
	static $instance=array();
    if (@is_null($instance[$name]) && preg_match("/^[a-z|0-9|A-Z|_]+$/",$name)){
    	return $instance[$name] = new data($name);
    }
    return $instance[$name];
}
//处理变量
/**
 * {g:a} = $_GET['a']
 * {p:a} = $_POST['a']
 * {v:a} = d('var')->get('a');
 * {}
 */
function v($str){
	//get
	preg_match_all('/{g:(.+?)}/',$str,$elements);
	if(!empty($elements[1]))
	foreach($elements[1] as $v){
		$str = str_replace('{g:'.$v.'}',$_GET[$v],$str);
	}
	//post
	preg_match_all('/{p:(.+?)}/',$str,$elements);
	if(!empty($elements[1]))
	foreach($elements[1] as $v){
		$str = str_replace('{p:'.$v.'}',$_POST[$v],$str);
	}
	//var
	preg_match_all('/{v:(.+?)}/',$str,$elements);
	if(!empty($elements[1]))
	foreach($elements[1] as $v){
		$str = str_replace('{v:'.$v.'}',d('var')->get('a'),$str);
	}
	return $str;
}

function siteUri(){
	$sitefolder=explode('.php', $_SERVER['PHP_SELF']);
	return trim(dirname($sitefolder[0]),DIRECTORY_SEPARATOR).'/';
}
	
function send_header($headers,$cookies=1){
	$return;
	if(is_array($headers))
	foreach($headers as $value){
		$arr=split(": ",$value);
		if($arr[0]!="Set-Cookie"){
			if($arr[0]!="Transfer-Encoding")
			header($value);
		}else{
			if($cookies){
				$arr=split(";",$arr[1]);
				$arr_value = split("=",$arr[0]);
				setcookie($arr_value[0],$arr_value[1]);
			}
		}
		if($arr[0]=="Content-Type"){
			$arr=split("; charset=",$arr[1]);
			$arr[0] = trim($arr[0]);
			$return = $arr;
		}
	}
	return $return;
}
function get_header($headers,$name=NULL){
	$return=array();
	if(is_array($headers))
	foreach($headers as $value){
		$arr=split(": ",$value);
		if(strtolower($arr[0])==strtolower($name)){
			return $arr[1];
		}
		$return[$arr[0]]=$arr[1];
	}
	if(empty($name))
		return $return;
}
function get_cookies($headers){
	$cookies = "";
	if(is_array($headers))
	foreach($headers as $value){
		$arr=split(": ",$value);
		if($arr[0]=="Set-Cookie"){
			$arr=split(";",$arr[1]);
			$arr_value = split("=",$arr[0]);
			$cookies[$arr_value[0]]=$arr_value[1];
		}
	}
	return $cookies;
}

function save_cache($name,$data){
	file_put_contents('./cache/'.$name.'.php',"<?php return '".serialize($data)."';");
}
function get_cache($name){
	if(is_null($_SERVER['cache'][$name])){
		$str = @include('./cache/'.$name.'.php');
		$_SERVER['cache'][$name] = unserialize($str);
	}
	return $_SERVER['cache'][$name];
}
function form2array($html){
	$arr=array();
	preg_match_all ("/<input.+?\>/", $html, $matches);
	foreach($matches[0] as $k=> $input){
		preg_match('/name="(.+?)"/',$input, $matches);
		$name = $matches[1];
		preg_match('/value="(.+?)"/',$input, $matches);
		$value = is_null($matches[1])?'':$matches[1];
		$arr[$name]=$value;
	}
	return $arr;
}
function get_ip(){ 
    if (@$_SERVER['HTTP_CLIENT_IP'] && $_SERVER['HTTP_CLIENT_IP']!='unknown') {   
        $ip = $_SERVER['HTTP_CLIENT_IP'];   
    } elseif (@$_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown') {   
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];   
    } else {   
        $ip = $_SERVER['REMOTE_ADDR'];   
    }   
    return $ip;   
}
/**
 * mdir加强版,支持多重文件夹建立
*/
function mdir2($path){
	$path2 = $path;
	while(!is_dir($path2)){
		$path2 = dirname($path2);
	}
	foreach (explode('/',str_replace($path2, '', $path)) as $value){
		$path2 .= $value.'/';
		if(!is_dir($path2))
			@mkdir($path2, 0777); 
	}
}

/**
 * 保存文件
 */
function save_file($filename,$data){
	$pathinfo = pathinfo($filename);
	if(in_array($pathinfo['basename'],array('.htaccess'))||$pathinfo['extension']=='php'){
		return false;
	}
	mdir2(dirname($filename));
	file_put_contents($filename, $data);
}	
?>