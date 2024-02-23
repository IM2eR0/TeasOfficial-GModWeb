<?php
$hasToken = false;

$mapName="";

if(isset($_COOKIE['Eh5Token'])){
    $hasToken = true;
}

if(isset($_GET["type"])){
    $type = $_GET["type"];
    $name = $_GET["name"];
}

$styles = array(
    "0" => "NM",
    "1" => "SW",
    "2" => "W",
    "3" => "SCR",
    "4" => "400VEL",
    "5" => "HSW",
    "6" => "UKN-6",
    "7" => "A",
    "8" => "UKN-8",
    "9" => "SEG",
    "10" => "LG",
    "11" => "VLG",
    "12" => "SLG",
    "13" => "SLOW",
    "14" => "750VEL",
    "15" => "UKN-15",
    "16" => "UKN-16",
    "17" => "UKN-17",
    "18" => "TAS",
    "19" => "UKN-19",
    "20" => "SHSW",
    "21" => "UKN-21",
    "22" => "UKN-22",
    "23" => "UKN-23",
    "24" => "UNRL",
    "25" => "PARK",
    "26" => "SCR-1kAA",
    "27" => "NTAS"
);

$styletip = array(
    "0" => "Normal 自动连跳",
    "1" => "Sideways 侧跳",
    "2" => "W-Only W跳",
    "3" => "Scroll 手动模式",
    "4" => "400 Velocity 400限速手动",
    "5" => "Half-Sideways 半侧跳",
    "6" => "已被删除的模式",
    "7" => "A-Only A跳",
    "8" => "已被删除的模式",
    "9" => "Segmented 存点模式",
    "10" => "Low Gravity 低重力",
    "11" => "Very Low Gravity 超低重力",
    "12" => "Super Low Gravity 极低重力",
    "13" => "Slow Motion 慢动作模式",
    "14" => "Velocity-Auto 限速自动跳",
    "15" => "已被删除的模式",
    "16" => "已被删除的模式",
    "17" => "已被删除的模式",
    "18" => "TAS",
    "19" => "已被删除的模式",
    "20" => "Surf HSW 滑翔半侧",
    "21" => "已被删除的模式",
    "22" => "已被删除的模式",
    "23" => "已被删除的模式",
    "24" => "Unreal 枪跳",
    "25" => "Parkour 跑酷模式",
    "26" => "Scroll-1000aa 高空速手动",
    "27" => "(NO SPEED LOSS) TAS不限速"
);
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
            <nav><?php
                if($type == 1){
                    echo "<p>地图 ".$name." 的数据</p>";
                }
                if($type == 2){
                    echo "<p>用户 ".$name." 的数据</p>";
                    
                    echo"
                    <p>
                        <a href='#StyS' class='button'>模式游玩数据</a>
                        <a href='#MapS' class='button'>地图游玩数据</a>
                    </p>
                    ";
                }
            ?></nav>
            <hr>
                <?php
                    if($type == 2){
                        echo "
                        <h3 id='StyS' style='text-align: left;'>模式游玩数据</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>模式名</th>
                                    <th>游玩时长</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";
                        
                        $ch = curl_init();
                        curl_setopt ($ch, CURLOPT_URL, 'http://tempurl.com/userstyle?name='.$name);
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//禁止 cURL 验证对等证书
                        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);//是否检测服务器的域名与证书上的是否一致
                        curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
                        curl_setopt ($ch, CURLOPT_HTTPGET, 1);
                        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                        $_A = json_decode(curl_exec($ch),true)["data"];
                        curl_close($ch);
                        
                        foreach ($_A as $k => $v){
                            echo"
                            <tr>
                                <td><span tooltip='{$styletip[$v["style"]]}'>{$styles[$v["style"]]}</span></td>
                                <td>". secondChanage((int)$v["playtime"]) ."</td>
                            </tr>
                            ";
                        }
                        
                        echo"
                        </tbody>
                        </table>
                        <hr>
                        <h3 id='MapS' style='text-align: left;'>地图游玩数据</h3>";
                    }
                ?>
                <table>
                    <thead>
                        <?php
                            if($type==1){
                                echo
                                '<tr>
                                    <th>玩家ID</th>
                                    <th>玩家名称</th>
                                    <th>通关日期</th>
                                    <th>通关用时</th>
                                    <th>跳跃次数</th>
                                    <th>加速次数</th>
                                    <th>模式</th>
                                    <th>同步率</th>
                                    <th>关卡类型</th>
                                </tr>';
                            }
                            if($type==2){
                                echo
                                '<tr>
                                    <th>地图名称</th>
                                    <th>通关用时</th>
                                    <th>通关时间</th>
                                    <th>跳跃次数</th>
                                    <th>加速次数</th>
                                    <th>模式</th>
                                    <th>同步率</th>
                                    <th>获得分数</th>
                                    <th>关卡类型</th>
                                </tr>';
                            }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            if($type==1){
                                $ch = curl_init();
                                curl_setopt ($ch, CURLOPT_URL, 'http://tempurl.com/mapinfo?name='.$name);
                                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//禁止 cURL 验证对等证书
                                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);//是否检测服务器的域名与证书上的是否一致
                                curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
                                curl_setopt ($ch, CURLOPT_HTTPGET, 1);
                                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                                $_A = json_decode(curl_exec($ch),true)["data"];
                                curl_close($ch);
                        
                                foreach ($_A as $key => $value) {
                                    if($value["track"] == "0"){
                                        $trackmode = "主线关";
                                    }else{
                                        $trackmode = "奖励关 #".$value["track"];
                                    }
                                    
                                    echo
                                    "<tr>
                                        <td>{$value["auth"]}</td>
                                        <td>{$value["name"]}</td>
                                        <td>".date("Y-m-d H:i:s",$value["date"])."</td>
                                        <td>{$value["time"]}</td>
                                        <td>{$value["jumps"]}</td>
                                        <td>{$value["strafes"]}</td>
                                        <td><span tooltip='{$styletip[$value["style"]]}'>{$styles[$value["style"]]}</span></td>
                                        <td>{$value["sync"]}%</td>
                                        <td>{$trackmode}</td>
                                    </tr>";
                                }
                            }elseif ($type==2) {
                                $ch = curl_init();
                                curl_setopt ($ch, CURLOPT_URL, 'http://tempurl.com/userinfo?name='.$name);
                                curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false);//禁止 cURL 验证对等证书
                                curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);//是否检测服务器的域名与证书上的是否一致
                                curl_setopt ($ch, CURLOPT_TIMEOUT, 3);
                                curl_setopt ($ch, CURLOPT_HTTPGET, 1);
                                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                                $_A = json_decode(curl_exec($ch),true)["data"];
                                curl_close($ch);
                                
                                foreach ($_A as $key => $value) {
                                    if($value["track"] == "0"){
                                        $trackmode = "主线关";
                                    }else{
                                        $trackmode = "奖励关 #".$value["track"];
                                    }
                                    echo
                                    "<tr>
                                        <td>{$value["map"]}</td>
                                        <td>".date("Y-m-d H:i:s",$value["date"])."</td>
                                        <td>{$value["time"]}</td>
                                        <td>{$value["jumps"]}</td>
                                        <td>{$value["strafes"]}</td>
                                        <td><span tooltip='{$styletip[$value["style"]]}'>{$styles[$value["style"]]}</span></td>
                                        <td>{$value["sync"]}%</td>
                                        <td>{$value["points"]}</td>
                                        <td>{$trackmode}</td>
                                    </tr>";
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