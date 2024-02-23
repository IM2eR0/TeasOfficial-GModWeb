<?php
$hasToken = false;

if(isset($_COOKIE['Eh5Token'])){
    $hasToken = true;
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eh5の茶会</title>
    <link rel="stylesheet" href="../milligram.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="tabbar">
        <ul>
            <li><a href="https://nekogan.com/" target="_top">首页</a></li>
            <li><a href="https://nekogan.com/servers/">服务器列表</a></li>
            <li><a href="https://docs.nekogan.com/">服务器帮助文档</a></li>
            <li><a href="https://nekogan.com/bhop">BHOP查询</a></li>
            <?php if(!$hasToken){
                echo '<li><a href="https://nekogan.com/user/register/" target="_top">注册</a></li>';
            }else{
                echo '<li><a href="https://nekogan.com/user/home/" target="_top">用户中心</a></li>';
            }?>
        </ul>
    </div>
    <div id="app">
        <!-- 主要内容 -->
        <center>
            <h1>Eh5の茶会</h1>
            <nav>一个友善温馨的GMod小服务器</nav>

            <hr>

            <div>
                <h3 style="text-align: left;">服务器列表 <button style="float: right;" onclick="_reload(true)">点击刷新</button></h3>
                <table>
                    <thead>
                        <tr>
                            <th>服务器名称</th>
                            <th>游戏模式</th>
                            <th>当前地图</th>
                            <th>在线玩家数</th>
                        </tr>
                    </thead>
                    <tbody id="serverlist">
                        
                    </tbody>
                </table>
            </div>

            <hr>
            <!-- 页脚信息，备案信息等 -->
            <div class="copyright">
                <nav>Powered by NekoGan | <a href="https://milligram.io/" target="_blank">Milligram</a> CSS Theme</nav>
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
<script src="./query.js"></script>

</html>