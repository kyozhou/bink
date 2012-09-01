<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>欢迎光临 Bink 1.1</title>

        <script type="text/javascript" src="__PUBLIC__/Js/jquery.js"></script>
        <style type="text/css">
            <!--
            body {
                background-color: #999;
            }

            #frame {
                height: 300px;
                width: 500px;
                margin: 0 auto auto auto;
                background-image: url(../Public/img/login.jpg);
            }

            #center {
                width: 400px;
                margin-right: auto;
                margin-left: auto;
                margin-top: 0;
                padding-top:80px;
            }
            #center div{
                margin:20px 20px 20px 50px;
                width:360;
                text-align:left;
            }
            #center div span.left{

                width:80px;
            }
            #center div span.right{

                width:300px;
            }

            -->
        </style>
    </head>
    <body>
        <div id="frame">
            <div id="center">
                <div>
                    <span class="left"> 账户 </span>
                    <span class="right"><input id="user" name="user" type="text"></span>
                </div>
                <div>
                    <span class="left"><label id="password_lb"> 密码 </label></span>
                    <span class="right"><input id="password" name="password" type="password"></span>
                </div>
                <div>
                    <span class="left">验证码</span>
                    <span class="right"><input name="verify" type="text" id="verify"/><img id="verifyImg" src="__URL__/verify/" BORDER="0" ALT="点击刷新验证码" /></span>
                </div>
                <div>
                    <input type="button" value="登 录" id="submit" />
                    <input type="reset" name="button2" id="button2" value="重置" />
                    <label id="status"></label>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            var post_url = '__APP__/Login/check/';
            var vrf = '__URL__/verify/';
            var base_url = '__APP__/';
            $("input").keypress(function(e){
                if(e.which==13) $("#submit").click();
            });
            $('#submit').click(function(){
                $.post(
                post_url,
                {user:$('#user').val(),password:$('#password').val(),verify:$('#verify').val()},
                function(data){
                    if(data['url']==''){
                        $('#status').text(data['status']);
                    }else{
                        $('#status').text(data['status']);
                        window.location.href = base_url+data['url'];
                    }
                },
                'json'
            );
            });
            $('#verifyImg').click(function(){
                $(this).attr('src',vrf+'?'+Math.random());
            });
        </script>
    </body>
</html>