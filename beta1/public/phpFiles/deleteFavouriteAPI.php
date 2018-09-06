<?php
require_once __DIR__ . '/classes.php';
$user2 = new User();

if( $_GET["key"]=="logic123"){
$user2->setId($_GET['fav_course_id']);
$result= $user2->deleteFavourite();
    if ($result!=0) {
        $response["success"] = 1;
        $response["message"] = "course successfully removed from the favourite list.";
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