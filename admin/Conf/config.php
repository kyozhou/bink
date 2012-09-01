<?php
return array(
	//'配置项'=>'配置值'
//文件配置
'FILE_MAX_SIZE'=>5000000,
'FILE_SAVE_PATH'=>'./Public/File/',
'FILE_ALLOW_TYPE'=>'zip,rar',

//相册配置
'PIC_MAX_SIZE'=>5000000,
'PIC_SAVE_PATH'=>'./Public/Pic/',
'PIC_ALLOW_TYPE'=>'jpg,png,bmp,jpeg,gif',
'THUMB_PRE1'=>'m_',
'THUMB1_H'=>120,
'THUMB1_W'=>140,
'THUMB_PRE2'=>'s_',
'THUMB2_H'=>60,
'THUMB2_W'=>60,

//数据库字段配置
'MENU_ONE_LENGTH'=>15,		//一级菜单长度
'MENU_TWO_LENGTH'=>15,		//二级菜单长度


//广告设置
'ADVERT_PIC_SAVE_PATH'=>'./Public/Pic/Advert/',

'TMPL_CACHE_ON'			=> false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
);
?>