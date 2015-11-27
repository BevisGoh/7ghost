<?php
class page{
	function actionIndex(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setPage();
		}
		include tpl('pageList');
	}
		
	function actionEdit(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setPage();
			header("Location:./?m=page&a=Index");
		}
		
		if(is_numeric($_GET['key'])){
			$pages = d('config')->get('pages');
			$key = $_GET['key'];
			$item = $pages[$key];
		}
		include tpl('editPage');
	}
	
	function actionDel(){
		if(is_numeric($_GET['key'])){
			$pages = d('config')->get('pages');
			$key = $_GET['key'];
			unset($pages[$key]);
			d('config')->set('pages',$pages);
			header("Location:./?m=page&a=Index");
		}
	}
	
	function actionAdvanced(){
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setAdvanced();
		}
		$key = $_GET['key'];
		$pages = d('config')->get('pages');
		$page = $pages[$key];
		include tpl('pageAdvanced');
	}
	
	function actionReplace(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
		}
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		$key = $_GET['key'];
		$pages = d('config')->get('pages');
		$page = $pages[$key];
		include tpl('pageReplace');
	}
	
	function actionEditReplace(){
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		$page = $pages[$key];
		$item = $page['replaces'][$_GET['rekey']];
		
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
			header("Location:./?m=page&a=replace&key=$key");
		}
		include tpl('editPageReplace');
	}
	
	function actionDelReplace(){
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		if(!is_numeric($_GET['rekey'])){
			exit('error');
		}
		
		$pages = d('config')->get('pages');
		$key = $_GET['key'];
		$page = $pages[$key];
		unset($page['replaces'][$_GET['rekey']]);
		$pages[$key]=$page;
		d('config')->set('pages',$pages);

		header("Location:./?m=page&a=replace&key=$key");
	}
	
	function setAdvanced(){
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		$key = $_GET['key'];
		$pages = d('config')->get('pages');
		$page = $pages[$key];
		
		$page['cookies']=$_POST['cookies'];
		
		$page['agent']=$_POST['agent'];
		$page['diyAgent']=$_POST['diyAgent'];
		
		$page['referer']=$_POST['referer'];
		$page['diyReferer']=$_POST['diyReferer'];
		
		$page['ip']=$_POST['ip'];
		$page['diyIp']=$_POST['diyIp'];
		
		$pages[$key] =$page;
		$pages = d('config')->set('pages',$pages);
	}
	
	function setPage(){
		$item['name'] = $_POST['name'];
		$item['uri'] = $_POST['uri'];
		$item['host'] = $_POST['host'];
		$item['replaceDomain'] = $_POST['replaceDomain'];
		$item['returnType'] = $_POST['returnType'];
		$item['relativeHTML'] = $_POST['relativeHTML'];
		$item['relativeCSS'] = $_POST['relativeCSS'];
		$item['template'] = $_POST['template'];
		
		$pages = d('config')->get('pages');

		if(is_numeric($_POST['key'])){
			$pages[$_POST['key']] = $item;
		}else{
			$pages[] = $item;
		}
		d('config')->set('pages',$pages);
	}

	function setReplace(){
		if(!is_numeric($_GET['key'])){
			exit('error');
		}
		
		$item['name'] = $_POST['name'];
		$item['seach'] = $_POST['seach'];
		$item['replace'] = $_POST['replace'];
		
		$pages = d('config')->get('pages');
		$replaces = $pages[$_GET['key']]['replaces'];

		if(is_numeric($_POST['rekey'])){
			$replaces[$_POST['rekey']] = $item;
		}else{
			$replaces[] = $item;
		}
		$pages[$_GET['key']]['replaces'] = $replaces;
		d('config')->set('pages',$pages);
	}
}