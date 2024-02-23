<?php

header('Content-Type:application/json; charset=utf-8;');

$_STEAMID = $_POST["steamid"];
$_USEREMAIL = $_POST["uemail"];
$_USERPASSWORD = md5($_POST["upwd"]);
$_RESULT = array();

if($_STEAMID&&$_USEREMAIL&&$_USERPASSWORD){
    
    if(bcsub($_STEAMID, '76561197960265728') < 0){
        $_RESULT = array(
            "code" => 201,
            "message" => "注册失败",
            "info" => "STEAMID验证有误"
        );
        echo json_encode($_RESULT);
        exit;
    }

    // 开源：请在这里修改你的数据库地址
    $_LINK = new mysqli('localhost','db_user','db_user','db_user','3306');

    try{
        $_SQLBACK = $_LINK->query("INSERT INTO accounts(email,steamid,password) VALUES(\"$_USEREMAIL\",\"$_STEAMID\",\"$_USERPASSWORD\")");
        if($_SQLBACK===TRUE){
            // 开源：COOKIE加密方式（有修改）
            // 此COOKIE存储方式不安全，请自行添加鉴权等加密
            $_COOKIES = base64_encode($_STEAMID."GITHUB-PUBLISHED-VERSION".$_USEREMAIL);

            $_RESULT = array(
                "code" => 200,
                "message" => "注册成功！",
                "token" => $_COOKIES
            );

            setcookie("Eh5Token",$_COOKIES,time()+3600*24*30,"/","nekogan.com",false,true);
        }else{
            $_INFOMATION = $_LINK->error;

            $_RESULT = array(
                "code" => 201,
                "message" => "注册失败",
                "info" => $_INFOMATION
            );
        }
    }catch( Exception $e ){
        $_ERROR = $e->getMessage();
        if(strstr($_ERROR,"sunique")){
            $_ERROR = "该SteamID已被注册";
        }else if(strstr($_ERROR,"eunique")){
            $_ERROR = "该邮箱已被注册";
        }
        $_RESULT = array(
            "code" => 201,
            "message" => "注册失败",
            "info" => $_ERROR
        );
    }finally{
        echo json_encode($_RESULT);
        $_LINK->close();
        exit;
    }
}else{
    $_RESULT = array(
        "code" => 403,
        "message" => "非法调用"
    );
    echo json_encode($_RESULT);
    exit;
}

?>