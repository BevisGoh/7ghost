<?php
class widget{
	private $_types=array('text','password','textarea','select');
	private $_type='text';
	private $_info;
	
	function widget($type){
		$this->_type = $type;
	}
	
	function set($name,$value){
		$this->_info[$name] = $value;
		return $this;
	}
	
	//×ª»»³É×Ö·û´®
	function __tostring(){
		ob_star();
		$this->e();
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
	
	//Êä³ö
	function e(){
		$info = $this->_info;
		include(ADIR.'template/_widget/'.$this->_type.'.php');
		return $this;
	}
}