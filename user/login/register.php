<?php

header('Content-Type:application/json; charset=utf-8;');

$_USEREMAIL = $_POST["uemail"];
$_USERPASSWORD = md5($_POST["upwd"]);

if($_USEREMAIL&&$_USERPASSWORD){

    $_LINK = new mysqli('localhost','db_user','db_user','db_user','3306');

    $_SQLBACK = $_LINK->query("SELECT steamid,password FROM accounts WHERE email=\"$_USEREMAIL\"")->fetch_assoc();

    if($_SQLBACK){
        if($_SQLBACK["password"] === $_USERPASSWORD){

            // COOKIE加密，采用base64
            // 此加密方式不安全，请自行添加鉴权或其他加密方式
            $_COOKIES = base64_encode($_SQLBACK["steamid"]."GITHUB-PUBLISHED-VERSION".$_USEREMAIL);
            $_RESULT = array(
                "code" => 200,
                "message" => "登录成功！"
            );
            setcookie("Eh5Token",$_COOKIES,time()+3600*24*30,"/","nekogan.com",false,true);
        }else{
            $_RESULT = array(
                "code" => 201,
                "message" => "登录失败",
                "info" => "邮箱或密码错误"
            );
        }
        
    }else{
        $_INFOMATION = $_LINK->error;

        $_RESULT = array(
            "code" => 201,
            "message" => "登录失败",
            "info" => "邮箱或密码错误"
        );
    }

    $_LINK->close();
    exit(json_encode($_RESULT));
}else{
    $_RESULT = array(
        "code" => 403,
        "message" => "非法调用"
    );
    echo json_encode($_RESULT);
    exit;
}

?>