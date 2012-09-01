<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title></title>
<link href="../Public/css/main.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="all">
<table>
<tr><td class="title" colspan="2">系统信息</td></tr>
<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): ++$i;$mod = ($i % 2 )?><TR><TD width="20%"><?php echo ($key); ?></TD><TD><?php echo ($v); ?></TD></TR><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<br/>
<table>
	<tr>
		<td colspan="2" class="title">版本信息</td>
	</tr>
	<tr>
		<td width="20%">版本</td>
		<td>1.1</td>
	</tr>
	<tr>
		<td>语言</td>
		<td>PHP</td>
	</tr>
	<tr>
		<td>数据库</td>
		<td>MYSQL</td>
	</tr>
	<tr>
		<td>框架</td>
		<td>ThinkPHP , jQuery</td>
	</tr>
	<tr>
		<td>作者</td>
		<td>周斌</td>
	</tr>
</table>

</div>
</body>
</html>