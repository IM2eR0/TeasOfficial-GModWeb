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
    <link rel="stylesheet" href="milligram.min.css">
    <link rel="stylesheet" href="style.css">
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
                <h3 style="text-align: left;">&gt;&gt;&gt; 服务器玩家合影</h3>
                <img src="https://s11.ax1x.com/2024/01/02/pijSIH0.jpg" alt="2024年元旦合影1">
                <img src="https://s11.ax1x.com/2024/01/02/pijS5Bq.jpg" alt="2024年元旦合影2">
            </div>

            <hr>

            <div>
                <h3 style="text-align: right;">服务器管理员列表 &lt;&lt;&lt;</h3>
                <table>
                    <tr>
                        <th>头像</th>
                        <th>昵称</th>
                        <th>SteamID</th>
                        <th>管理员等级</th>
                    </tr>
                    <tr>
                        <td><img width="64" src="https://avatars.st.dl.eccdnx.com/2ab2816b751f4027269af6ead1e48b78d5118245_full.jpg"></td>
                        <td>昵称违规喵</td>
                        <td><a href="https://steamcommunity.com/id/xml5" target="_blank">STEAM_0:1:161319794</a></td>
                        <td>服主、全服务器超管</td>
                    </tr>
                    <tr>
                        <td><img width="64" src="https://avatars.steamstatic.com//df1fbe19a8745ef220811b96bd9c7c1b3b61a256_full.jpg"></td>
                        <td>Picrisol_</td>
                        <td><a href="https://steamcommunity.com/profiles/76561198359321556" target="_blank">STEAM_0:0:199527914</a></td>
                        <td>CSS BHOP服主</td>
                    </tr>
                    <tr>
                        <td><img width="64" src="https://avatars.st.dl.eccdnx.com/7f1065dfa7e144183a9c30e080872565c9eefb58_full.jpg"></td>
                        <td>StBn114.</td>
                        <td><a href="https://steamcommunity.com/profiles/76561198282843775/" target="_blank">STEAM_0:1:161289023</a></td>
                        <td>电影院超管</td>
                    </tr>
                    <tr>
                        <td><img width="64" src="https://avatars.st.dl.eccdnx.com/c51db4c8a8a2c5ac76a40513b439b281ea5d8871_full.jpg"></td>
                        <td>库特</td>
                        <td><a href="https://steamcommunity.com/profiles/76561199069707140" target="_blank">STEAM_0:0:554720706</a></td>
                        <td>电影院管理员</td>
                    </tr>
                    <tr>
                        <td><img width="64" src="https://avatars.st.dl.eccdnx.com/aa2d0ba5fc6da39e801a4ea751685df0dd894aa6_full.jpg"></td>
                        <td>Kliment</td>
                        <td><a href="https://steamcommunity.com/id/AirsYure/" target="_blank">STEAM_0:1:106746355</a></td>
                        <td>电影院管理员</td>
                    </tr>
                </table>
            </div>

            <hr>
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
            <nav>Powered by NekoGan | <a href="https://milligram.io/" target="_blank">Milligram</a> CSS Theme</nav>
        </center>
    </div>
</body>

</html>