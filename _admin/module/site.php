<?php
class site{
	function actionIndex(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setBase();
		}
		include tpl('siteBase');
	}
	
	function actionAdvanced(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setAdvanced();
		}
		include tpl('siteAdvanced');
	}
	
	function actionReplace(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
		}
		include tpl('siteReplace');
	}
	
	function setBase(){
		d('config')->set('host',$_POST['host']);
		d('config')->set('replaceDomain',$_POST['replaceDomain']);
		d('config')->set('relativeHTML',$_POST['relativeHTML']);
		d('config')->set('relativeCSS',$_POST['relativeCSS']);
		d('config')->set('static',$_POST['static']);
		d('config')->set('diyStatic',$_POST['diyStatic']);
	}
	
	function setAdvanced(){
		d('config')->set('cookies',$_POST['cookies']);
		
		d('config')->set('agent',$_POST['agent']);
		d('config')->set('diyAgent',$_POST['diyAgent']);
		
		d('config')->set('referer',$_POST['referer']);
		d('config')->set('diyReferer',$_POST['diyReferer']);
		
		d('config')->set('ip',$_POST['ip']);
		d('config')->set('diyIp',$_POST['diyIp']);
	}
	
	function setReplace(){
		$item['name'] = $_POST['name'];
		$item['seach'] = $_POST['seach'];
		$item['replace'] = $_POST['replace'];
		
		$replaces = d('config')->get('replaces');

		if(is_numeric($_POST['key'])){
			$replaces[$_POST['key']] = $item;
		}else{
			$replaces[] = $item;
		}
		d('config')->set('replaces',$replaces);
	}
	
	function actionEditReplace(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$msg = $this->setReplace();
		}
		
		if(is_numeric($_GET['key'])){
			$replaces = d('config')->get('replaces');
			$key = $_GET['key'];
			$item = $replaces[$key];
		}
		
		
		include tpl('editReplace');
	}
	
	function actionDelReplace(){
		if(is_numeric($_GET['key'])){
			$replaces = d('config')->get('replaces');
			unset($replaces[$_GET['key']]);
			d('config')->set('replaces',$replaces);
		}
		header("Location:./?m=site&a=Replace");
	}
}