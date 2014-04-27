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
			$title = htmlentities($title, ENT_NOQUOTES, "utf-8");
			if(trim($title) == ""){
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
			$str = $this->spArgs('content');
			$str = htmlentities($str, ENT_NOQUOTES, "utf-8");
			return trim($str);
		}
	}

	//*******************************************************//

	function index(){ // 这里是首页
		$todolist = spClass('todolist'); // 初始化模型类
		$conditions = ("select * from todolist order by tid desc");
		$this->results = $todolist->findSql($conditions); // 用$this->results可以将$user->findSql()的值发送到模板上
		$this->display("tpl/index.html");
		//$this->display("tpl/error.html");

	}

	function add(){
		$newrow = array( // PHP的数组
			'type' => $this->spArgs('type'),
			'time' => $showtime=date("Y-m-d H:i:s"),
			'userip' => $_SERVER["REMOTE_ADDR"],
			'usercity' => $this->getUserCity($_SERVER["REMOTE_ADDR"]),
			'useragent' => $_SERVER["HTTP_USER_AGENT"],
			'title' => trim($this->getTitle()),
			'content' => trim($this->getContent()),
		);
		$gb = spClass('todolist'); // 初始化模型类
		$gb->create($newrow);  // 进行新增操作
		$this->jump("/"); // 跳转到speedphp.com
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
		$tid = $this->spArgs("tid"); // 用spArgs接收spUrl传过来的ID
		$todolist = spClass("todolist");  //用spClass
		$condition = array('tid'=>$tid); //查找条件
		$this->result = $todolist->find($condition);  //用find来查找，我们把$condition（条件）放了进去
		$this->display("tpl/viewCode.html");
	}

	function viewImage(){
		$tid = $this->spArgs("tid"); // 用spArgs接收spUrl传过来的ID
		$todolist = spClass("todolist");  //用spClass
		$condition = array('tid'=>$tid); //查找条件
		$this->result = $todolist->find($condition);  //用find来查找，我们把$condition（条件）放了进去
		$this->display("tpl/viewImage.html");
	}

	function viewArticle(){
		$tid = $this->spArgs("tid"); // 用spArgs接收spUrl传过来的ID
		$todolist = spClass("todolist");  //用spClass
		$condition = array('tid'=>$tid); //查找条件
		$this->result = $todolist->find($condition);  //用find来查找，我们把$condition（条件）放了进去
		$this->display("tpl/viewArticle.html");
	}

	function getUserCity($ipinfo){
		$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ipinfo;
		$ipinfo=json_decode(file_get_contents($url)); 
		if((string)$ipinfo->code=='1'){
			return false;
		}
		$city = $ipinfo->data->city;
		if($city == ""){
			$city = $ipinfo->data->country;
		}
		return $city;
	}

	function isImage($url){
		 $params = array('http' => array(
					  'method' => 'HEAD'
				   ));
		 $ctx = stream_context_create($params);
		 $fp = @fopen($url, 'rb', false, $ctx);
		 if (!$fp) 
			return false;  // Problem with url

		$meta = stream_get_meta_data($fp);
		if ($meta === false)
		{
			fclose($fp);
			return false;  // Problem reading data from url
		}

		$wrapper_data = $meta["wrapper_data"];
		if(is_array($wrapper_data)){
		  foreach(array_keys($wrapper_data) as $hh){
			  if (substr($wrapper_data[$hh], 0, 19) == "Content-Type: image") // strlen("Content-Type: image") == 19 
			  {
				fclose($fp);
				return true;
			  }
		  }
		}
		fclose($fp);
		return false;
	}

}
