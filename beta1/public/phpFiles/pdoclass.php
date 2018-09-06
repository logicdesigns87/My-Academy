<?php

class Database{

	private static $instance = null;
	private $pdo;
	private $query;
	private $results;
	private $count = 0;
	private $error = false;
	private $query_string = "";
	private $bindValues = array();
	private $lastId;

	private function __construct() {
		try {
			// Put your database information
			$this->pdo = new PDO("mysql:host=localhost;dbname=logichos_myacademy","logichos_academy","academy123");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}

	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new Database();
		}
		return self::$instance;
	}

	public function generalSelect($tableName,$arryCol,$whereColArr,$wherevalueArr,$page=null,$limit=null,$order=0,$sign=null){
    try{    
            if($limit==null){
                $limit=10;
            }
            $offset=(($page-1)*$limit);
    		$fieldlist=implode(',',$arryCol);
    		
    		if($order==0){
    		    $asc='asc';
    		}
    		else{
    		    $asc='desc';
    		}
    		 $sqlStatment="select ".$fieldlist." from "." $tableName "."where ";
    		for( $i =0 ; $i<count($whereColArr);$i++){
    			$sqlStatment.=$whereColArr[$i];
    			if($whereColArr[$i]=='name'){
    			 $sqlStatment.=" like"." ?";
    			}
    			else if($sign!=null){
    			   $sqlStatment.=" ".$sign."?";
    			}
    			else{
    				$sqlStatment.="= "."?";
    			}
    			if($i!=count($whereColArr)-1){
    				$sqlStatment.=" and ";
    			}
    		}
    	    $sqlStatment.=" order by id ".$asc;
    		if($page!=0 && $page!=null){
    		    $sqlStatment.=" LIMIT ? OFFSET ? " ;
    		} 
    	//echo $sqlStatment;
    		$sql =  $this->pdo->prepare($sqlStatment);
            for( $i =1 ; $i<count($whereColArr)+1;$i++){
                $ffff=$wherevalueArr[$i-1];
                if($whereColArr[$i-1]=='name'){
                    $f="%$ffff%";
                }
                else{
                    $f=$wherevalueArr[$i-1];
                }
                $sql->bindValue($i, "$f");
            }
             
    		if($page!=0 && $page!=null){
        		 $sql->bindValue($i,(int) trim($limit), PDO::PARAM_INT); 
        		 $i++;
        		 $sql->bindValue($i,(int) trim($offset), PDO::PARAM_INT); 
    		}

    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    		        	
    			return 0;
    
    		}
    	
    		return 0;
    			
    }
    catch(PDOException $ex){
    //		echo "An Error occured!"; //user friendly message
      //  some_logging_function($ex->getMessage());
  //  echo $ex->getMessage();
    //	$error=array();
//	$error=$sql->errorInfo();
   // print_r($error);
    }
}

    function generalSelectWithoutCondition($tableName,$arryCol,$page=null,$limit=10){
    try{
        if($limit==null){
            $limit=10;
        }      
        $offset=(($page-1)*$limit);
		$fieldlist=implode(',',$arryCol);
	
		$sqlStatment="select ".$fieldlist." from "." $tableName ";
	    $sqlStatment.="order by id asc";
	    if($limit!=0 && $limit!=null){
		    $sqlStatment.=" LIMIT ? " ;
    	}
	    if($page!=0 && $page!=null){
    		    $sqlStatment.=" OFFSET ? " ;
    	} 
		$sql =  $this->pdo->prepare($sqlStatment);
		if($limit!=0 && $limit!=null){
    		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
		}
		if($page!=0 && $page!=null){
    		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
    	}
    	//echo $sqlStatment;
		if($sql->execute()){
			$arr= $sql->fetchAll();
			if(count($arr)>0)
			{
				return $arr;
			}
			return 0;
		}
		else{
			return 0;
		}
		return 0;
	}
	catch(PDOException $ex){
    }
}

	function generalInsert($tableName,$arryCol,$arrData){

        try{
    
    		$fieldlist=implode(',',$arryCol);
    		$qs=str_repeat("?,",count($arrData)-1);
    		$sqlStatment="insert into ".$tableName.' '."($fieldlist) VALUES (${qs}?)";
    		$i;
    	
    		$sql =  $this->pdo->prepare($sqlStatment);
    		for( $i =1 ; $i<count($arryCol)+1;$i++){
    			//echo $arrData[$i-1];
    			$sql->bindValue($i, $arrData[$i-1]);
    		}
    		//echo $sqlStatment;
    		if($sql->execute()){
    			return $this->pdo->lastInsertId();
    		}
    		else{
    		    
    			return false;
    		}
    		
    		return  false;
    
        }
        catch(PDOException $ex){
            //echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());
        	//echo $ex->getMessage();
        	$error=array();
        	$error=$sql->errorInfo();
            //print_r($error);
        	if($error[1]=='1062'){
             return -1;
            }
        }
    }

    function generalUpdate($tableName,$arryCol,$arrData,$whereCol,$whereID){
        try{
        	$sqlStatment="UPDATE ".$tableName." set ". implode('=?,',$arryCol);
        	$sqlStatment.="=? "."where ".$whereCol." = ?";
        	//echo $sqlStatment;
        	$sql =  $this->pdo->prepare($sqlStatment);
        	for( $i =1 ; $i<count($arryCol)+1;$i++){
        
        		$sql->bindValue($i, $arrData[$i-1]);
        	}
            $sql->bindValue($i, "$whereID");
        
        	if($sql->execute()){
        		return  1;
        	}
        	else{
        		return 0;
        	}
        	return  0 ;
        }
        catch(PDOException $ex){
        		//echo "An Error occured!"; //user friendly message
            //some_logging_function($ex->getMessage());
        //	echo $ex->getMessage();
        	$error=array();
        	$error=$sql->errorInfo();
        	//print_r($error);
        	if($error[1]=='1062'){
                return -1;
            }
        }
}

    function generalDelete($tableName,$Col,$value){

	$sqlStatment = "DELETE FROM ".$tableName." where ".$Col." = "."?";

	$sql =  $this->pdo->prepare($sqlStatment);
	$sql->bindValue(1,$value);
	if($sql->execute())
	{
		return 1;
	}
	return 0;



}
    
    function getSlider($limit){
    try{

		$sqlStatment="select fields.id,media.link as image from fields inner join media on fields.image=media.id where fields.type='slider' ";
	    $sqlStatment.="order by fields.sorder asc";
	    if($limit!=0){
    		    $sqlStatment.=" LIMIT ?  " ;
    	} 
		$sql =  $this->pdo->prepare($sqlStatment);
		if($limit!=0){
    		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
		}
    	//echo $sqlStatment;
		if($sql->execute()){
			$arr= $sql->fetchAll();
			if(count($arr)>0)
			{
				return $arr;
			}
			return 0;
		}
		else{
			return 0;
		}
		return 0;
	}
	catch(PDOException $ex){
    }
  }
   
	public function getMostSeenVideos($limit=null){
        try{    
                if($limit==null){
                    $limit=10;
                }
        		$sqlStatment="select videos.*,AVG(rate) as rate  from videos left join video_rate on video_rate.video=videos.id group by video_rate.video order by seen desc ";
        		if($limit!=0 && $limit!=null){
        		    $sqlStatment.=" LIMIT ?  " ;
        		} 
        	//echo $sqlStatment;
        		$sql =  $this->pdo->prepare($sqlStatment);
        		if($limit!=0 && $limit!=null){
            		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
        		}
        		if($sql->execute()){
    
        			$arr= $sql->fetchAll();
        		
        			if(count($arr)>0)
        			{
        				return $arr;
        			}
        			
        			return 0;
        
        		}
        		else{
        			return 0;
        		}
        		return 0;
        			
        }
        catch(PDOException $ex){
        }
    }

    public function getMostRecentCourses($limit=null){
        try{    
                if($limit==null){
                    $limit=10;
                }
        		$sqlStatment="SELECT courses.*,categories.name as category_name FROM `courses` inner join categories on categories.id=courses.category_id ORDER by courses.time_inserted desc";
        		if($limit!=0 && $limit!=null){
        		    $sqlStatment.=" LIMIT ?  " ;
        		} 
        	//echo $sqlStatment;
        		$sql =  $this->pdo->prepare($sqlStatment);
        		if($limit!=0 && $limit!=null){
            		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
        		}
        		if($sql->execute()){
    
        			$arr= $sql->fetchAll();
        		
        			if(count($arr)>0)
        			{
        				return $arr;
        			}
        			
        			return 0;
        
        		}
        		else{
        			return 0;
        		}
        		return 0;
        			
        }
        catch(PDOException $ex){
        }
    }

    public function getVideoById($id){
        try{    
    		$sqlStatment="SELECT videos.*,date(videos.start) as start_date,time(videos.start) as start_time,courses.name as course_name,
    		courses.live,SUM(rate) as rate FROM `videos` inner join courses on 
    		courses.id=videos.course_id left join video_rate on video_rate.video=videos.id where videos.id=$id
    		GROUP by video_rate.video ";
    		$sql =  $this->pdo->prepare($sqlStatment);
    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    			return 0;
    		}
    		return 0;
        }
        catch(PDOException $ex){
        }
    } 
    
    public function getVideos($id,$course){
    try{    
	    $sqlStatment="SELECT videos.*,date(videos.start) as start_date,time(videos.start) as start_time,courses.name as course_name,courses.live from videos inner join courses on courses.id=videos.course_id inner join video_user 
	    on video_user.video_id=videos.id where videos.course_id=$course and video_user.user_id=$id";
		$sql =  $this->pdo->prepare($sqlStatment);
		if($sql->execute()){

			$arr= $sql->fetchAll();
		
			if(count($arr)>0)
			{
				return $arr;
			}
			
			return 0;

		}
		else{
			return 0;
		}
		return 0;
    }
    catch(PDOException $ex){
    }
} 
   
    public function getCourses($id){
    try{    
		$sqlStatment="select courses.id,courses.name from user_course inner join courses on courses.id=user_course.course where user_course.user=$id";
		$sql =  $this->pdo->prepare($sqlStatment);
		if($sql->execute()){

			$arr= $sql->fetchAll();
		
			if(count($arr)>0)
			{
				return $arr;
			}
			
			return 0;

		}
		else{
			return 0;
		}
		return 0;
    }
    catch(PDOException $ex){
    }
}
    
    public function getMostRecentCoursesBycats($id,$limit=null){
        try{    
                if($limit==null){
                    $limit=10;
                }
        		$sqlStatment="SELECT courses.*,categories.name as category_name FROM `courses` inner join categories on
        		categories.id=courses.category_id where categories.id=$id ORDER by courses.time_inserted desc";
        		if($limit!=0 && $limit!=null){
        		    $sqlStatment.=" LIMIT ?  " ;
        		} 
        	//echo $sqlStatment;
        		$sql =  $this->pdo->prepare($sqlStatment);
        		if($limit!=0 && $limit!=null){
            		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
        		}
        		if($sql->execute()){
    
        			$arr= $sql->fetchAll();
        		
        			if(count($arr)>0)
        			{
        				return $arr;
        			}
        			
        			return 0;
        
        		}
        		else{
        			return 0;
        		}
        		return 0;
        			
        }
        catch(PDOException $ex){
        }
    }
    
    public function getFavourite($id,$page=null,$limit=null){
        try{    
                if($limit==null){
                    $limit=10;
                }
                $offset=(($page-1)*$limit);
        		$sqlStatment="SELECT courses.*,categories.name as category_name,fav_course.id as fav_course_id FROM fav_course inner join `courses` on courses.id=fav_course.course 
        		inner join categories on
        		categories.id=courses.category_id where fav_course.user=$id ORDER by fav_course.id asc";
        		if($limit!=0 && $limit!=null){
        		    $sqlStatment.=" LIMIT ?  " ;
        		} 
        		if($page!=0 && $page!=null){
        		    $sqlStatment.=" offset ?  " ;
        		} 
        	//echo $sqlStatment;
        		$sql =  $this->pdo->prepare($sqlStatment);
        		if($limit!=0 && $limit!=null){
            		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
        		}
        		if($page!=0 && $page!=null){
            		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
        		}
        		if($sql->execute()){
    
        			$arr= $sql->fetchAll();
        		
        			if(count($arr)>0)
        			{
        				return $arr;
        			}
        			
        			return 0;
        
        		}
        		else{
        			return 0;
        		}
        		return 0;
        			
        }
        catch(PDOException $ex){
        }        
    }
    
    public function search($key,$page,$limit){
        try{
            if($limit==null){
                $limit=10;
            }
            $offset=(($page-1)*$limit);
    		$sqlStatment="select videos.id,videos.name,videos.image,videos.video_link,'Video' as type from videos where videos.name like '%$key%'
                        union 
                        select courses.id,courses.name,courses.image,courses.video_link,'Courses' as type from courses where courses.name like '%$key%'
                        union 
                        select categories.id,categories.name,categories.image,' 'as video_link,'Categories' as type from categories where categories.name like '%$key%'
                        ";
    		if($limit!=0 && $limit!=null){
    		    $sqlStatment.=" LIMIT ?  " ;
    		} 
    		if($page!=0 && $page!=null){
    		    $sqlStatment.=" offset ?  " ;
    		} 
    	//echo $sqlStatment;
    		$sql =  $this->pdo->prepare($sqlStatment);
    		if($limit!=0 && $limit!=null){
        		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
    		}
    		if($page!=0 && $page!=null){
        		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
    		}
    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    			return 0;
    		}
    		return 0;
        }
        catch(PDOException $ex){
        } 
    }

    public function notification($id,$page,$limit){
        try{
            if($limit==null){
                $limit=10;
            }
            $offset=(($page-1)*$limit);
    		$sqlStatment="select videos.*,date(videos.start) as start_date,time(videos.start) as start_time,courses.name as course_name,'new video'
    		as notify from videos inner join courses on videos.course_id=courses.id inner join user_course on user_course.course=courses.id 
    		where user_course.user=$id and videos.id not in (select video_id from video_user where video_user.user_id=$id)
            and videos.time_inserted>user_course.time_joined";
    		if($limit!=0 && $limit!=null){
    		    $sqlStatment.=" LIMIT ?  " ;
    		} 
    		if($page!=0 && $page!=null){
    		    $sqlStatment.=" offset ?  " ;
    		} 
    	//echo $sqlStatment;
    		$sql =  $this->pdo->prepare($sqlStatment);
    		if($limit!=0 && $limit!=null){
        		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
    		}
    		if($page!=0 && $page!=null){
        		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
    		}
    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    			return 0;
    		}
    		return 0;
        }
        catch(PDOException $ex){
        } 
    }
    
    public function getDiscussion($id,$page,$limit){
        try{
            if($limit==null){
                $limit=10;
            }
            $offset=(($page-1)*$limit);
    		
    		$sqlStatment="select discussion.id,user.username,videos.name,discussion.user_id,discussion.question,discussion.video from discussion 
    		inner join user on user.id=discussion.user_id inner join videos on videos.id=discussion.video where discussion.video=$id ";
    		
    		if($limit!=0 && $limit!=null){
    		    $sqlStatment.=" LIMIT ?  " ;
    		} 
    		if($page!=0 && $page!=null){
    		    $sqlStatment.=" offset ?  " ;
    		} 
    	//echo $sqlStatment;
    		$sql =  $this->pdo->prepare($sqlStatment);
    		if($limit!=0 && $limit!=null){
        		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
    		}
    		if($page!=0 && $page!=null){
        		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
    		}
    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    			return 0;
    		}
    		return 0;
        }
        catch(PDOException $ex){
        } 
    }

    public function getReply($id,$page,$limit){
        try{
            if($limit==null){
                $limit=10;
            }
            $offset=(($page-1)*$limit);
    		
    		$sqlStatment="select discussion_reply.id,discussion_reply.user_id,discussion_reply.reply,discussion_reply.question_id,discussion.question,user.username from discussion_reply inner join user on user.id=discussion_reply.user_id inner
    		join discussion on discussion.id=discussion_reply.question_id where discussion_reply.question_id=$id ";
    		
    		if($limit!=0 && $limit!=null){
    		    $sqlStatment.=" LIMIT ?  " ;
    		} 
    		if($page!=0 && $page!=null){
    		    $sqlStatment.=" offset ?  " ;
    		} 
    	//echo $sqlStatment;
    		$sql =  $this->pdo->prepare($sqlStatment);
    		if($limit!=0 && $limit!=null){
        		 $sql->bindValue(1,(int) trim($limit), PDO::PARAM_INT); 
    		}
    		if($page!=0 && $page!=null){
        		 $sql->bindValue(2,(int) trim($offset), PDO::PARAM_INT); 
    		}
    		if($sql->execute()){

    			$arr= $sql->fetchAll();
    		
    			if(count($arr)>0)
    			{
    				return $arr;
    			}
    			
    			return 0;
    
    		}
    		else{
    			return 0;
    		}
    		return 0;
        }
        catch(PDOException $ex){
        } 
    }
}
?>