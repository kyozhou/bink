<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
    <head>
        <META http-equiv=Content-Type content="text/html; charset=utf-8"/>
        <LINK href="../Public/css/admin.css" type="text/css" rel="stylesheet"/>
        <title></title>
    </head>
    <BODY>
        <TABLE cellSpacing=0 cellPadding=0 width="100%" background="../Public/img/header_bg.jpg" border=0>
            <tr>
                <td><img src="../Public/img/bink.png" alt=""/></td>
                <td style="FONT-WEIGHT: bold; COLOR: #fff; PADDING-TOP: 20px; width:450px;" align="right">
		欢迎，<?php echo ($_SESSION['USER']); ?> ! &nbsp;&nbsp;&nbsp;&nbsp;
                    <a style="COLOR: #fff" href="__APP__/Index/clearcache" target=main>清除缓存</a>&nbsp;&nbsp;
                    <a style="COLOR: #fff" href="__ROOT__" target="_blank" target=_top>网站首页</a>&nbsp;&nbsp;
                    <a style="COLOR: #fff" href="__APP__/Index/welcome" target=main>后台首页</a>&nbsp;&nbsp;
                    <a style="COLOR: #fff" onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="__APP__/Login/login_out" target=_top>安全退出</a>
                </td>
                <td width="50"></td>
            </tr>
        </TABLE>
        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
            <TR bgColor=#1c5db6 height=4>
                <TD></TD>
            </TR>
        </TABLE>
    </BODY>
</html>