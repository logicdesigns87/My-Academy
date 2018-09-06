<?php
require_once __DIR__ . '/classes.php';
$user2 = new User();

if( $_GET["key"]=="logic123"){
$user2->setId($_GET['id']);
$user2->setLimit($_GET['limit']);
$user2->setPage($_GET['page']);
$result= $user2->getFavourite();
    if ($result!=0) {
        $response["courses"] = array();
        for($i=0;$i<count($result);$i++){
             $user1=array();
             $user1['id']=$result[$i]['id'];
             $user1['fav_course_id']=$result[$i]['fav_course_id'];
        	 $user1['name']=$result[$i]['name'];
        	 $user1['video']=$result[$i]['video_link'];
        	 $user1['image']=$result[$i]['image'];
        	 $user1['category_name']=$result[$i]['category_name'];
            array_push($response["courses"],$user1);
        }
        $response["success"] = 1;
        $response["message"] = "favourite successfully imported.";
    }
    else{
        $response["success"] = 0;
        $response["message"] = "No data.";
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>