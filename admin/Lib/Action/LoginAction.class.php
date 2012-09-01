<?php

class LoginAction extends Action {

    public function index() {
        $this->display();
    }

    public function login_out() {
        session_unset();
        $this->assign("url", "__ROOT__/");
        $this->success("成功退出后台");
    }

    public function check() {
        
        if (empty($_POST ['user']) || empty($_POST ['password']) || empty($_POST ['verify'])) {
            $data ['status'] = '请填写完整';
            $data ['url'] = '';
            echo json_encode($data);
        } else {

            if ($_SESSION ['verify'] != md5($_POST ['verify'])) {
                $data ['status'] = '验证码错误！';
                $data ['url'] = '';
                echo json_encode($data);
            } else {
                $account = D('Account');
                $condition->user = $_POST ['user'];
                $condition->password = md5($_POST ['password']);
                
                if ($account->where($condition)->find()) {
                    
                    //账号密码正确，则记录用户到SESSION
                    $account->execute("update bink_account set last_login='" . date("Y-m-d H:i:s") . "' where user='" . $condition->user . "' and password='" . $condition->password . "'");
                    $_SESSION['USER'] = $account->user;
                    $_SESSION['USER_ID'] = $account->id;
                    $_SESSION['LEVEL'] = $account->level;
                    $account->setInc('login_times', ' id = ' . $_SESSION['USER_ID']);
                    $_SESSION[C('USER_AUTH_KEY')] = $_SESSION['USER_ID'];
                    $data ['status'] = '登陆成功';
                    $data ['url'] = 'Index/index';
                    echo json_encode($data);
                } else {
                    $data ['status'] = '登陆失败';
                    $data ['url'] = '';
                    echo json_encode($data);
                }
            }
        }
    }

    public function verify() {
        $type = isset($_GET ['type']) ? $_GET ['type'] : 'gif';
        import("ORG.Util.Image");
        Image::buildImageVerify(4, 1, $type);
    }

    function saveSession() {
        
    }

}

?>