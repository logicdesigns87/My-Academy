@extends('frontend.layouts.app1')
@section('content')
<?php
//dd($course);
//dd($categories);
?>
<div id="header">
<div class="container">
	<div class="row">
	    
	    <h1>{{$category[0]->name}}</h1>
	    

	<div class="line"></div>
	</div>
</div>	
</div>

<section id="work" class=" home-section paddingtop-60 paddingbot-60">	
<div class="container-fluid" style="width:95%">
<div class="row">
    <div class="section-header1">
                      <h4>Top courses in {{$category[0]->name}} :</h4>
                      <div class="line"></div>
				  </div>
<div class="wow fadeInUp" data-wow-delay="0.2s">
                    <div id="owl-works10" class="owl-carousel">    
     @foreach($courses as $course)
	     <div class="item">
                   <figure class="snip1447 green">
                    <img src="{{asset('uploads/images/course/'.$course->image)}}" alt="sample69" />
                    <figcaption><i class="profile fa fa-medkit"></i>
                    <p>{{$course->subtitle}}</p>
                    <h2><span>{{$course->title}}</span></h2>
                        <div class="reviews-shop-content">
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
                    </figcaption>
                       <a href="{{route('frontend.course.show',$course->slug)}}"></a>
                  </figure>
         </div>
     @endforeach
    </div>
    </div>
</div>
</div>

	</div>
    
<div id="content">
    <span class="update">Last updated: 07/2018</span>
     <div class="title">
<h6>details</h6>
        </div>
    <div class="content">
    <p>end</p>
    </div>
</div>
    
</section>
    
    
<!--<section id="work" class="paddingtop-60 paddingbot-60">	-->
<!--<div class="container-fluid" style="width:95%">-->
<!--<div class="row">  -->
<!--       <div class="section-header1">-->
<!--                      <h4>Next items-->
<!--New and noteworthy in "Development" :</h4>-->
<!--                      <div class="line"></div>-->
<!--				  </div>-->
<!--	<div  class="wow fadeInUp" data-wow-delay="0.2s">-->
<!--                    <div id="owl-works11" class="owl-carousel">    -->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--    </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->

<!--<section id="work" class="home-section paddingtop-60 paddingbot-60">	-->
<!--<div class="container-fluid" style="width:95%">-->
<!--<div class="row">  -->
<!--    <div class="section-header1">-->
<!--                      <h4>Trending in "Development" :</h4>-->
<!--                      <div class="line"></div>-->
<!--				  </div>-->
<!--	<div  class="wow fadeInUp" data-wow-delay="0.2s">-->
<!--                    <div id="owl-works12" class="owl-carousel">    -->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--    </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->
    
<!--<section id="work" class="paddingtop-60 paddingbot-60">	-->
<!--<div class="container-fluid" style="width:95%">-->
<!--<div class="row"> -->
<!--      <div class="section-header1">-->
<!--                      <h4>Most Popular Instructors :</h4>-->
<!--                      <div class="line"></div>-->
<!--				  </div>-->
<!--<div  class="wow fadeInUp" data-wow-delay="0.2s">-->
<!--                    <div id="owl-works13" class="owl-carousel">    -->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--	<div class="item">-->
<!--                   <figure class="snip1447 green">-->
<!--                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />-->
<!--                    <figcaption><i class="profile fa fa-medkit"></i>-->
<!--                    <p>I think the image we need to create for you is repentant but learning</p>-->
<!--                    <h2><span>Accountant</span></h2>-->
<!--                        <div class="reviews-shop-content">-->
<!--							<ul>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star"></i></li>-->
<!--								<li><i class="fa fa-star-o"></i></li>-->
<!--							</ul>-->
<!--							<p>(18 reviews)</p>-->
<!--						</div>-->
<!--                    </figcaption>-->
<!--                       <a href="#"></a>-->
<!--                  </figure>-->
<!--     </div>-->
<!--    </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->

@endsection