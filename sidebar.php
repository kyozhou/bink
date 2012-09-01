
<div>
    <div class="center_right_title">分类</div>
    <div class="center_right_content">
        <ul id="center_right_content_category">
            <?php foreach($articlecls as $row){?>
            <li><a href="<?php echo ROOT."articlecls.php?id=".$row['id'];?>" class=""><?php echo $row['name'];?></a><?php echo " ({$row['num']})";?></li>
            <?php }?>
        </ul>
    </div>
</div>
<div class="fenge2"></div>

<div id="center_right_person">
    <div class="center_right_title">关于我</div>
    <div class="center_right_content">
        <a href="#"><img src="<?php echo ROOT.'css'?>/img/zhoubin.jpg" alt="Kyo周的照片" class="inline"/></a>
        <ul>
            <li class="bold f16">kyo周</li>
            <li>PHP工程师</li>
            <li>计算机学士</li>
            <li>专注WEB开发与性能优化</li>
            <li>QQ:561766366</li>
            <li>EM:kyozhou@sina.com</li>
        </ul>
    </div>
</div>
<div class="fenge2"></div>

<!--div class="side_bar_item">
    <iframe id="sina_widget_1199518923" style="width:250px; height:500px;" frameborder="0" scrolling="no" src="http://v.t.sina.com.cn/widget/widget_blog.php?uid=1199518923&height=500&skin=wd_04&showpic=1"></iframe>
</div-->