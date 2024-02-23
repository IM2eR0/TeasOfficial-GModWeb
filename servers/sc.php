<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eh5の茶会</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../milligram.min.css">
    
</head>



<body class="serverquery">
    
<?php
require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;

$_IP = isset($_GET["i"]) ? $_GET["i"] : "";
$_PORT = isset($_GET["p"]) ? $_GET["p"] : 27015;
$debug = isset($_GET["D"]) ? $_GET["D"] : "false";

if($_IP != ""){
    define( 'SQ_SERVER_ADDR', $_IP );
    define( 'SQ_SERVER_PORT', (int)$_PORT );
    define( 'SQ_TIMEOUT'    , 3 );
    define( 'SQ_ENGINE'     , SourceQuery::SOURCE );
    $Query = new SourceQuery();
    
    try{
        $Query->Connect(SQ_SERVER_ADDR,SQ_SERVER_PORT,SQ_TIMEOUT,SQ_ENGINE);
        $_INFO = $Query->GetInfo();
        $_PLAYERS = $Query->GetPlayers();
    }catch( Exception $e ){
        $errmsg = $e->getMessage();
        exit("<h1>服务器连接时出错：</h1><h3>{$errmsg}</h3><br><p>Powered by 昵称违规喵</p><a href='#'>https://afdian.net/a/eh5here</a>");
    }finally{
        $Query->Disconnect();
    }
}else{
    $errmsg = "Invaild Server IP.";
    exit("<h1>服务器连接时出错：</h1><h3>{$errmsg}</h3><br><p>Powered by 昵称违规喵</p><a href='#'>https://afdian.net/a/eh5here</a>");
}

?>

    <center>
        <!-- 主要内容 -->
        <h2>
            <? echo $_INFO["HostName"] ?>
            <img src="./<? echo $_INFO["Os"] == "w" ? "w" : "l" ?>.png" width="24px">
        </h2>
        <h4>
            <? echo $_INFO["ModDesc"] ?>
            &nbsp; - &nbsp;
            <? echo $_INFO["Players"] ?> / <? echo $_INFO["MaxPlayers"] ?>
            <br>
            <? echo $_INFO["Map"] ?>.bsp
            <? if($debug == "true") echo "<br>".$_IP.":".$_PORT ?>
        </h4>
        <br>
        
        <table>
            <thead>
                <tr>
                    <th align="right">玩家名</th>
                    <th align="center">分数</th>
                    <th align="left">在线时长</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($_PLAYERS as $k => $v){
                    // print_r($v);
                    echo "<tr>";
                    //echo "<td align='right'>" . $v['Name'] . "</td>";
                    if($v['Name'] == "")
                        echo "<td align='right'>&lt;!&gt; 玩家连接中...</td>";
                    else
                        echo "<td align='right'>" . $v['Name'] . "</td>";
                        
                    echo "<td align='center'>" . $v['Frags'] . "</td>";
                    echo "<td align='left'>" . $v['TimeF'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <p>Powered by 昵称违规喵</p>
        <p>Version 1.03a</p>
        <a href="#">https://afdian.net/a/eh5here</a>
    </center>
</body>

</html>