<?php
define("APP_PATH",dirname(__FILE__)); 
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
	"db" => array( // 数据库设置
		'host' => 'SAE_MYSQL_HOST_M',  // 数据库地址，一般都可以是localhost
		'login' => 'SAE_MYSQL_USER', // 数据库用户名
		'password' => 'SAE_MYSQL_PASS', // 数据库密码
		'database' => 'SAE_MYSQL_DB', // 数据库的库名称
	),
	'view' => array(
		'enabled' => TRUE, // 开启Smarty
		'config' =>array(
			'template_dir' => APP_PATH.'/tpl', // 模板目录
			'compile_dir' => 'saemc://templates_c', // 编译目录
			'cache_dir' => 'saemc://cached', // 缓存目录
			'left_delimiter' => '[{',  // smarty左限定符
			'right_delimiter' => '}]', // smarty右限定符
			'auto_literal' => TRUE, // Smarty3新特性 
		),
	),
	'launch' => array( // 加入挂靠点，以便开始使用Url_ReWrite的功能
		'router_prefilter' => array( 
				array('spUrlRewrite', 'setReWrite'),  // 对路由进行挂靠，处理转向地址
			),
	 	'function_url' => array(
				array("spUrlRewrite", "getReWrite"),  // 对spUrl进行挂靠，让spUrl可以进行Url_ReWrite地址的生成
		    ),
	),
	
	'ext' => array(
		'spUrlRewrite' => array(
			'suffix' => '', 
			'sep' => '/', 
			'map' => array( 
				/*main*/
				'about' => 'main@about',
				'feedback' => 'main@feedback',
				'index' => 'main@index',
				'addnew' => 'main@addnew',
				/*account*/
				'login' => 'account@login',
				'register' => 'account@register',
				'resetpassword' => 'account@resetpassword',
				/*user*/
				'home' => 'user@home',
				/*other*/
				'@' => 'main@no' 	
			),
			'args' => array(
				 'search' => array('q','page'), 
			),
		),
	),
	
	'dispatcher_error' => "import(APP_PATH.'/404.html');exit();",
);
require(SP_PATH."/SpeedPHP.php");
spRun();