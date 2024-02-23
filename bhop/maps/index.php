<?php
$hasToken = false;

$mapName="";

if(isset($_COOKIE['Eh5Token'])){
    $hasToken = true;
}

if(isset($_POST["mapname"])){
    $mapName = $_POST["mapname"];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eh5の茶会</title>
    <link rel="stylesheet" href="../../milligram.min.css">
    <link rel="stylesheet" href="../../style.css">
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
            <nav>Bunny Hop 数据查询</nav>
            <br>
            <form style="width: 60rem" action="./" method="POST">
                <input style="width: 80%" name="mapname" placeholder="请输入地图名称" value="<?php echo $mapName ?>">
                <button style="width: 20%;float:right" type="submit">搜索</button>
            </form>
            
            <hr>
                <table>
                    <thead>
                        <tr>
                            <th>地图名</th>
                            <th>Tier</th>
                            <th>详细信息</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ch = curl_init();
                            curl_setopt ($ch, CURLOPT_URL, 'http://tempurl.com/map?mapname='.$mapName);
                            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//禁止 cURL 验证对等证书
                            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);//是否检测服务器的域名与证书上的是否一致
                            curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
                            curl_setopt ($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                            $_A = json_decode(curl_exec($ch),true)["data"];
                            
                            
                            curl_close($ch);
                            
                            foreach ($_A as $key => $value) {
                                echo "<tr>";
                                echo "<td>".$value["map"]."</td>";
                                echo "<td>".$value["tier"]."</td>";
                                echo "<td><a href='../info/?type=1&name=".$value["map"]."' target='_blank'>详细信息</a></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
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