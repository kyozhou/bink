<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<LINK href="../Public/css/admin.css" type="text/css" rel="stylesheet">
<SCRIPT language=javascript>
	function expand(el)
	{
		childObj = document.getElementById("child" + el);

		if (childObj.style.display == 'none')
		{
			childObj.style.display = 'block';
		}
		else
		{
			childObj.style.display = 'none';
		}
		return;
	}
</SCRIPT>
</HEAD>
<BODY>
<TABLE height="100%" cellSpacing=0 cellPadding=0 width=170 
background=../Public/img/menu_bg.jpg border=0>
  <TR>
    <TD vAlign=top align=middle>
      <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        
        <TR>
          <TD height=10></TD></TR></TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height='22'><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(1) href="javascript:void(0);">编辑菜单</A></TD></TR>
			<TR height='4'><TD></TD></TR>
		</TABLE>
		<TABLE id=child1 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Menu/index" target=main>菜单编辑</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Menu/classes" target=main>菜单类别</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE id=child2 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Bulletin/op" target=main>公告管理</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Bulletin/advert" target=main>广告管理</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(3) href="javascript:void(0);">文章管理</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child3 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Article/add" target=main>发布文章</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Article/op" target=main>文章操作</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Article/classes" target=main>文章类别</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(4) href="javascript:void(0);">下载管理</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child4 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Download/add" target=main>文件上传</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Download/op" target=main>文件管理</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Download/classes" target=main>文件类型</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(5) href="javascript:void(0);">图片管理</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child5 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Album/add" target=main>图片上传</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Album/op" target=main>图片操作</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Album/classes" target=main>图片类别</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(6) href="javascript:void(0);">留言互动</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child6 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Message/op" target=main>留言操作</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Message/classes" target=main>留言类别</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Poll/op" target=main>投票管理</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background=../Public/img/menu_bt.jpg><A class=menuParent onclick=expand(7) href="javascript:void(0);">系统设置</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child7 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Template/front" target=main>模板设置</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Config/op" target=main>配置管理</A></TD></TR>
                        <TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Bulletin/op" target=main>公告管理</A></TD></TR>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Bulletin/advert" target=main>广告管理</A></TD></TR>
                        <TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Account/op" target=main>账号管理</A></TD></TR>
                        <TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE id=child8 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
		<TABLE cellSpacing=0 cellPadding=0 width=150 border=0>
			<TR height=22><TD style="PADDING-LEFT: 30px" background='../Public/img/menu_bt.jpg'><A class=menuParent onclick=expand(9) href="javascript:void(0);">关于</A></TD></TR>
			<TR height=4><TD></TD></TR>
		</TABLE>
		<TABLE id=child9 style="DISPLAY: none" cellSpacing=0 cellPadding=0  width=150 border=0>
			<TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Public/about" target=main>关于</A></TD></TR>
                        <TR height=20><TD align=middle width=30><IMG height=9 src="../Public/img/menu_icon.gif" width=9></TD><TD><A class=menuChild href="__APP__/Public/help" target=main>使用帮助</A></TD></TR>
			<TR height=4><TD colSpan=2></TD></TR>
		</TABLE>
     </TD>
    <TD width=1 bgColor=#d1e6f7></TD></TR></TABLE></BODY></HTML>