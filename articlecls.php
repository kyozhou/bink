<?php
include 'engine/app.php';
require 'common.php';
$id = !empty($_GET['id'])&&is_numeric($_GET['id'])?$_GET['id']:0;
$pageNumber = !empty($_GET['page_number'])?$_GET['page_number']:1;
$pageSize = 20;
$where = "";
$whereCount = "";
if($id>0){ 
    $where = " and c.id=$id ";
    $whereCount = " and classes=$id ";
}
$sql = "select count(id) as rowCount from #pre#article where is_show='Y' and is_recycled='N' $whereCount";
$result = queryArray($sql);
$resultCount = 0;
if(!empty($result)){
    $resultCount = $result[0]['rowCount'];
}
$pageCount = (int)(($resultCount-1)/$pageSize)+1;
$pagePre = $pageNumber-1<1?1:$pageNumber-1;
$pageNext = $pageNumber+1>$pageCount?$pageCount:$pageNumber+1;
$limit = " limit ".(($pageNumber-1)*$pageSize).", $pageSize";

$sql = "select a.id,a.title,a.classes, a.last_update ,c.name as cname from #pre#article as a
                left join #pre#articlecls as c on a.classes=c.id
                where is_show='Y' and is_recycled='N' $where 
                order by last_update desc
                $limit ";
$articles = query($sql);

if(mysql_affected_rows()<=0 ){
    die;
}
$menu_current = "articlecls.php";
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
                <div class="center_left_title"><a href="articlecls.php" class="f18 hui1">文章列表</a></div>
                <div class="center_left_title_right pager f16">
                    <?php if($pageNumber>1){?><a href="?page_number=1">首页</a><?php }else{ echo '首页';};?>
                    <?php if($pageNumber>1){?><a href="?page_number=<?php echo $pagePre;?>">上一页</a><?php }else{ echo '上一页';};?>
                    <?php if($pageNumber<$pageCount){?><a href="?page_number=<?php echo $pageNext;?>">下一页</a><?php }else{ echo '下一页';};?>
                    <?php if($pageNumber<$pageCount){?><a href="?page_number=<?php echo $pageCount; ?>">尾页</a><?php }else{ echo '尾页';};?>
                    (<?php echo $pageNumber.'/'.$pageCount;?>)
                </div>
                <div id="center_left_articlecls">
                    <?php $p=0; while($row = mysql_fetch_array($articles)){?>
                    <dl <?php if($p%2==0){echo 'style="background-color:#eee;"';} ?>>
                        <dt class="center_left_articlecls_class">
                            【<a href='<?php echo ROOT.'articlecls.php?id='.$row['classes'];?>'><?php echo $row['cname'];?></a>】
                        </dt>
                        <dt class="center_left_articlecls_title f16">
                            <a href='<?php echo ROOT.'article.php?id='.$row['id'];?>'><?php echo $row['title'];?></a>
                        </dt>
                        <dd><?php echo date('Y-m-d H:i',$row['last_update']);?></dd>
                    </dl>
                    <?php $p++;}?>
                    
                </div>
                
            </div>
            <div class="fenge1"></div>
            <div id="center_right">
                <?php include "sidebar.php";?>
            </div>
        </div>
        <?php include "footer.php";?>
    </body>
</html>
