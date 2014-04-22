<?php
class account extends spController
{
	function login(){ // 这里是首页
		$this->display("tpl/login.html");
	}
	function register(){ // 这里是首页
		$this->display("tpl/register.html");
	}
	function resetpassword(){ // 这里是首页
		$this->display("tpl/resetpassword.html");
	}//resetpassword
}
