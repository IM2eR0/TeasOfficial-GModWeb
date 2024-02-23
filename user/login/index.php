<?php
$hasToken = false;

if(isset($_COOKIE['Eh5Token'])){
    header('location:../../');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Cache-Control" content="max-age=1" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eh5の茶会 - 用户登录</title>
    <link rel="stylesheet" href="../../milligram.min.css">
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="tabbar">
        <ul>
            <li><a href="https://nekogan.com/" target="_top">首页</a></li>
            <li><a href="https://nekogan.com/servers">服务器列表</a></li>
            <li><a href="https://docs.nekogan.com/">服务器帮助文档</a></li>
            <li><a href="https://nekogan.com/bhop">BHOP查询</a></li>
            <li><a href="https://nekogan.com/register" target="_top">注册</a></li>
        </ul>
    </div>
    <div id="app">
        <center>
            <h1>Eh5の茶会</h1>
            <nav>用户登录</nav>

            <form id="registerForm" autocomplete="off">
                <fieldset style="text-align: left;width: 80%;">
                    <label for="email">邮箱</label>
                    <input type="email" placeholder="请输入邮箱" id="uemail" name="uemail">

                    <label for="userpwd">密码</label>
                    <input type="password" placeholder="请输入6~18位密码" id="upwd" name="upwd">

                    <p id="alertmsg" style="color: red;"></p>

                    <p style="text-align: center;">
                        <button class="button" id="finishReg">🚀点击登录！</button>
                        <a class="button button-clear" href="../register" target="_top">❌我还没有账号！</a>
                    </p>
                </fieldset>
            </form>

            <!-- 页脚信息，备案信息等 -->
            <div class="copyright">
                <nav>Eh5の茶会 2020-2024</nav>
                <div id="beian">
                    <a href="https://beian.miit.gov.cn/">辽ICP备XXXX号</a>
                    &ensp;
                    <a href="https://beian.mps.gov.cn/#/query/webSearch?code=XXXX">
                        <img width="10" src="https://beian.mps.gov.cn/web/assets/logo01.6189a29f.png" />
                        辽公网安备XXXX号
                    </a>
                </div>
            </div>
        </center>
    </div>
</body>
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="main.js"></script>
</html>