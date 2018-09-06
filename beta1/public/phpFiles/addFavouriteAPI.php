<?php
require_once __DIR__ . '/classes.php';
$user2 = new User();

if( $_GET["key"]=="logic123"){
$user2->setId($_GET['id']);
$result= $user2->addFavourite($_GET['course']);
    if ($result!=0 && $result!=-1) {
        $response["success"] = 1;
        $response["message"] = "course successfully added in the favourite list.";
    }
    else if($result==-1){
        $response["success"] = -1;
        $response["message"] = "Already exist in the favourite list.";        
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