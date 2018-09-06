<?php
require_once __DIR__ . '/classes.php';
$dis = new Discussion();

if( $_GET["key"]=="logic123"){
$dis->setUser($_GET['user']);
$dis->setQuestion($_GET['question']);
$dis->setReply($_GET['reply']);

$result= $dis->sendReply();
    if ($result!=0) {
        $response["success"] = 1;
        $response["message"] = "reply added.";
    }

    else{
        $response["success"] = 0;
        $response["message"] = "Error.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>