<?php
class articleAction extends BaseAction {
    function add() {

        $classes = M ( "articlecls" );
        $list = $classes->findAll ();
        $this->assign ( "now_time", date ( "Y-m-d H:i:s" ) );
        $this->assign ( "list", $list );
        $this->display ();
    }
    function op() {

        $articleclasses = D ( 'Articlecls' );
        $classes_list = $articleclasses->findAll ();
        $this->assign ( "classes_list", $classes_list );
        import( "ORG.Util.Page" ); 
        $classes = intval($_GET['classes']);
        if(!empty($classes)) {
            $where = " and a.classes={$classes} ";
            $this->assign("classes",$classes);
        }

        $sql = "select a.id,a.title,c.name as cls_name
                from bink_article as a,bink_articlecls as c
                where a.classes=c.id {$where} 
                order by id desc";
        //$page = $p->show ();
        $data = get_pager($sql,null);
        $this->assign ( "page", $data['pager'] );
        $this->assign ( "list", $data['list'] );
        $this->display ();
    }
    function update() {
        
        if ($_GET ["ID"] != null) {
            $ac = M ( "articlecls" );
            $ac_list = $ac->findAll ();
            $this->assign ( "ac_list", $ac_list );

            $article = M ( 'article' );
            $article->find ( $_GET ['ID'] );
            $this->assign ( "title", $article->title );
            $this->assign ( "author", $article->author );
            $this->assign ( "is_top", $article->is_top );
            $this->assign ( "cls_id", $article->classes );
            $this->assign ( "content", $article->content );
            $this->assign ( "id", $_GET ['ID'] );
            $this->display ();

        } else {
            $this->error ( "非法调用！" );
        }

    }
    function classes() {

        $ac = M ( "articlecls" );
        $list = $ac->findAll ();
        $this->assign ( "list", $list );
        $this->display ();
    }

    //classes  add
    function classes_add() {

        $this->assign ( "url", "__APP__/Article/classes" );
        if (empty ( $_POST ['name'] ) || empty($_POST ['is_lock'])) {
            $this->error ( "请完善类别名称！" );
        } else {
            $ac = M ( "articlecls" );
            //判断是否重复。。。。。
            $condition ['name'] = $_POST ['name'];
            if ($ac->where ( $condition )->select () == FALSE) {

                $ac->name = $_POST ['name'];
                $ac->is_lock = $_POST ['is_lock'];
                if ($ac->add ()) {
                    $this->success ( "成功添加类别" );
                } else {
                    $this->error ( "系统错误！添加类别失败" );
                }
            } else {
                $this->error ( "已存在此类别" );
            }
        }
    }

    //classes   update
    function classes_update() {

        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_POST['hidden_update'])||empty($_POST['name_update'])) {
            $this->error ( "非法调用！" );
        } else {
            $ac = M ( 'articlecls' );
            $ac->find($_POST['hidden_update']);
            $ac->name = $_POST['name_update'];
            $ac->is_lock = $_POST["is_lock_update"];
            if ($ac->save()) {
                $this->success ( "更新成功" );
            } else {
                $this->error ( "更新失败".$_POST['is_lock'] );
            }
        }
    }

    //classes    delete
    function classes_delete() {
    //判断是否有ID传过来
        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( "非法调用！" );
        } else {
            $ac = D ( 'Articlecls' );
            $a = D('Article');
            $a->where("classes=".$_GET['ID'])->delete() ;
            if ( $ac->delete ( $_GET ['ID'] ) ) {
                $this->success ( "删除成功！" );
            } else {
                $this->error ( "删除失败 或者 有文章存在于此类别下!" );
            }
        }
    }

    //news add
    function news_add() {
        $this->assign ( "url", "__APP__/Article/add" );
        if (empty ( $_POST ['title'] ) || empty ( $_POST ['author'] ) || empty ( $_POST ['content'] )) {
            $this->error ( "请填写完整！" . $_POST ['is_top'] );
        } else {
            $article = M ( "article" );
            //判断是否重复。。。。。
            $condition ['title'] = $_POST ['title'];
            if ($article->where ( $condition )->select () == FALSE) {
                $article->title = $_POST ['title'];
                $article->author = $_POST ['author'];
                $article->content = $_POST ['content'];
                $article->is_top = $_POST ['is_top'];
                $article->c_time = strtotime($_POST ['c_time']);
                $article->classes = $_POST ['select'];
                $article->is_recycled = 'N';
                $article->last_update = time();
                $article->clk_times = 0;
                $article->recycled = 0;

                if ($article->add ()) {
                    $this->success ( "成功发布新闻" );
                } else {
                    $this->error ( "发布失败！请联系作者" );
                }
            } else {
                $this->error ( "错误!!已存在此标题!!" );
            }
        }
    }

    //news update
    function news_update() {

        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_POST ['author'] ) || empty ( $_POST ['content'] )) {
            $this->error ( "请填写完整！" . $_POST ['is_top'] );
        } else {
            $article = M ( 'article' );
            $article->find ( $_POST ['ID'] );
            $article->author = $_POST ['author'];
            $article->content = $_POST ['content'];
            $article->is_top = $_POST ['is_top'];
            $article->classes = $_POST ['select'];
            $article->last_update = time();
            if($article->save()) {
                $this->success("更新成功");
            }else {
                $this->error("更新失败");
            }
        }
    }

    //news delete
    function news_delete() {
    //判断是否有ID传过来
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( "非法调用！" );
        } else {
            $article = D ( 'Article' );
            $ar_obj = $article->find($_GET ['ID']);
            $ac = D('Articlecls');
            $ac->find($ar_obj['classes']);
            if ($ac->is_lock=='n'&&$article->delete ( $_GET ['ID'] )) {
                $this->success ( "删除成功" );
            } else {
                $this->error ( "删除失败或类别可能被锁" );
            }
        }
    }

}
?>