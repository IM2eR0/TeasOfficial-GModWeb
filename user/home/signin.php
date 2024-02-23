<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // 禁止执行逻辑
    exit('Access Denied');
}


$_MINP = 10;
$_MAXP = 1000;
$_PXXX = 1;

header('Content-Type:application/json; charset=utf-8;');
if(isset($_COOKIE['Eh5Token'])){
    // COOKIE加密，采用base64
    // 此加密方式不安全，请自行添加鉴权或其他加密方式
    $_USERINFO = explode("GITHUB-PUBLISHED-VERSION",base64_decode($_COOKIE['Eh5Token']));
    $_STEAMID = $_USERINFO[0];
    
    $_UID = $_POST["uid"];
    if(isset($_POST["signin"])) $_ENSURE = $_POST["signin"]; else $_ENSURE = "false";
    
    function timediff($begin_time, $end_time) {
        if ($begin_time < $end_time) {
            $starttime = $begin_time;
            $endtime = $end_time;
        } else {
            $starttime = $end_time;
            $endtime = $begin_time;
        }
        $timediff = $endtime - $starttime;
        $days = intval($timediff / 86400);
        return $days;
    }
    
    function addPoint($points,$_STEAMID){
        $authserver = bcsub($_STEAMID, '76561197960265728') & 1;
        $authid = (bcsub($_STEAMID, '76561197960265728')-$authserver)/2;
        $_STEAMID32 = "STEAM_0:$authserver:$authid";
        $_GMODUNIQUEID = crc32("gm_".$_STEAMID32."_gm");
        // 获取用户积分
        $_POINTSHOP = mysqli_connect("gmod.ltd:53999", "db_server", "HatoS#3345", "db_server");
        $_POINTS = $_POINTSHOP->query("SELECT points,items FROM pointshop_data WHERE uniqueid=\"$_GMODUNIQUEID\"")->fetch_assoc();
        // $_hasPoint = ;
        if(isset($_POINTS["points"])){
            $myPoints = (int)$_POINTS["points"];
        }else{
            $_POINTSHOP->query("INSERT INTO pointshop_data(uniqueid,points,items) VALUES(\"$_GMODUNIQUEID\",0,\"[]\")");
            $myPoints = (int)"0";
        }
        
        $_POINTSHOP->query("UPDATE pointshop_data SET points = ".($myPoints + $points)." WHERE uniqueid=$_GMODUNIQUEID");
        return $myPoints + $points;
    }
    
    $_LINK = new mysqli('localhost','db_user','db_user','db_user','3306');
    $_LASTSIGNIN = $_LINK->query("SELECT lastsignin FROM signin WHERE uid=".(int)$_UID)->fetch_assoc();
    
    if(isset($_LASTSIGNIN["lastsignin"])){
        // 获取当前时间戳
        $now = time();
        // 获取明天0点的时间戳
        $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'));
        $__date = date("Y-m-d", $_LASTSIGNIN["lastsignin"]); // 将时间戳转化为日期
        $__TASOD = strtotime($__date); // 将日期转化为当天0点的时间戳
        $days = timediff($__TASOD, $now);
        
        if(!($days > 0)){
            $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'));
            $seconds_left = $tomorrow - time();
            $hours_left = $seconds_left / 3600;
            $_RESULT = array(
                "code" => 2,
                "message" => "无法签到",
                "needWait" => (int)$hours_left,
                "cansignin" => false,
            );
        }else{
            if($_ENSURE == "true"){
                $_CTIME = time();
                $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'));
                $seconds_left = $tomorrow - $_CTIME;
                $hours_left = $seconds_left / 3600;
                $_LINK->query("UPDATE signin SET lastsignin = \"$_CTIME\" WHERE uid=$_UID");
                $_RANDOMPOINT = mt_rand($_MINP,$_MAXP) * $_PXXX;
                $_RESULT = array(
                    "code" => 1,
                    "message" => "签到成功！",
                    "nextSign" => (int)$hours_left,
                    "gain" => $_RANDOMPOINT,
                    "newPoint" => addPoint($_RANDOMPOINT,$_STEAMID)
                );
            }else{
                $_RESULT = array(
                    "code" => 0,
                    "message" => "可以签到",
                    "cansignin" => true
                );
            }
        }
    }else{
        if($_ENSURE == "true"){
            $_CTIME = time();
            $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('Y'));
            $seconds_left = $tomorrow - $_CTIME;
            $hours_left = $seconds_left / 3600;
            $_SQLBACK = $_LINK->query("INSERT INTO signin(uid,lastsignin) VALUES($_UID,\"$_CTIME\")");
            $_RANDOMPOINT = mt_rand($_MINP,$_MAXP) * $_PXXX;
            $_RESULT = array(
                "code" => 1,
                "message" => "签到成功！",
                "nextSign" => (int)$hours_left,
                "gain" => $_RANDOMPOINT,
                "newPoint" => addPoint($_RANDOMPOINT,$_STEAMID)
            );
        }else{
            $_RESULT = array(
                "code" => 0,
                "message" => "从未签到过",
                "cansignin" => true
            );
        }
    }
    
    exit(json_encode($_RESULT));
    
    
}else{
    $_RESULT = array(
        "code" => 403,
        "message" => "非法调用，无Token"
    );
    exit(json_encode($_RESULT));
}
?>