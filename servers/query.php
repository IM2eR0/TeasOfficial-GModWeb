<?php

header('Content-Type:application/json; charset=utf-8;');

require __DIR__ . '/SourceQuery/bootstrap.php';
use xPaw\SourceQuery\SourceQuery;

$_IP = $_POST["serverip"];
$_PORT = $_POST["serverport"];

if(isset($_POST['getrules'])){
    $GetRules = true;
}else{
    $GetRules = false;
};

define( 'SQ_SERVER_ADDR', $_IP );
define( 'SQ_SERVER_PORT', (int)$_PORT );
define( 'SQ_TIMEOUT'    , 3 );
define( 'SQ_ENGINE'     , SourceQuery::SOURCE );

$Query = new SourceQuery();

try{
    $Query->Connect(SQ_SERVER_ADDR,SQ_SERVER_PORT,SQ_TIMEOUT,SQ_ENGINE);
    echo json_encode(array(
       "code" => 0,
       "info" => $Query->GetInfo(),
       "players" => $Query->GetPlayers(),
       "rules" => $GetRules ? $Query->GetRules() : "Disabled, Set POST param 'getrules' to enabled it."
    ));
}catch( Exception $e ){
    echo json_encode(array(
       "code" => 1,
       "msg" => $e->getMessage()
    ));
    // echo $e->getMessage();
}finally{
    $Query->Disconnect();
}

?>