<div id="top">
    <div id="banner">
        <h1>KyoZhou's Blog<sup>beta</sup></h1>
        <div>周斌的博客：PHP,CSS,JAVASCRIPT,HTML &amp; 日常琐事</div>
    </div>
    <div id="menu">
        <ul>
            <li><a href="index.php">首页</a></li>
            <?php $rs = query("select name,href,target from ".PREFIX."menu where father_id=0 and isshow='Y'");?>
            <?php while($row = mysql_fetch_assoc($rs)){?>
                <li><a href="<?php echo $row['href'];?>"><?php echo $row['name'];?></a></li>
            <?php }?>
        </ul>
    </div>
</div>
<script type="text/javascript">
$("#menu a[href*=\"<?php echo empty($menu_current)?'index.php':$menu_current;?>\"]").attr('class','menu_current');
</script>
