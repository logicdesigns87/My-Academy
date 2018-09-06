@extends('frontend.layouts.app1')
@section('content')
<!-- ==================== CONTENT =========== -->

<!-- HEADER -->
<div class="info-bar row"> 
        
            <div class="col-md-7">
               <div class="media">
                  <div class="media-left">
                      <img class="media-object" src="{{asset($user->avatar)}}" alt="profile-img" style="max-width:100px; max-height:100px;">
                  </div>
                  <div class="media-body">
                    <h3 class="media-heading">{{$user->first_name}} {{$user->last_name}}</h3>
                    <p>(Member)</p>
                  </div>
                </div>
            </div>
            <div class="info col-md-5">
                <div class="col-md-3 vert-line">
                    <p><strong>{{$students->count()}}</strong><br>Students</p>
                </div>
                <div class="col-md-3 vert-line">
                   <p><strong>{{$courses->count()}}</strong><br>Courses</p> 
                </div>
                <div class="col-md-3 vert-line">
                    <p><strong>{{$rating}}</strong><br>Average Rating</p>
                </div>
                <div class="col-md-3">
                    <p><strong>{{$reviews->count()}}</strong><br>Total Reviews</p>
                </div>
            </div>
            
            </div>

<!------ Profile ---->
<section id="profile">
    <div class="container">
    <!------Edit Profile ---->
      <section>
            <div class="row">
                <div class="panel panel1 animated fadeInRight">
                      <div class="panel-heading panel-heading1">
                            <a class="panel-title"><i class="glyphicon glyphicon-th-list"></i> My Information</a>
                      </div>
                                <div class="panel-body panel-body1" >

                          <form method="get" action="{{route('frontend.user.profile.edit',$logged_in_user->id)}}" enctype="multipart/form-data">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Username</span>
                              <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="username" value="{{$logged_in_user->username}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text" class="form-control" placeholder="First Name" aria-describedby="basic-addon1" name="first_name" value="{{$logged_in_user->first_name}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Last Name</span>
                              <input type="text" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1" name="last_name" value="{{$logged_in_user->last_name}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Job Title</span>
                              <input type="text" class="form-control" placeholder="Job Title" aria-describedby="basic-addon1" name="tagline" value="{{$logged_in_user->tagline}}">
                            </div> 
                            <div class="panel panel-default">
                              <div class="about panel-heading">
                                <h3 class="panel-title">About ME</h3>
                              </div>
                              <textarea name="bio" class="about-text panel-body1" placeholder="Some Text About Me">{{$logged_in_user->bio}}</textarea>
                            </div>
                            <label for="basic-url">facebook</label>
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon3">https://www.facebook.com/</span>
                              <input name="facebook" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Facebook" value="{{$logged_in_user->facebook}}">
                            </div>
                            <button type="submit" class="btn btn-default">Edit Profile</button>
                         </form>
                          </div>
                      </div>
                </div>
                </section>
            </div>
        
        <!------Taught Courses ---->
                <!--Taught Courses -->
                
        @if($courses->count() > 0)
        <section id="work" class=" home-section paddingtop-60 paddingbot-60">	
            <div class="container-fluid" style="width:95%">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div style="padding: 0 44px;">
            <div class="row">
                <div class="col-md-8">
                <div class="section-header1">
                      <h4>Courses Taught by {{$logged_in_user->name}}</h4>
                      <div class="line"></div>
            	</div>
            	</div>
            	</div>
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div id="owl-works10" class="owl-carousel">
                                        <?php //dd($user->authored_courses)?>

                 @foreach($user->authored_courses as $course)
                 <div class="row">
    	        <div class="col-md-4 item" style="margin:0;">
                   <figure class="snip1447 green">
                    <img src="{{asset($course->image)}}" alt="sample69" />
                 <span class="label label-default course-category">$course->category</span>

                    <figcaption>
                    <h2><span>{{$course->title}}</span></h2>
                    <p>{{$course->subtitle}}</p>
                    <p class="author">{{$course->author->first_name}} {{$course->author->last_name}}</p>
                      </figcaption>
                      <hr>
                      <div class="row">
                    <div class="col-md-9 reviews-shop-content">
							<ul>
							    @if(!$course->getAverageRatingAttribute())
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								@else
								@if($course->getAverageRatingAttribute() > 4 )
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								@elseif($course->getAverageRatingAttribute() > 3)
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								@elseif($course->getAverageRatingAttribute() > 2)
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								@elseif($course->getAverageRatingAttribute() > 1)
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								<li><i class="fa fa-star-o"></i></li>
								@endif
								@endif
							</ul>
							<p>({{$course->getTotalReviewsAttribute()}} reviews)</p>
						</div>
                  <p class="col-md-2 col-md-offset-1 course-price">$course->price</p>
                       <a href="{{route('frontend.course.show',$course->slug)}}"></a>
                  </div>
                  </figure>
         </div>
         </div>
                        @endforeach
                
                        
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
        @endif
</section>




@endsection