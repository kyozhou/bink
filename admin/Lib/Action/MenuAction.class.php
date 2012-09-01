<?php

class MenuAction extends BaseAction {

    function index() {
        
        $menu_cls = D('Menucls')->select();
        $this->assign('menu_cls', $menu_cls);
        $cls_now = intval($_GET['classes']);
        $where = empty($cls_now) ? '' : ' where m.classes=' . $cls_now;
        $this->assign('cls_now', $cls_now);
        $sql = "select m.*,mc.id as cls_id ,mc.name as cls_name
            from " . C('DB_PREFIX') . "menu as m
                left join " . C('DB_PREFIX') . "menucls as mc
                    on mc.id=m.classes {$where}";
        $pager = get_pager($sql);
        $this->assign('menu', $pager['list']);
        $this->assign('page', $pager['pager']);
        $this->display();
    }

    function classes(){
        $sql = "select * from " . C('DB_PREFIX') . "menucls order by id asc ";
        $pager = get_pager($sql);
        $this->assign('menucls', $pager['list']);
        $this->assign('page', $pager['pager']);
        $this->display();
    }
    //---------------------------------控制---------------------------------------------
    function menu_add() {

        $this->assign('url', '__APP__/Menu/index');
        $data = $_POST;
        if (empty($data ['name'])) {
            $this->error('菜单名为空');
        } elseif (empty($data ['href'])) {
            $this->error('链接为空');
        } elseif (empty($data ['target'])) {
            $this->error('打开方式为空');
        } elseif (empty($data ['classes'])) {
            $this->error('类别为空');
        }
        if (empty($data ['isshow'])) {
            $data['isshow'] = 'Y';
        }
        if (empty($data ['indexnum'])) {
            $data['indexnum'] = 0;
        }
        if (empty($data ['target'])) {
            $data['target'] = '_self';
        }
        if (empty($data ['father_id'])) {
            $data['father_id'] = 0;
        }
        if (D('Menu')->add($data)) {
            $this->success('新增菜单成功！');
        } else {
            $this->error('新增菜单失败~');
        }
    }

    function menu_update() {
        $this->assign('url', '__APP__/Menu/index');
        $data = $_POST;
        if (empty($_GET['ID'])) {
            $this->error('非法调用');
        } elseif (empty($data ['name'])) {
            $this->error('菜单名为空');
        } elseif (empty($data ['href'])) {
            $this->error('链接为空');
        } elseif (empty($data ['target'])) {
            $this->error('打开方式为空');
        } elseif (empty($data ['classes'])) {
            $this->error('类别为空');
        }
        if (empty($data ['isshow'])) {
            $data['isshow'] = 'Y';
        }
        if (empty($data ['indexnum'])) {
            $data['indexnum'] = 0;
        }
        if (empty($data ['target'])) {
            $data['target'] = '_self';
        }
        if (empty($data ['father_id'])) {
            $data['father_id'] = 0;
        }

        if (D('Menu')->where("id={$_GET['ID']}")->save($data)) {
            $this->success('更新菜单成功！');
        } else {
            $this->error('更新菜单失败,或未更改菜单');
        }
    }

    function menu_delete() {
        $this->assign('url', '__APP__/Menu/index');
        if (empty($_GET['ID'])) {
            $this->error('非法调用！ID为空');
        } else {
            $id = $_GET['ID'];
            if (D('Menu')->execute("delete from __TABLE__ where id={$id} or father_id={$id}")) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        }
    }

    function menucls_add() {
        $this->assign('url', '__APP__/Menu/classes');
        $data = $_POST;
        if (empty($data ['name'])) {
            $this->error('名称不能为空');
        }
        if (empty($data ['isshow'])) {
            $data['isshow'] = 'Y';
        }
        if (D('Menucls')->add($data)) {
            $this->success('新增菜单类别成功！');
        } else {
            $this->error('新增菜单类别失败~');
        }
    }

    function menucls_update() {
        $this->assign('url', '__APP__/Menu/classes');
        $data = $_POST;
        if (empty($_GET['ID'])) {
            $this->error('错误调用');
        } else {
            if (empty($data ['name'])) {
                $this->error('名称不能为空');
            }
            if (empty($data ['isshow'])) {
                $data['isshow'] = 'Y';
            }
            if (D('Menucls')->where("id={$_GET['ID']}")->save($data)) {
                $this->success('更新菜单类别成功！');
            } else {
                $this->error('更新菜单类别失败~');
            }
        }
    }

    function menucls_delete() {
        $this->assign('url', '__APP__/Menu/classes');
        $id = $_GET['ID'];
        if (empty($id)) {
            $this->error('错误调用');
        } else {
            if (D('Menucls')->where("id={$id}")->delete()) {
                $this->success('删除菜单类别成功！');
            } else {
                $this->error('删除菜单类别失败~');
            }
        }
    }

    //----------------------------功能--------------------------------------------
    function get_menu() {
        $id = intval($_GET['ID']);
        if ($id) {
            $sql = "select * from " . C('DB_PREFIX') . "menu where id=$id";
            $menu = D()->query($sql);
            if ($menu) {
                die(json_encode(array('error' => FALSE, 'data' => $menu[0])));
            } else {
                die(json_encode(array('error' => TRUE)));
            }
        } else {
            die(json_encode(array('error' => TRUE)));
        }
    }
    function get_menucls() {
        $id = intval($_GET['ID']);
        if ($id) {
            $sql = "select * from " . C('DB_PREFIX') . "menucls where id=$id";
            $menu = D()->query($sql);
            if ($menu) {
                die(json_encode(array('error' => FALSE, 'data' => $menu[0])));
            } else {
                die(json_encode(array('error' => TRUE)));
            }
        } else {
            die(json_encode(array('error' => TRUE)));
        }
    }

}
?>