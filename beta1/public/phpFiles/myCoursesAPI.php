<?php
require_once __DIR__ . '/classes.php';
$user2 = new User();

if( $_GET["key"]=="logic123"){
$user2->setId($_GET['id']);
$result= $user2->getCourses();
    if ($result!=0) {
        $response["courses"] = array();
        for($i=0;$i<count($result);$i++){
             $videos=$user2->getVideos($result[$i]['id']);
             $user1=array();
             $user1['id']=$result[$i]['id'];
        	 $user1['name']=$result[$i]['name'];
        	 $user1['video']=$result[$i]['video_link'];
             $user1["videos"] = array();
             for($j=0;$j<count($videos);$j++){
                 $user=array();
            	 $user['id']=$videos[$j]['id'];
            	 $user['name']=$videos[$j]['name'];
            	 $user['video']=$videos[$j]['video_link'];
            	 $user['description']=$videos[$j]['descri'];
            	 $user['image']=$videos[$j]['image'];
            	 $user['time_inserted']=$videos[$j]['time_inserted'];
            	 $user['start_date']=$videos[$j]['start_date'];
            	 $user['start_time']=$videos[$j]['start_time'];
            	 $user['live']=$videos[$j]['live'];
            	 $user['icon']=$videos[$j]['icon'];
            	 $user['color']=$videos[$j]['color'];
            	 $user['created_by']=$videos[$j]['created_by'];
            	 $user['duration']=$videos[$j]['duration'];
            	 $user['course']=$videos[$j]['course_name'];
            	 $user['rate']=$videos[$j]['rate'];
            	 $user['seen']=$videos[$j]['seen'];
            	 array_push($user1["videos"],$user);
             }
            array_push($response["courses"],$user1);
        }
        $response["success"] = 1;
        $response["message"] = "history successfully imported.";
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