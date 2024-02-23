<?php
$hasToken = false;

if(isset($_COOKIE['Eh5Token'])){
    $hasToken = true;

    // COOKIE解密（需要与 register.php 文件中相符合，或者你可以自己写解密过程）
    // 此加密方式不安全，请自行添加鉴权或其他加密方式
    $_USERINFO = explode("GITHUB-PUBLISHED-VERSION",base64_decode($_COOKIE['Eh5Token']));

    $_STEAMID = $_USERINFO[0];
    $_USEREMAIL = $_USERINFO[1];
    
    $_LINK = new mysqli('localhost','db_user','db_user','db_user','3306');
    $_SQLBACK = $_LINK->query("SELECT uid FROM accounts WHERE email=\"$_USEREMAIL\"")->fetch_assoc();
    
    $_UID = $_SQLBACK["uid"];
    $_LINK->close();
    
    $authserver = bcsub($_STEAMID, '76561197960265728') & 1;
    $authid = (bcsub($_STEAMID, '76561197960265728')-$authserver)/2;
    $_STEAMID32 = "STEAM_0:$authserver:$authid";
    $_GMODUNIQUEID = crc32("gm_".$_STEAMID32."_gm");
    // 获取用户积分
    $_POINTSHOP = mysqli_connect("gmod.ltd:53999", "db_server", "HatoS#3345", "db_server");
    $_POINTS = $_POINTSHOP->query("SELECT points,items FROM pointshop_data WHERE uniqueid=\"$_GMODUNIQUEID\"")->fetch_assoc();
    // $_hasPoint = ;
    if(isset($_POINTS["points"])){
        $myPoints = $_POINTS["points"];
    }else{
        $_POINTSHOP->query("INSERT INTO pointshop_data(uniqueid,points,items) VALUES(\"$_GMODUNIQUEID\",0,\"[]\")");
        $myPoints = "0";
    }
    
    
}else{
    header('location:../login/');
}

if($_USERINFO[0]==""||$_USERINFO[1]==""){
    header('location:../login/');
    setcookie("Eh5Token",NULL,time()-1,"/","nekogan.com",false,true);
    exit;
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
            <nav>用户中心</nav>

            <hr>

            <div>
                <p>你好！<?php echo $_STEAMID32 ?>！<em><?php echo "UID：".$_UID ?></em></p>
                
                <p id="myPoints">你当前的积分为：<?php echo $myPoints; ?></p>
                
                <p id="alert"></p>
                
                <input type="button" id="signin" value="点击签到" disabled="disabled" onclick="signin(true)"/>
                <input type="button" value="退出登录" onclick="logout()"/>
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
        </center>
    </div>
</body>
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    function logout(){
        $.post("./logout.php")
        setTimeout(()=>{
            window.location.href="../../"
        },500)
    }
    function signin(ensure = false){
        $.post("./signin.php",{["uid"]:<?php echo $_UID ?>,["signin"]:ensure},(json)=>{
            if(ensure){
                document.getElementById("signin").value = json.nextSign + " 小时后可签到";
                document.getElementById("signin").setAttribute('disabled','disabled');
                document.getElementById("myPoints").innerText = "你当前的积分为：" + json["newPoint"];
                document.getElementById("alert").innerText = "签到成功！你获得了 " + json["gain"] + " 点积分！";
            }else{
                if(json["code"] == 2){
                    document.getElementById("signin").value = json.needWait + " 小时后可签到";
                    document.getElementById("signin").setAttribute('disabled','disabled');
                }else if(json["code"] == 0){
                    document.getElementById("signin").value = "点击签到";
                    document.getElementById("signin").removeAttribute('disabled');
                }else{
                    document.getElementById("signin").value = "系统内部错误";
                    document.getElementById("signin").setAttribute('disabled','disabled');
                }
            }
        })
    }
    signin()
</script>
</html>