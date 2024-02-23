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
    <title>Eh5の茶会 - 用户注册</title>
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
            <li><a href="#" target="_top">注册</a></li>
        </ul>
    </div>
    <div id="app">
        <center>
            <h1>Eh5の茶会</h1>
            <nav>用户注册</nav>

            <form id="registerForm" autocomplete="off">
                <fieldset style="text-align: left;width: 80%;">
                    <label for="username">Steam64ID（<a href="../../steam" target="_blank">如何查询我的Steam64ID？</a>）</label>
                    <input type="text" placeholder="请输入你的64位SteamID" id="steamid" name="steamid">

                    <label for="email">邮箱</label>
                    <input type="email" placeholder="请输入有效邮箱（登录用）" id="uemail" name="uemail">

                    <label for="userpwd">密码</label>
                    <input type="password" placeholder="请输入6~18位密码" id="upwd" name="upwd">

                    <label for="userpwd">重复输入一次密码</label>
                    <input type="password" placeholder="请再次输入一次相同的密码" id="upwd2" name="upwdagain">

                    <p id="alertmsg" style="color: red;"></p>

                    <p style="text-align: center;">
                        <button class="button" id="finishReg">👍完成注册！</button>
                        &nbsp;
                        <a class="button button-outline" href="../login">❌已有账号？</a>
                    </p>
                </fieldset>
            </form>

            <div class="copyright">
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