<?php
require_once __DIR__ . '/classes.php';
$user = new Course();

if( $_GET["key"]=="logic123"){
$user->setId($_GET['video']);
$result= $user->finishVideo($_GET['user']);
    if ($result!=0) {
        $response["success"] = 1;
        $response["message"] = "video successfully added to user.";
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