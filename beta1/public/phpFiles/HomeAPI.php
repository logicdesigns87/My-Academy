<?php
require_once __DIR__ . '/classes.php';
$user = new Course();
$topCourses = new Course();


if( $_GET["key"]=="logic123"){
$user->setLimit($_GET["limit"]);
$result= $user->getCategories();
$user->setLimit($_GET['limit_slider']);
$slider=$user->getSlider();
$user->setLimit($_GET['limit_videos']);
$mostSeen=$user->getMostSeenVideos();
$user->setLimit($_GET['limit_courses']);
$mostRecent=$user->getMostRecentCourses();
$topCourses->setLimit($_GET['limit_top']);

    if ($result!=0) {
        $response["categories"] = array();
        for($i=0;$i<count($result);$i++){
             $user=array();
        	 $user['id']=$result[$i]['id'];
        	 $user['name']=$result[$i]['name'];
        	 $user['image']=$result[$i]['image'];
        	 array_push($response["categories"],$user);
        }
        $response["success_categories"] = 1;
        $response["message_categories"] = "categories successfully imported.";
    }
    else{
        $response["success_categories"] = 0;
        $response["message_categories"] = "No categories.";
    }
    if($slider!=0){
        $response["slider"] = array();
        for($i=0;$i<count($slider);$i++){
             $user=array();
        	 $user['id']=$slider[$i]['id'];
        	 $user['image']=$slider[$i]['image'];
        	 array_push($response["slider"],$user);
        }
        $response["success_slider"] = 1;
        $response["message_slider"] = "sliders successfully imported.";
    }
    else{
        $response["success_slider"] = 0;
        $response["message_slider"] = "No slider.";
    }
    if ($mostSeen!=0) {
        $response["mostSeen"] = array();
        for($i=0;$i<count($mostSeen);$i++){
             $user=array();
        	 $user['id']=$mostSeen[$i]['id'];
        	 $user['name']=$mostSeen[$i]['name'];
        	 $user['image']=$mostSeen[$i]['image'];
        	 $user['seen']=$mostSeen[$i]['seen'];
        	 $user['description']=$mostSeen[$i]['descri'];
        	 $user['icon']=$mostSeen[$i]['icon'];
        	 $user['color']=$mostSeen[$i]['color'];
        	 $user['rate']=$mostSeen[$i]['rate']==NULL?"0":$mostSeen[$i]['rate'];
        	 array_push($response["mostSeen"],$user);
        }
        $response["success_mostseen"] = 1;
        $response["message_mostseen"] = "Most seen videos successfully imported.";
    }
    else{
        $response["success_mostseen"] = 0;
        $response["message_mostseen"] = "No videos.";
    }
    for($i=0;$i<count($result);$i++){
        
        $top=$topCourses->getMostRecentCoursesBycats($result[$i]['id']);
        if($top!=0){
            $response[$result[$i]['name']]=array();
            for($j=0;$j<count($top);$j++){
                 $user=array();
            	 $user['id']=$top[$j]['id'];
            	 $user['name']=$top[$j]['name'];
            	 $user['image']=$top[$j]['image'];
            	 $user['category']=$top[$j]['category_name'];
            	 $user['price']=$top[$j]['price'];
            	 $user['live']=$top[$j]['live'];
            	 array_push($response[$result[$i]['name']],$user);   
            }
            $response["success_".$result[$i]['name']] = 1;
            $response["message_".$result[$i]['name']] = "Successfully imported.";
        }
        else{
            $response["success_".$result[$i]['name']] = 0;
            $response["message_".$result[$i]['name']] = "No data.";
        }
    }
    echo json_encode($response);
}
else{
	//echo "valid key";
}






?>