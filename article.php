<?php
include 'engine/app.php';
require 'common.php';
$id = is_numeric($_GET['id']) ? $_GET['id'] : 0;
if ($id <= 0)
    die;

$sql = "select a.*,c.name as cname from #pre#article as a
                left join #pre#articlecls as c on a.classes=c.id
                where a.id=$id and a.is_show='Y' and a.is_recycled='N' limit 1";
$rs = query($sql); //echo $sql;
if (mysql_affected_rows() > 0) {
    $article = mysql_fetch_array($rs);
} else {
    die;
}
query("update #pre#article set clk_times=clk_times+1 where id=" . $id);
$menu_current = "article.php?id=$id";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include "head.php"; ?>
    </head>
    <body>
<?php include "header.php"; ?>
        <div id="center">
            <!--div id="center_map">
                <ul>
                    <li></li>
                </ul>
            </div-->
            <div id="center_article">
                <div id="center_article_title"><?php echo $article['title']; ?></div>
                <div id="center_article_subtitle">最后更新时间：<?php echo date('Y-m-d H:i', $article['last_update']); ?></div>
                <div class="fenge2"></div>
                <div id="center_article_content"><?php echo $article['content']; ?></div>
            </div>
        </div>

        </div>
<?php include "footer.php"; ?>
    </body>
</html>