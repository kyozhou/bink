<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
        <link href="../Public/css/main.css" rel="stylesheet" type="text/css" />
        <script type='text/javascript' src='__PUBLIC__/Js/jquery.js'></script>
        <script charset="utf-8" src="__ROOT__/edt/kindeditor.js"></script>
        <script>
            KE.show({
                id : 'content',
                imageUploadJson : '__ROOT__/edt/php/upload_json.php',
                fileManagerJson : '__ROOT__/edt/php/file_manager_json.php',
                resizeMode : 1,
                allowFileManager : true/*,
                items : [
				'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']*/
            });
        </script>
    </head>

    <body>
        <div class="all">
            <form action="__APP__/Article/news_update" method="post">
                <table>
                    <tr>
                        <td colspan="2" class="title">文章更新</td>
                    </tr>
                    <tr>
                        <td>文章标题</td><td class="td_left"><input type="text" name="title" value="<?php echo ($title); ?>" disabled="disabled" size="50"/></td></tr>
                    <tr>
                        <td>文章作者</td><td class="td_left"><input type="text" name="author" value="<?php echo ($author); ?>" /></td></tr>

                    <tr>
                        <td>是否置顶</td><td class="td_left">
                            <?php if($is_top == 1): ?><input type="radio" name="is_top" value="1" id="RadioGroup1_0" checked/>是
                                <input type="radio" name="is_top" value="0" id="RadioGroup1_1" />否
                                <?php else: ?>
                                <input type="radio" name="is_top" value="1" id="RadioGroup1_0" />是
                                <input type="radio" name="is_top" value="0" id="RadioGroup1_1" checked/>否<?php endif; ?>
                        </td></tr>
                    <tr>
                        <td>文章类别</td>
                        <td class="td_left">
                            <select name="select">
                                <?php if(is_array($ac_list)): $i = 0; $__LIST__ = $ac_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php if($vo["id"] == $cls_id): ?><option value="<?php echo ($vo["id"]); ?>" selected="selected"><?php echo ($vo["name"]); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>正文</td>
                        <td class="td_left">
                            <textarea id="content" name="content" cols="100" rows="8" style="width:100%;height:300px;visibility:hidden;">
                            <?php echo ($content); ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr><td colspan="2">
                            <input type="hidden" name="ID" value="<?php echo ($id); ?>"/>
                            <input type="submit" value="提交"/>
                            <input type="reset" value="重置" />
                        </td></tr>
                </table>
            </form>
        </div>
    </body>
</html>