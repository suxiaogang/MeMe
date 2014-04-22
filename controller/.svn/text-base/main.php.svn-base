<?php
class main extends spController
{
	function pageTitle($url) {
		$x = file_get_contents($url);
		preg_match("/<title>(.+?)<\/title>/", $x, $match);
		if(trim($match) != "") {
			return $match[1];
		} else {
			return $url;
		}
	}

	function getTitle(){
		if($this->spArgs('type') == 1 || $this->spArgs('type') == "1"){
			$title = $this->spArgs('title');
			if(trim(title) == ""){
				$url = $this->spArgs('content');
				return $this->pageTitle($url);
			} else {
				return $title;
			}
		} else if($this->spArgs('type') == 2 || $this->spArgs('type') == "2") {
			$title = $this->spArgs('title');
			if(trim($title) == ""){
				return "未知曲目";
			} else {
				return $title;
			}
		}

	}

	function getContent(){
		if($this->spArgs('content') == ""){
			return "内容为空...";
		} else {
			return $this->spArgs('content');
		}
	}

	//*******************************************************//

	function index(){ // 这里是首页
		$todolist = spClass('todolist'); // 初始化模型类
		$conditions = ("select * from todolist order by tid desc");
		$this->results = $todolist->findSql($conditions); // 用$this->results可以将$user->findSql()的值发送到模板上
		$this->display("tpl/index.html");
	}

	function add(){
		$newrow = array( // PHP的数组
			'type' => $this->spArgs('type'),
			'time' => $showtime=date("Y-m-d H:i:s"),
			'userip' => $_SERVER["REMOTE_ADDR"],
			'useragent' => $_SERVER["HTTP_USER_AGENT"],
			'title' => $this->getTitle(),
			'content' => $this->getContent(),
		);
		$gb = spClass('todolist'); // 初始化模型类
		$gb->create($newrow);  // 进行新增操作
		$this->jump("index");
	}

	function delete(){
		$num = $this->spArgs('tid');
        $gb = spClass('todolist');
        $gb->deleteByPk($num);
	}

	function addnew(){
		$this->display("tpl/new.html");
	}

	function is_url($str){
		return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $str);
	}

	function viewCode(){
		$this->display("tpl/new.html");
	}
}
