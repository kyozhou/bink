<?php

class MessageAction extends BaseAction {

    function op() {

        //分页
        $message = D ( 'Message' );
        import ( "ORG.Util.Page" ); //导入分页类
        $count = count($message->query("select m.id as cname
            from bink_message as m ,bink_messagecls as c
            where m.classes=c.id and m.conn_message is Null")); //计算总数
        $p = new Page ( $count, 15 );
        //$list = $message->limit ( $p->firstRow . ',' . $p->listRows )->order ( 'is_show desc , id desc' )->findAll ();
        $sql = "select m.*,m.content as content,c.id as cid,c.name as cname,m1.content as r_content
            from (bink_message as m ,bink_messagecls as c)
            left join bink_message as m1
                on m1.conn_message=m.id
            where m.classes=c.id and m.conn_message is Null
            order by is_show asc , classes ,conn_article,conn_picture , id desc
            limit ".$p->firstRow.",".$p->listRows;
        $list = $message->query($sql);

        $p->setConfig ( 'header', '条留言' );
        $p->setConfig ( 'prev', "<" );
        $p->setConfig ( 'next', '>' );
        $p->setConfig ( 'first', '<<' );
        $p->setConfig ( 'last', '>>' );
        $page = $p->show ();
        $this->assign ( "page", $page );
        $this->assign ( "list", $list );
        $this->display ();
    }

    function classes(){
        $msgcls = D('Messagecls');
        $list = $msgcls->order('id desc')->select();
        $this->assign('msgcls_list', $list);
        $this->display();
    }
    //----------------------控制------------------------------------------------------------------


    function message_add() {
        $this->assign ( "url", "__URL__/op" );
        $message = D ( 'Message' );
        if (empty($_POST ['title_add']) || empty($_POST ['content_add'])) {
            $this->error ( '请填写完整' );
        } else {
            
            $data['title'] = $_POST ['title_add'];
            $data['content'] = $_POST ['content_add'];
            $data['ip'] = $_SERVER ["REMOTE_ADDR"];
            $data['c_time'] = date ( "Y-m-d H:i:s" );

            if (empty ( $_POST ['author_add'] )) {
                $data['author'] = '匿名';
            } else {
                $data['author'] = $_POST ['author_add'];
            }

            if ($message->add ($data)) {
                $this->success ( '添加成功' );
            } else {
                $this->error ( "添加失败" );
            }
        }
    }

    function message_delete() {
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( '非法调用' );
        } else {
            $message = D ( 'Message' );
            if ($message->delete ( $_GET ['ID'] )) {
                $this->success ( '删除成功' );
            } else {
                $this->error ( '删除失败' );
            }
        }
    }

    function message_reply(){
        $this->assign ( "url", "__URL__/op" );
        $message = D ( 'Message' );
        if (empty($_POST ['content'])|| empty($_POST['t_id']) ) {
            $this->error ( '请填写完整' );
        } else {
            if(count($message->where('conn_message='.$_POST['t_id'])->select())){
                $message->where('conn_message='.$_POST['t_id'])->delete();
            }
            
            if ($message->execute("insert into bink_message(is_show,content,conn_message,author,c_time,classes)values(1,'".$_POST['content']."',".$_POST ['t_id'].",'".$_SESSION['USER']."','".date ( "Y-m-d H:i:s" )."',-1)")) {
                $this->success ( '回复成功' );
            } else {
                $this->error ( "回复失败" );
            }
        }
    }

    function message_delete_all() {
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_POST ['cb'] )) {
            $this->error ( '没有选择的项目' );
        } else {
            $message = D ( 'Message' );
            $arr_id = $_POST ['cb'];
            $all_test = true;
            foreach ( $arr_id as $id ) {
                if ($message->delete ($id)) {

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

    //留言类型
    function msgcls_add(){
        $this->assign ( "url", "__URL__/classes" );
        $messagecls = D ( 'Messagecls' );
        if (empty($_POST ['name']) ) {
            $this->error ( '请填写完整' );
        } else {
            $data['name'] = $_POST ['name'];
            $data['is_show'] = $_POST['is_show']=='y'?1:0;

            if ($messagecls->add ($data)) {
                $this->success ( '添加成功' );
            } else {
                $this->error ( "添加失败" );
            }
        }
    }

    function msgcls_update(){
        $this->assign ( "url", "__URL__/classes" );
        $messagecls = D ( 'Messagecls' );
        if (empty($_POST ['name']) || empty($_POST['msgcls_id'])) {
            $this->error ( '请填写完整' );
        } else {
            $data['id'] = $_POST['msgcls_id'];
            $data['name'] = $_POST ['name'];
            $data['is_show'] = $_POST['is_show']=='y'?1:0;

            if ($messagecls->save ($data)) {
                $this->success ( '更新成功' );
            } else {
                $this->error ( "更新失败或没有更新" );
            }
        }
    }

    function msgcls_delete(){
        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( '非法调用' );
        } else {
            $messagecls = D ( 'Messagecls' );
            if ($messagecls->delete ( $_GET ['ID'] )) {
                $this->success ( '删除成功' );
            } else {
                $this->error ( '删除失败' );
            }
        }
    }

    function msgcls_delete_all() {
        $this->assign ( "url", "__URL__/classes" );
        if (empty ( $_POST ['cb'] )) {
            $this->error ( '没有选择的项目' );
        } else {
            $messagecls = D ( 'Messagecls' );
            $arr_id = $_POST ['cb'];
            $all_test = true;
            foreach ( $arr_id as $id ) {
                if ($messagecls->delete ($id)) {

                } else {
                    $all_test = false;
                }
            }
            if ($all_test) {
                $this->success ( '批量删除成功' );
            } else {
                $this->error ( '批量删除失败' );
            }
        }
    }

    function set_msg_show(){
        $this->assign ( "url", "__URL__/op" );
        if (empty ( $_GET ['ID'] )) {
            $this->error ( '设置失败' );
        } else {
            $message = D ( 'Message' );
            
            if ($message->execute("update bink_message set is_show=1-is_show where id='".$_GET['ID']."'")) {
                $this->success('设置成功');
            } else {
                $this->error ( '设置失败' );
            }
        }
    }
}

?>