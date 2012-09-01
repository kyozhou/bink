<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv='Refresh' content='3;URL=<?php echo ($url); ?>'>
<title><?php if(empty($error)): ?>操作成功<?php else: ?>操作失败<?php endif; ?></title>
<style type="text/css">
<!--
#center {
	height: 150px;
	width: 500px;
	margin-top: 100px;
	margin-right: auto;
	margin-left: auto;
	border: 2px solid #999;
	text-align: center;
}

#head {
	height: 40px;
	width: 100%;
	border-bottom-width: 2px;
	border-bottom-style: solid;
	border-bottom-color: #999;
	text-align: center;
	padding-top: 5px;
	padding-bottom: 5px;
	font-size: 35px;
	color: #F00;
	background-color: #CCC;
}

#center span {
	font-size: 15px;
	font-weight: 900;
	margin-top: 10px;
	float: left;
	margin-left: 50px;
}
#center a   {
	text-decoration: none;
	margin-right: 5px;
	margin-left: 5px;
}
#center a:visited {
	text-decoration: none;
}
#content {
}
-->
</style>
</head>
<body>
<div id="center">
<div id="head"><?php if(empty($error)): ?><?php echo ($message); ?><?php else: ?><?php echo ($error); ?><?php endif; ?></div>
<div id="content">
<p>系统将在3秒内跳转，您可以选择：</p>
<a href="<?php echo ($url); ?>">快速跳转</a>
<a href="__APP__/Index/welcome">后台首页</a>
<a href="__ROOT__" target="_top">打开首页</a>
</div>
</div>
</body>
</html>