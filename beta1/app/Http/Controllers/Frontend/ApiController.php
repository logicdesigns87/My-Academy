<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Course;
use App\Models\Category;
use App\Models\Bookmark;
use App\Models\Lesson;
use App\Models\Content;
use App\Models\Section;

use Illuminate\Support\Facades\DB;
use App\Models\Access\User\User;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\Frontend\Auth\RegisterRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use Auth;
use Hash;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    
  public function getCoursesByCategoryAPI(Request $request) {
    $flag=0;
    if($request->key == "logic123"){
    //   return json_encode(Course::where('category_id',$request->id)->get());
        $user_id = $request->user_id;
        $user = User::whereId($user_id)->first();
      $courses = Course::where('category_id',$request->id)->get();
      if(!$courses->isEmpty()){
        $requests = ["courses" => "",
        "success" => 1,
        "message" => "courses successfully imported."];
        foreach($courses as $course) {
            if($course->language == null)$course->language='';
            $course_lessons_count=0;
            $course_lessons_duration=0;
            $course->preview_video = 'https://logic-host.com/work/myacademy/beta1/public' . $course->preview_video;
            $course->icon = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg';
            $course->live = 0;
            $bookmarked = Bookmark::where('user_id', $user_id)->where('course_id', $course->id)->get();
            if(!$bookmarked->isEmpty()){
                $course->bookmarked = (int)1;
            }
            else{
                $course->bookmarked = (int)0;
            }
            $course->enrolled = (int)$user->hasEnrolled($course);
            $course->image = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/' . $course->image;
            $course->author;
            if($course->author->avatar == null)$course->author->avatar='';
            if($course->author->bio == null)$course->author->bio='';
            // $course->sections;
            $course->users_count = $course->students->count();
            $course->description = substr(strip_tags($course->description), 0, 100);
            foreach($course->sections as $section) {
              $section->lessons_count = $section->lessons->count();
              foreach( $section->lessons as $lesson){
                  if($lesson->description == null)$lesson->description='';
                //   $lesson->content;
                  $contents = Content::whereLesson_id($lesson->id)->get();
                  foreach($contents as $content){
                      if($content->content_type == 'video'){
                          $test[$flag] = $content->video_duration;
                          $flag++;
                          $course_lessons_duration += $content->video_duration;
                          $course_lessons_count++;
                      }
                  }
              }
            }
            $course->lectures_count = $course_lessons_count;
            $course->lectures_duration = $course_lessons_duration;
        }
            // return json_encode($test);

          $requests['courses']= $courses;
          return json_encode($requests);
      }
      else{
        $requests = [
        "success" => 0,
        "message" => "No courses."];
        return json_encode($requests);

      }
    }
  }
  
    public function getVideosByCourseAPI(Request $request) {
        if($request->key == "logic123"){
            $video_counts = 0;
            $course = Course::where('id',$request->id)->first();
            if(!empty($course)){
                foreach($course->sections as $section) {
                    foreach( $section->lessons as $lesson){
                        $contents = Content::whereLesson_id($lesson->id)->get();
                        foreach($contents as $content){
                            if($content->content_type == 'video'){
                                if($content->video_storage == 'local'){
                                    $videos[$video_counts]['id'] = $content->id;
                                    $videos[$video_counts]['name'] = $lesson->title;
                                    $videos[$video_counts]['video'] = 'https://logic-host.com/work/myacademy/beta1/public' . $content->video_path;
                                    if($lesson->description == null) $videos[$video_counts]['description'] = '';
                                    else $videos[$video_counts]['description'] = $lesson->description;
                                    $video_counts++;
                                }
                                else{
                                    $videos[$video_counts]['id'] = $content->id;
                                    $videos[$video_counts]['name'] = $lesson->title;
                                    $videos[$video_counts]['video'] = 'https://logic-host.com/work/myacademy/beta1/public/uploads/videos/NGT-partitionbyrightouterjoin.mp4';
                                    if($lesson->description == null) $videos[$video_counts]['description'] = '';
                                    else $videos[$video_counts]['description'] = $lesson->description;
                                    $video_counts++;
    
                                }
                            }
                        }
                    }
                }
            
                if($video_counts != 0){
                    $requests['videos']  = $videos;
                    $requests['count']   = $video_counts;
                    $requests['success'] = 1;
                    $requests['message'] = 'videos successfully imported.';
                    
                    return json_encode($requests);
                }
                else{
                    $requests['success'] = 0;
                    $requests['message'] = 'No Videos set for this course';

                    return json_encode($requests);

                }
            }
            else{
                $requests['success'] = 0;
                $requests['message'] = 'No course found for this id.';
                
                return json_encode($requests);

            }

        }

    }

  public function signupAPI(Request $request) {
    if($request->key == "logic123"){
        $return = [];
        $username_email = User::where('email', $request->email)->where('username', $request->username)->first();
        $email = User::whereEmail($request->email)->first();
        $username = User::whereUsername($request->username)->first();
        // if(!empty($username_email)){ // -1=>username and email duplicated
        //     $return['success'] = -1;
        //     $return['message'] = 'The email and username already exist.';
        //     return json_encode($return);
        // }

        if(!empty($email)){ // -2=>email duplicated
            $return['success'] = 0;
            $return['message'] = 'The email already exists.';
            return json_encode($return);
        }
        // elseif(!empty($username)){ // -3=>username duplicated
        //     $return['success'] = -3;
        //     $return['message'] = 'The username already exists.';
        //     return json_encode($return);
        // }
        else{
            $user = new User;
            $user->username = $request->username;
            $user->first_name = '';
            $user->last_name ='';
            $user->avatar = '';
            $user->fid = '';
            $user->googleid = '';
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->confirmation_code = md5(uniqid(mt_rand(), true));
            $user->confirmed = 1;
            // $a = bcrypt($request->password);
            // $b = Hash::check($request->password, $a);
            $user->save();
            if($user->save()){
                // $user->id = (string)$user->id;
                $return['user'] = array($user);
                $return['success'] = 1;
                $return['message'] = 'User inserted Successfully.';
                return json_encode($return);
            }
            else{
                $return['success'] = 0;
                $return['message'] = 'ERROR';
                return json_encode($return);
            }

        }
    
        // $user = $this->user->create($request->only('username', 'email', 'password'));
        // event(new UserRegistered($user));
    }

  }

  public function profileEditAPI(Request $request) {
    if($request->key == "logic123"){
        $return = [];
        $user_found = User::whereId($request->user_id)->first();

        if(!empty($user_found)){
            // $username_email = User::where('email', $request->email)->where('username', $request->username)->first();
            $email = User::whereEmail($request->email)->first();
            // $username = User::whereUsername($request->username)->first();
            // if(!empty($username_email)){ // -1=>username and email duplicated
            //     if(($user_found->username == $request->username) && ($user_found->email == $request->email)){
                    
            //     }
            //     else{
            //         $return['success'] = 0;
            //         $return['message'] = 'The email and username already exist.';
            //         return json_encode($return);
            //     }
            // }
    
            if(!empty($email)){ // -2=>email duplicated
                if($user_found->email == $request->email){
                    
                }
                else{
                    $return['success'] = 0;
                    $return['message'] = 'The email already exists.';
                    return json_encode($return);
                }
            }
            // if(!empty($username)){ // -3=>username duplicated
            //     if(($user_found->username == $request->username) && ($user_found->email == $request->email)){
                    
            //     }
            //     else{

            //         $return['success'] = -3;
            //         $return['message'] = 'The username already exists.';
            //         return json_encode($return);
            //     }
            // }
            
            $user_found->username = $request->username;
            $user_found->first_name = '';
            $user_found->last_name ='';
            $user_found->email = $request->email;
            $user_found->phone = $request->phone;
            if($user_found->avatar == null)$user_found->avatar = '';
            if($user_found->fid == null)$user_found->fid = '';
            if($user_found->googleid == null)$user_found->googleid = '';
            if($user_found->password != '')$user_found->password = bcrypt($request->password);
            // $user->confirmation_code = md5(uniqid(mt_rand(), true));
            // $user->confirmed = 1;
            // $a = bcrypt($request->password);
            // $b = Hash::check($request->password, $a);
            $user_found->save();
            if($user_found->save()){
                // $user->id = (string)$user->id;
                $return['user'] = array($user_found);
                $return['success'] = 1;
                $return['message'] = 'User edited Successfully.';
                return json_encode($return);
            }
            else{
                $return['success'] = 0;
                $return['message'] = 'ERROR';
                return json_encode($return);
            }
    
            

        }
        else{
            $return['success'] = 0;
            $return['message'] = 'ERROR No matching id found';
            return json_encode($return);
        }
    }
    else{
        $return['success'] = 0;
        $return['message'] = 'ERROR No matching key found';
        return json_encode($return);
    }

  }
  
    public function loginAPI(Request $request) {
        if($request->key == "logic123"){
            $user = User::whereEmail($request->email)->first();
            if(!empty($user)){
                $password_correct = Hash::check($request->password, $user->password);
                if($password_correct){
                    // settype($user->id, "string");
                    // $user->id = strval($user->id);
                    // if($user->avatar == null)$user->avatar = '';
                    // if($user->fid == null)$user->fid = '';
                    // if($user->googleid == null)$user->googleid = '';
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User logged in Successfully.';
                    return json_encode($return);
                }
                else{
                    $return['success'] = -1;
                    $return['message'] = 'Wrong Password.';
                    return json_encode($return);
   
                }
            }
            else{ //0=>error
                $return['success'] = 0;
                $return['message'] = 'ERROR';
                return json_encode($return);
            }
        }
    }

    public function signInOrUpWithFacebookAPI(Request $request) {
        if($request->key == "logic123"){
            $user = User::whereFid($request->fid)->first();
            if(!empty($user)){ // Logged in
                $user_byUsername = User::whereUsername($request->username)->first();
                $user_byEmail = User::whereEmail($request->email)->first();
                if(!empty($user_byUsername) && !empty($user_byEmail)){
                    $user->avatar = $request->avatar;
                    $user->save();
                    if($user->avatar == null)$user->avatar = '';
                    if($user->fid == null)$user->fid = '';
                    if($user->googleid == null)$user->googleid = '';
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User logged in Successfully.';
                    return json_encode($return);
                }
                else{
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->avatar = $request->avatar;
                    if($user->fid == null)$user->fid = '';
                    if($user->googleid == null)$user->googleid = '';
                    $user->save();
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User logged in Successfully. Username Or Email Changed.';
                    return json_encode($return);
                }
            }
            else{ // Signed up
                $user = new User;
                $user->username = $request->username;
                $user->fid = $request->fid;
                $user->googleid = '';
                $user->avatar = $request->avatar;
                $user->first_name = '';
                $user->last_name ='';
                $user->email = $request->email;
                // $user->password = bcrypt($request->password);
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->confirmed = 1;
                $user->save();
                if($user->save()){
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User inserted Successfully.';
                    return json_encode($return);
                }
                else{
                    $return['success'] = 0;
                    $return['message'] = 'ERROR';
                    return json_encode($return);
                }
            }
        }
    }
    
    public function signInOrUpWithGoogleAPI(Request $request) {
        if($request->key == "logic123"){
            $user = User::whereGoogleid($request->googleid)->first();
            if(!empty($user)){ // Logged in
                $user_byUsername = User::whereUsername($request->username)->first();
                $user_byEmail = User::whereEmail($request->email)->first();
                if(!empty($user_byUsername) && !empty($user_byEmail)){
                    $user->avatar = $request->avatar;
                    $user->save();
                    if($user->avatar == null)$user->avatar = '';
                    if($user->fid == null)$user->fid = '';
                    if($user->googleid == null)$user->googleid = '';
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User logged in Successfully.';
                    return json_encode($return);
                }
                else{
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->avatar = $request->avatar;
                    $user->save();
                    if($user->avatar == null)$user->avatar = '';
                    if($user->fid == null)$user->fid = '';
                    if($user->googleid == null)$user->googleid = '';
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User logged in Successfully. Username Or Email Changed.';
                    return json_encode($return);
                }
            }
            else{ // Signed up
                $user = new User;
                $user->username = $request->username;
                $user->googleid = $request->googleid;
                $user->avatar = $request->avatar;
                $user->first_name = '';
                $user->last_name ='';
                $user->email = $request->email;
                // $user->password = bcrypt($request->password);
                $user->confirmation_code = md5(uniqid(mt_rand(), true));
                $user->confirmed = 1;
                $user->save();
                if($user->save()){
                    if($user->avatar == null)$user->avatar = '';
                    if($user->fid == null)$user->fid = '';
                    if($user->googleid == null)$user->googleid = '';
                    $return['user'] = array($user);
                    $return['success'] = 1;
                    $return['message'] = 'User inserted Successfully.';
                    return json_encode($return);
                }
                else{
                    $return['success'] = 0;
                    $return['message'] = 'ERROR';
                    return json_encode($return);
                }
            }
        }
    }

    public function HomeAPI(Request $request) {
        if($request->key == "logic123"){
            /*
            key,limit(limit of categories),limit_videos(limit of most seen videos),limit_slider(limit of slider images),limit_top(limit of top courses for all categories)
            Return
            0,1 for every partition
            */
            
            $limit = $request->limit;
            $limit_top = $request->limit_top;
            $categories = Category::select('id','name')->limit($limit)->get();
            $user = User::whereId($request->user_id)->first();
            if(!$categories->isEmpty()){
                $requests['categories']= $categories;
                $requests['success_categories']= 1;
                $requests['message_categories']= 'categories successfully imported.';
                foreach($categories as $category){
                    $category->image = "https://logic-host.com/work/myacademy/beta/phpFiles/images/Business.png"; //dummy
                
                    $courses = Course::where('category_id',$category->id)->limit($limit_top)->get();
                    if(!$courses->isEmpty()){
                        foreach($courses as $course) {
                            // $course->image    = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/'. $course->image;
                            $course->name     = $course->title;
                            $course->category = $category->name;
                            // $course->live     = 0;
                            // $course->author;
                            // $course->sections;
                            // $course->users_count = $course->students->count();
                            // $course->description = strip_tags($course->description);
                            // foreach($course->sections as $section) {
                            //     $section->lessons_count = $section->lessons->count();
                            //     foreach( $section->lessons as $lesson){
                            //         $lesson->content;
                            //     }
                            // }
                            $course_lessons_count=0;
                            $course_lessons_duration=0;
                            $course->preview_video = 'https://logic-host.com/work/myacademy/beta1/public' . $course->preview_video;
                            $course->icon = 'https://logic-host.com/work/myacademy/beta1/public/img1/edit.png';
                            $course->live = 0;
                            $course->created_at_modified = substr($course->created_at,0,10);
                            $course->updated_at_modified = substr($course->updated_at,0,10);

                            $bookmarked = Bookmark::where('user_id', $request->user_id)->where('course_id', $course->id)->get();
                            if(!$bookmarked->isEmpty()){
                                $course->bookmarked = 1;
                            }
                            else{
                                $course->bookmarked = 0;
                            }
                            $course->enrolled = (int)$user->hasEnrolled($course);
                            $course->image = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/' . $course->image;
                            $course->author;
                            if($course->author->avatar == null)$course->author->avatar = '';
                            if($course->author->bio == null)$course->author->bio='';
                            // $course->sections;
                            $course->users_count = $course->students->count();
                            $course->description = substr(strip_tags($course->description), 0, 100);
                            foreach($course->sections as $section) {
                              $section->lessons_count = $section->lessons->count();
                              foreach( $section->lessons as $lesson){
                                //   $lesson->content;
                                  $contents = Content::whereLesson_id($lesson->id)->get();
                                  foreach($contents as $content){
                                      if($content->content_type == 'video'){
                                        //   $test[$flag] = $content->video_duration;
                                        //   $flag++;
                                          $course_lessons_duration += $content->video_duration;
                                          $course_lessons_count++;
                                      }
                                  }
                              }
                            }
                            $course->lectures_count = $course_lessons_count;
                            $course->lectures_duration = $course_lessons_duration;

                        }
                        $category_name = $category->name;
                        $requests[$category_name]= $courses;
                        $success = 'success_'.$category->name;
                        $requests[$success]= 1;
                        $message = 'message_'.$category->name;
                        $requests[$message]= 'Successfully imported.';

                    }
                    else{
                        $success = 'success_'.$category->name;
                        $requests[$success]= 0;
                        $message = 'message_'.$category->name;
                        $requests[$message]= 'No data.';
                    }
                }
                $slider = array(
                    (object) array(
                    'id' => '1',
                    'image'=>'https://logic-host.com/work/myacademy/beta/phpFiles/images/DigitalMarketing.png'
                    ),
                    (object) array(
                    'id' => '2',
                    'image'=>'https://logic-host.com/work/myacademy/beta/phpFiles/images/DigitalMarketing.png'
                    )
                );
                $requests['slider']= $slider;
                $requests['success_slider']= 1;
                $requests['message_slider']= 'sliders successfully imported.';
                return json_encode($requests);
            }
            else{
                $requests['success_categories']= 0;
                $requests['message_categories']= 'No Categories.';
                return json_encode($requests);
            }


        }
    }
    
    public function addFavouriteAPI(Request $request) {
        if($request->key == "logic123"){
            $bookmark = Bookmark::where('user_id', $request->id)->where('course_id', $request->course)->get();
            if(!$bookmark->isEmpty()){
                $requests['success']= -1;
                $requests['message']= 'Already exist in the favourite list.';
                return json_encode($requests);
            }
            else{
                $bookmark = new Bookmark;
                $bookmark->user_id   = $request->id;
                $bookmark->course_id = $request->course;
                // $bookmark->created_at = date('Y-m-d H:i:s');
                $bookmark->save();
                if($bookmark->save()){
                    $return['success'] = 1;
                    $return['message'] = 'course successfully added in the favourite list.';
                    return json_encode($return);
                }
                else{
                    $return['success'] = 0;
                    $return['message'] = 'ERROR';
                    return json_encode($return);
                }
            }
        }
    }

    public function deleteFavouriteAPI(Request $request) {
        
        if($request->key == "logic123"){
            $bookmark = Bookmark::where('id', $request->fav_course_id)->delete();
            if($bookmark){
                $requests['success']= 1;
                $requests['message']= 'Course successfully removed from the favourite list.';
                return json_encode($requests);
            }
            else{
                $return['success'] = 0;
                $return['message'] = 'ID not found, ERROR.';
                return json_encode($return);
            }
        }
    }

    public function favouriteAPI(Request $request) {
        
        if($request->key == "logic123"){
            $counter =0;
            $user = User::whereId($request->id)->first();
            $bookmark = Bookmark::where('user_id', $request->id)->get();
            if(!$bookmark->isEmpty()){
                foreach($bookmark as $bookmark_single){
                    $courses[] = $bookmark_single->course;
                    $bookmarked_ids[] = $bookmark_single->id;
                }
                foreach($courses as $course) {
                    $course->favourite_id = $bookmarked_ids[$counter];
                    $counter++;
                    $category = $course->category;
                    $category->image = "https://logic-host.com/work/myacademy/beta/phpFiles/images/Business.png"; //dummy
                    $course_lessons_count=0;
                    $course_lessons_duration=0;
                    $course->preview_video = 'https://logic-host.com/work/myacademy/beta1/public' . $course->preview_video;
                    $course->icon = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg';
                    $course->live = 0;
                    // $bookmarked = Bookmark::where('user_id', $request->id)->where('course_id', $course->id)->get();
                    // if(!$bookmarked->isEmpty()){
                    //     $course->bookmarked = true;
                    // }
                    // else{
                    //     $course->bookmarked = false;
                    // }
                    $course->enrolled = (int)$user->hasEnrolled($course);
                    $course->image = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/' . $course->image;
                    $course->author;
                    if($course->author->avatar == null)$course->author->avatar = '';
                    if($course->author->bio == null)$course->author->bio='';
                    // $course->sections;
                    $course->users_count = $course->students->count();
                    $course->description = substr(strip_tags($course->description), 0, 100);
                    foreach($course->sections as $section) {
                      $section->lessons_count = $section->lessons->count();
                      foreach( $section->lessons as $lesson){
                          if($lesson->description == null)$lesson->description='';
                        //   $lesson->content;
                          $contents = Content::whereLesson_id($lesson->id)->get();
                          foreach($contents as $content){
                              if($content->content_type == 'video'){
                                //   $test[$flag] = $content->video_duration;
                                //   $flag++;
                                  $course_lessons_duration += $content->video_duration;
                                  $course_lessons_count++;
                              }
                          }
                      }
                    }
                    $course->lectures_count = $course_lessons_count;
                    $course->lectures_duration = $course_lessons_duration;
                }
                $requests['courses']= $courses;
                $requests['success']= 1;
                $requests['message']= 'favourite successfully imported.';
                return json_encode($requests);
            }
            else{
                $requests['success'] = 0;
                $requests['message'] = 'ERROR.';
                return json_encode($requests);
            }
        }
    }
    
    public function searchAPI(Request $request) {
        
        if($request->key == "logic123"){
            $keyword = $request->keyword;
            $courses = Course::where('title', 'LIKE', "%$keyword%")->orWhere('description', 'LIKE', "%$keyword%")->get();
            $user = User::whereId($request->user_id)->first();
            if(!$courses->isEmpty()){
                foreach($courses as $course) {
                    $category = $course->category;
                    $category->image = "https://logic-host.com/work/myacademy/beta/phpFiles/images/Business.png"; //dummy
                    $course_lessons_count=0;
                    $course_lessons_duration=0;
                    $course->preview_video = 'https://logic-host.com/work/myacademy/beta1/public' . $course->preview_video;
                    $course->icon = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg';
                    $course->live = 0;
                    $bookmarked = Bookmark::where('user_id', $user->id)->where('course_id', $course->id)->get();
                    if(!$bookmarked->isEmpty()){
                        $course->bookmarked = (int)1;
                    }
                    else{
                        $course->bookmarked = (int)0;
                    }
                    $course->enrolled = (int)$user->hasEnrolled($course);
                    $course->image = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/' . $course->image;
                    $course->author;
                    if($course->author->avatar == null)$course->author->avatar = '';
                    if($course->author->bio == null)$course->author->bio='';
                    // $course->sections;
                    $course->users_count = $course->students->count();
                    $course->description = substr(strip_tags($course->description), 0, 100);
                    foreach($course->sections as $section) {
                      $section->lessons_count = $section->lessons->count();
                      foreach( $section->lessons as $lesson){
                          if($lesson->description == null)$lesson->description='';
                        //   $lesson->content;
                          $contents = Content::whereLesson_id($lesson->id)->get();
                          foreach($contents as $content){
                              if($content->content_type == 'video'){
                                //   $test[$flag] = $content->video_duration;
                                //   $flag++;
                                  $course_lessons_duration += $content->video_duration;
                                  $course_lessons_count++;
                              }
                          }
                      }
                    }
                    $course->lectures_count = $course_lessons_count;
                    $course->lectures_duration = $course_lessons_duration;
                }
                $requests['courses']= $courses;
                $requests['success']= 1;
                $requests['message']= 'Search Found';
                return json_encode($requests);
            }
            else{
                $requests['success'] = 0;
                $requests['message'] = 'Not Found.';
                return json_encode($requests);
            }

        }
    }

    public function forgetPasswordAPI(Request $request) {
        
        if($request->key == "logic123"){
            $user = User::whereEmail($request->email)->first();
            if(!empty($user)){
                    $return['success'] = 1;
                    $return['message'] = 'password sent succesfully.';
                    return json_encode($return);
            }
            else{ //0=>error
                $return['success'] = 0;
                $return['message'] = 'ERROR Wrong Email';
                return json_encode($return);
            }

        }
    }
    
    public function myCoursesAPI(Request $request) {
        if($request->key == "logic123"){
            $courses_return = [];
            $user = User::whereId($request->user_id)->first();
            if(!empty($user)){
                $courses_enrolled = DB::table('course_user')->where('user_id', $request->user_id)->get();
                foreach($courses_enrolled as $course_enrolled) {
                    $courses = Course::whereId($course_enrolled->course_id)->first();
                    if(!empty($courses)){
                        if($courses->price != 0){
                            // $category = $courses->category;
                            // $category->image = "https://logic-host.com/work/myacademy/beta/phpFiles/images/Business.png"; //dummy
                            $course_lessons_count=0;
                            $course_lessons_duration=0;
                            $courses->created_at_modified = substr($courses->created_at,0,10);
                            $courses->updated_at_modified = substr($courses->updated_at,0,10);

                            $courses->preview_video = 'https://logic-host.com/work/myacademy/beta1/public' . $courses->preview_video;
                            $courses->icon = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg';
                            $courses->live = 0;
                            $bookmarked = Bookmark::where('user_id', $user->id)->where('course_id', $courses->id)->get();
                            if(!$bookmarked->isEmpty()){
                                $courses->bookmarked = (int)true;
                            }
                            else{
                                $courses->bookmarked = (int)false;
                            }
                            $courses->enrolled = (int)$user->hasEnrolled($courses);
                            $courses->image = 'https://logic-host.com/work/myacademy/beta1/public/uploads/images/course/' . $courses->image;
                            $courses->author;
                            if($courses->author->avatar == null)$courses->author->avatar = '';
                            if($courses->author->bio == null)$courses->author->bio='';
                            // $course->sections;
                            $courses->users_count = $courses->students->count();
                            $courses->description = substr(strip_tags($courses->description), 0, 100);
                            foreach($courses->sections as $section) {
                              $section->lessons_count = $section->lessons->count();
                              foreach( $section->lessons as $lesson){
                                  if($lesson->description == null)$lesson->description='';
                                //   $lesson->content;
                                  $contents = Content::whereLesson_id($lesson->id)->get();
                                  foreach($contents as $content){
                                      if($content->content_type == 'video'){
                                        //   $test[$flag] = $content->video_duration;
                                        //   $flag++;
                                          $course_lessons_duration += $content->video_duration;
                                          $course_lessons_count++;
                                      }
                                  }
                              }
                            }
                            $courses->lectures_count = $course_lessons_count;
                            $courses->lectures_duration = $course_lessons_duration;
                            $courses_return[] = $courses;
                        }
                    }
                }
                if($courses_return){
                    $return['courses'] = $courses_return;
                    $return['success'] = 1;
                    $return['message'] = 'Courses Found Successfully.';
                    return json_encode($return);
                }
                else{
                    $return['success'] = 0;
                    $return['message'] = 'No Courses bought yet.';
                    return json_encode($return);

                }
            }
            else{ //0=>error
                $return['success'] = 0;
                $return['message'] = 'ERROR Wrong id';
                return json_encode($return);
            }

            
        }
    }


}
