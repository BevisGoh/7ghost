<?php
class index{
	function actionIndex(){
		header("Location:./?m=site&a=Index");
		exit();
		//include tpl('index');
	}
	
	function actionLogin(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			if(d('config')->get('password')==$_POST['password']){
				$_SESSION['logined']=true;
				header("Location:./?m=site&a=index");
				exit();
			}
			echo "√‹¬Î¥ÌŒÛ";
		}
		include tpl('login');
	}
	
	function actionLogout(){
		unset($_SESSION['logined']);
		header("Location:./");
		exit();
	}
}