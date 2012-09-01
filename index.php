<?php
include 'engine/app.php';
require 'common.php';
$articles = query("select a.*,c.name as cname from #pre#article as a
                left join #pre#articlecls as c on a.classes=c.id
                where is_show='Y' and is_recycled='N' order by last_update desc limit 10");
$menu_current = "index.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php include "head.php";?>
    </head>
    <body>
        <?php include "header.php";?>
        <div id="center">
            <div id="center_left">
                <div id="center_left_article">
                    <?php while($row = mysql_fetch_array($articles)){?>
                    <dl>
                        <dt>
                            <span class="center_left_article_title"><a href="<?php echo ROOT."article.php?id=".$row['id'];?>"><?php echo $row['title'];?></a></span>
                            <span class="center_left_article_info"><?php echo date('Y-m-d H:i',$row['last_update']);?></span>
                        </dt>
                        <dd class="center_left_article_content">
                            <?php echo msubstr(trim(strip_tags($row['content'])),0,200,"utf-8", true);?>
                        </dd>
                        <dd class="center_left_article_bottom">
                            分类：<a href="<?php echo ROOT."articlecls.php?id=".$row['classes'];?>"><?php echo $row['cname'];?></a>，
                            <!--a href="#">评论(0)</a-->
                            <a href="<?php echo ROOT."article.php?id=".$row['id'];?>">浏览(<?php echo $row['clk_times'];?>)</a>
                            <a href="<?php echo ROOT."article.php?id=".$row['id'];?>" class="lan1">查看全文</a>
                        </dd>
                    </dl>
                    <?php }?>
                    <div id="center_left_article_more">
                        <a href="articlecls.php" class="font16">More&nbsp;&gt;&gt;&gt;</a>
                    </div>
                    <div class="fenge2"></div>
                    
                </div>
                
            </div>
            <div class="fenge1"></div>
            <div id="center_right">
                <?php include "sidebar.php";?>
            </div>
        </div>
        <?php require "footer.php";?>
    </body>
</html>