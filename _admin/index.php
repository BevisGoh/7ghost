<?php
	header('Content-Type: text/html; charset=gbk');
	/**
	 * 入口文件
	 */
	//error_reporting(0);
	$_GET['m'] = empty($_GET['m'])?'index':$_GET['m'];
	 //判断类型
	include_once ('./init.php');
	if(!ctype_alnum($_GET['m'])){
		echo 'm error';exit;
	}
	session_start();
	//判断是否登录
	if(empty($_SESSION['logined'])){
		include ('./module/index.php');
		$m = new index();
		$m->actionLogin();
		exit();
	}
	if(@include ('./module/'.$_GET['m'].'.php')){
		$m = new $_GET['m']();
	 	$a = empty($_GET['a'])?'actionIndex':'action'.$_GET['a'];
	 	$m->$a();
	}