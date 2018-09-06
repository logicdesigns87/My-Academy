@extends('frontend.layouts.app1')

@section('content')

<!-- ====================End NAV =========== -->
<!-- HEADER BAR -->
<div class="title-bar row">
    <div class="content col-md-12">
        <h3 class="media-heading">My WishList</h3>
        <hr class="bottom-line">
    </div>
</div>


<!-- ==================== CONTENT =========== -->
<div class="nav-mycourses">
    <div class="container-fluid">
        <ul>
            <li><a href="#"><i class="glyphicon glyphicon-book"></i> My Courses</a></li>
            <li><a href="#" class="check"><i class="glyphicon glyphicon-heart-empty"></i> My WishList</a></li>
        </ul>
    </div>
</div>
<section id="work" class="home-section paddingtop-30 paddingbot-60 animated fadeInRight">	
            <div class="container-fluid">
            <div class="row">
                <div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div style="padding: 0 44px;">
                   @foreach($courses as $course)
                        <div class="col-md-4 item" style="margin:0;">
                           <figure class="snip1447 green">
                            <img src="{{asset($course->image)}}" alt="sample69" width="300" height="200" />
                            <span class="label label-default course-category">{{ $course->category->name }}</span>
                            <figcaption>
                                    <h2><span>{{$course->title}}</span></h2>
                                <p>{{$course->subtitle}}</p>
                                <p class="author">{{ $course->author->name }}</p>
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
        						<p class="col-md-2 col-md-offset-1 course-price">${{$course->price}}</p>
        				    <a href="{{route('frontend.course.show',$course->slug)}}"></a>
                               </div>
                          </figure>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </section>

@endsection




<!--
====================footer =========== -->
