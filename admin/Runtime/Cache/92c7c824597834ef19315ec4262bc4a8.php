<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script type='text/javascript' src='__PUBLIC__/Js/jquery.js'></script>
        <link type="text/css" rel="stylesheet" rev="stylesheet"
              href="../Public/css/main.css" media="all" />
    </head>
    <body>
        <div class="all">
            <table>
                <tr>
                    <td colspan="4" class="title">文章操作</td>
                </tr>
                <tr>
                    <td colspan="4" class="td_right">
                        <span class="font01">文章类别</span>
                        <select name="classes" id="classes">
                            <option value="">---全部---</option>
                            <?php if(is_array($classes_list)): $i = 0; $__LIST__ = $classes_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$classes_vo): ++$i;$mod = ($i % 2 )?><?php if($classes_vo["id"] == $classes): ?><option value="<?php echo ($classes_vo["id"]); ?>" selected="selected" ><?php echo ($classes_vo["name"]); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo ($classes_vo["id"]); ?>" ><?php echo ($classes_vo["name"]); ?></option><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50">ID</td>
                    <td width="100">类别</td>
                    <td>文章标题</td>
                    <td width="200">操作</td>
                </tr>

                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td class="td_left"><?php echo ($vo["cls_name"]); ?></td>
                        <td class="td_left"><a href="__APP__/Article/update/ID/<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?></a></td>
                        <td>
                            <input type="button" name="update" id="update" value="更新" onClick="window.location.href='__APP__/Article/update/ID/<?php echo ($vo["id"]); ?>'">
                            <input type="submit" name="delete" id="delete" value="删除" onClick="if(confirm('确定删除吗？')==false) return false;window.location.href='__APP__/Article/news_delete/ID/<?php echo ($vo["id"]); ?>'">
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td colspan="4"><?php echo ($page); ?></td>
                </tr>
            </table>
        </div>

    </body>
</html>