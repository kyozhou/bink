<?php
define('FW_PATH', './fw');
//定义项目名称和路径 默认放在admin目录下
define('APP_NAME', 'admin');
define('APP_PATH', './admin');
// 加载框架入口文件
require(FW_PATH."/index.php");
//实例化一个网��;
$App = new App();
//应用程序�
$App->run();
?>
