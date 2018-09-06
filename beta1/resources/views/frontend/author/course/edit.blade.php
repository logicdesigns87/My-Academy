@extends('frontend.layouts.app1')
@section('title')
    {{ $course->title }} - {{trans('strings.frontend.course-landing-page')}}
@stop
@section('content')

<!-- HEADER BAR -->
<div class="info-bar ">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
       <div class="media">
          <div class="media-left">
              <img class="media-object" src="{{asset('uploads/avatars/'.auth()->user()->avatar)}}" alt="profile-img">
          </div>
          <div class="media-body">
            <h3 class="media-heading">Instructor</h3>
            <!--<p>(Member)</p>-->
          </div>
        </div>
    </div>
    <div class="info col-md-5">
        <div class="col-md-3 vert-line">
            <p><strong>{{auth()->user()->students()->count()}}</strong><br>Students</p>
        </div>
        <div class="col-md-3 vert-line">
           <p><strong>{{auth()->user()->authored_courses()->count()}}</strong><br>Courses</p> 
        </div>
        <div class="col-md-3 vert-line">
            <p><strong>{{auth()->user()->average_rating()}}</strong><br>Average Rating</p>
        </div>
        <div class="col-md-3">
            <p><strong>{{auth()->user()->reviews()->count()}}</strong><br>Total Reviews</p>
        </div>
    </div>
        </div>
    </div>
    
</div>
<section id="manage-course">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="list-sidebar">
                    <a href="#"><li class="active"><span class="check"><i class="fa fa-check"></i></span>Course info</li></a>
                    <a href="#"><li ><span class="check"><i class="fa fa-check"></i></span>course content</li></a>
                    <a href="#"><li ><span class="check"><i class="fa fa-check"></i></span>pricing and coupons</li></a>
                    <li><button class="btn btn-block btn-sidebar">Submit for review</button></li>
                </ul>
            </div>
             <div class="col-md-9">
                 
                 <section class="course-info">
                 <div class="panel panel1">
                      <div class="panel-heading panel-heading1">
                            <div class="panel-title"><i class="glyphicon glyphicon-th-list"></i>Course Landing Page</div>
                      </div>
                      <div class="panel-body panel-body1" >
                              <?php  echo Form::open(array('route' => array('updateCourse', $course->id), 'method' => 'put')) ?>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course title: </span>
                                  <input name="title" type="text" class="form-control" placeholder="Course title" aria-describedby="basic-addon1" value="{{$course->title}}">
                              </div>  
                              <label for="basic-url">Permalink:</label>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon3">https://www.myacademy.com/courses/</span>
                                  <input name="slug" name="{{$course->slug}}" type="text" class="form-control" placeholder=" " id="basic-url" aria-describedby="basic-addon3">
                              </div>
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course subtitle: </span>
                                  <input name="subtitle" type="text" class="form-control" placeholder="Course subtitle" aria-describedby="basic-addon1" value="{{$course->subtitle}}">
                              </div>  
                                <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course description: </span>
                                  <textarea name="description" id="smde" class="CodeMirror form-control" aria-describedby="basic-addon1"></textarea>
                              </div>
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course level: </span>
                                  <select name="level" class="form-control" aria-describedby="basic-addon1">
                                    <option <?php if($course->level =="beginner"): echo "selected"; endif; ?>
                                    value='beginner'>beginner</option>
                                    <option <?php if($course->level =="intermediate"): echo "selected"; endif; ?> value="intermediate" >intermediate</option>
                                    <option <?php if($course->level =="advanced"): echo "selected"; endif; ?> value="advanced" >Advanced</option>
                                  </select>
                              </div>  
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Language of Instruction: </span>
                                  <input name="language" type="text" class="form-control" aria-describedby="basic-addon1">
                              </div>  
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Tags: </span>
                                  <input name="tags" type="text" class="form-control" aria-describedby="basic-addon1">
                              </div>  
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-default">Update Course</button>
                                </div>
                              </div>
                            </form>
                      </div>
                </div>
                </section>
                
                <section class="vid course-content">
                    <div class="chapters animated fadeInRight">
                        <!-- Video Lesson Section -->
                        <div class="video-lesson">
                            <div class="hline">
                                <h4>Course Curriculum</h4>
                            </div>
                             <div class="alert alert-danger" role="alert">You must mark at least one video lesson as "FREE PREVIEW" before your course can be approved. Without this the course will not be published</div>
                            <div class="lessons">
                                <ol>
                                    <li> Chapter 1: 
                                        <ul>
                                            <li><a><i class="glyphicon glyphicon-play"></i> Lesson1: Introduction</a>
                                                <div class="row add-content">
                                                    <div class="col-md-4"><a class="btn btn-default btn2"><i class="glyphicon glyphicon-edit"> Edit Lesson</i></a></div>
                                                    <div class="col-md-4"><a class="btn btn-default btn2"><i class="glyphicon glyphicon-edit"> Delete Lesson</i></a></div>
                                                    <div class="col-md-4"><a data-toggle="collapse" href="#lesson-content" class="btn btn-default btn2" draggable="false" aria-expanded="false"><i class="fa fa-angle-down"></i> Add Content</a>
                                                    </div>
                                                </div>
                                                <div id="lesson-content" class="col-sm-8 col-sm-offset-2 panel-collapse collapse in" aria-expanded="false" style="height:0">
                                                    <div class="btn-group" role="group" aria-label="...">
                                                        <button type="button" class="btn btn-default btn4"><i class="glyphicon glyphicon-pencil"> Add TEXT Content </i></button>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-default btn4 dropdown-toggle" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                                                                <i class="glyphicon glyphicon-play-circle"> Add VIDEO Content</i>
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                              <li><a href="#"><i class="glyphicon glyphicon-play"> Upload Video</i></a></li>
                                                              <li><a href="#"><i class="glyphicon glyphicon-play"> Youtube Video Link</i></a></li>
                                                              <li><a href="#"><i class="glyphicon glyphicon-play"> Vimeo Video Link</i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>     
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                            <div class="row">
                              <div class="col-sm-offset-2 col-sm-4"><a type="submit" class="btn btn-default btn2 btn3"><i class="glyphicon glyphicon-plus"></i> ADD a Lesson</a></div>
                              <div class="col-sm-4"><a type="submit" class="btn btn-default btn2 btn3"><i class="glyphicon glyphicon-plus"></i> ADD a Section</a></div>
                            </div>
                        </div>
                    </div>
                    
                    <section class="course-price">
                 <div class="panel panel1">
                      <div class="panel-heading panel-heading1">
                            <div class="panel-title"><i class="glyphicon glyphicon-th-list"></i>Coupons</div>
                      </div>
                      <div class="panel-body panel-body1" >
                          <form>
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course Price: </span>
                                  <select class="form-control" aria-describedby="basic-addon1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                  </select>
                              </div>  

                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Create New Coupon</button>
                                    <button type="submit" class="btn btn-default">save</button>
                                </div>
                              </div>
                            </form>
                      </div>
                    </div>
                 </section>
               
                </section>
             </div>
             
        </div>
    </div>
</section>

<!--====================footer =========== -->
@endsection