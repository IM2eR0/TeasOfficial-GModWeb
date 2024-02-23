<?php
$hasToken = false;

$name="";

if(isset($_COOKIE['Eh5Token'])){
    $hasToken = true;
}

if(isset($_POST["name"])){
    $name = $_POST["name"];
}

function secondChanage($second = 0)
{
    $newtime = '';
    $d = floor($second / (3600*24));
    $h = floor(($second % (3600*24)) / 3600);
    $m = floor((($second % (3600*24)) % 3600) / 60);
    $s = $second - ($d*24*3600) - ($h*3600) - ($m*60);

    empty($d) ?  
    $newtime = (
            empty($h) ? (
                empty($m) ? $s . '秒' : ( 
                    empty($s) ? $m.'分' :  $m.'分'.$s.'秒'
                    )
                ) : (
                empty($m) && empty($s) ? $h . '时' : (
                    empty($m) ? $h . '时' . $s . '秒' : (
                        empty($s) ? $h . '时' . $m . '分' : $h . '时' . $m . '分' . $s . '秒'
                        )
                )
            )
    ) : $newtime = (
        empty($h) && empty($m) && empty($s) ? $d . '天' : (
            empty($h) && empty($m) ? $d . '天' . $s .'秒' : (
                empty($h) && empty($s) ? $d . '天' . $m .'分' : (
                    empty($m) && empty($s) ? $d . '天' .$h . '时' : (
                        empty($h) ? $d . '天' .$m . '分' . $s .'秒' : (
                            empty($m) ? $d . '天' .$h . '时' . $s .'秒' : (
                                empty($s) ? $d . '天' .$h . '时' . $m .'分' : $d . '天' .$h . '时' . $m .'分' . $s . '秒'
                            )
                        )
                    )
                )
            )
        )
    );
    return $newtime;
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
                <input style="width: 80%" name="name" placeholder="请输入用户名" value="<?php echo $name ?>">
                <button style="width: 20%;float:right" type="submit">搜索</button>
            </form>
            
            <hr>
            
                <table>
                    <thead>
                        <tr>
                            <?php
                                if($name==""){
                                    echo "<th>排名</th>";
                                }
                            ?>
                            <th>用户名</th>
                            <th>持有点数</th>
                            <th>上次在线</th>
                            <th>在线时间</th>
                            <th>更多信息</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $ch = curl_init();
                            curl_setopt ($ch, CURLOPT_URL, 'http://tempurl.com/user?name='.urlencode($name));
                            curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//禁止 cURL 验证对等证书
                            curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);//是否检测服务器的域名与证书上的是否一致
                            curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
                            curl_setopt ($ch, CURLOPT_HTTPGET, 1);
                            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                            curl_setopt ($ch, CURLOPT_HTTPHEADER, array(
                                'Content-type: application/x-www-form-urlencoded; charset=UTF-8'    
                            ));
                            $_A = json_decode(curl_exec($ch),true)["data"];
                            
                            curl_close($ch);
                            
                            if($name == ""){
                                foreach ($_A as $key => $v) {
                                    echo " 
                                    <tr>
                                        <td>". (int)$key + 1 ."</td>
                                        <td>{$v["name"]}</td>
                                        <td>{$v["points"]}</td>
                                        <td>". date("Y-m-d H:i:s",$v["lastlogin"]) ."</td>
                                        <td>". secondChanage((int)$v["playtime"]) ."</td>
                                        <td><a href='../info?type=2&name={$v["auth"]}' target='_blank'>更多信息</a></td>
                                    </tr>
                                    ";
                                }
                            }else{
                                foreach ($_A as $key => $v) {
                                    echo " 
                                    <tr>
                                        <td>{$v["name"]}</td>
                                        <td>{$v["points"]}</td>
                                        <td>". date("Y-m-d H:i:s",$v["lastlogin"]) ."</td>
                                        <td>". secondChanage((int)$v["playtime"]) ."</td>
                                        <td><a href='../info?type=2&name={$v["auth"]}' target='_blank'>更多信息</a></td>
                                    </tr>
                                    ";
                                }
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