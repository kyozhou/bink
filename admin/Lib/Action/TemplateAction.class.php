<?php 
class templateAction extends BaseAction {

    
    function front() {

        //分页
        $tpl = D ( 'Template' );
        import ( "ORG.Util.Page" ); //导入分页类
        $count = $tpl->count (); //计算总数
        $p = new Page ( $count, 15 );
        $list = $tpl->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'id desc' )->findAll ();

        $p->setConfig ( 'header', '个模板' );
        $p->setConfig ( 'prev', "<" );
        $p->setConfig ( 'next', '>' );
        $p->setConfig ( 'first', '<<' );
        $p->setConfig ( 'last', '>>' );
        $page = $p->show ();
        $this->assign ( "page", $page );
        $this->assign ( "list", $list );
        $this->display ();
    }

    function tpl_add() {

        $this->assign ( "url", "__URL__/front" );

        if (empty ( $_POST ['name_add'] ) || empty($_POST["set_default"])) {
            $this->error ( "请填写完整！" );
        } else {
            $tpl = D ( 'Template' );
            $data ['name'] = $_POST ['name_add'];
            $data ['isdefault'] = $_POST ['set_default'];
            if ($tpl->add ($data)) {
                $this->success ( "添加成功" );
            } else {
                $this->error ( "添加失败" );
            }
        }
    }

    function tpl_update() {
        $this->assign ( "url", "__URL__/front" );
        
        if (empty ( $_POST ['tpl_id'] )) {
            $this->error ( "非法调用！" );
        }
        if (empty ( $_POST ['name_update'] )|| empty($_POST["set_default"])) {
            $this->success ( "请填写完整！" );
        } else {
            $tpl = D ( 'Template' );
            $tpl->execute("update bink_template set isdefault='no'");

            $tpl = D ( 'Template' );
            $tpl->find ( $_POST ['tpl_id'] );
            $tpl->name = $_POST ['name_update'];
            $tpl->isdefault = $_POST ['set_default'];

            if ($tpl->save ()) {
                $this->success ( "更新成功" );
            } else {
                $this->error ( "更新失败 或 没有更新" );
            }
        }
    }

    function tpl_delete() {
        $this->assign ( "url", "__URL__/front" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( "非法调用！" );
        }
        $tpl = D ( 'Template' );
        if ($tpl->delete ( $_GET ['ID'] )) {
            $this->success ( "刪除成功" );
        } else {
            $this->error ( "刪除失败" );
        }
    }

    function tpl_delete_all() {
        $this->assign ( "url", "__URL__/front" );
        if (empty ( $_POST ['cb'] )) {
            $this->error ( '没有选择项' );
        } else {
            $tpl = D ( 'Template' );
            $arr_id = $_POST ['cb'];
            $all_test = true;
            foreach ( $arr_id as $id ) {
                if ($tpl->delete ($id)) {

                } else {
                    $all_test = false;
                }
            }
            if ($all_test) {
                $this->success ( '删除成功' );
            } else {
                $this->error ( '删除失败' );
            }
        }
    }
}

?>