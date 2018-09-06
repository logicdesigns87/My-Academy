@extends('frontend.layouts.app1')
@section('content')
<div id="header1">
<div class="container">
	<div class="row">
	<div class="col-lg-4">
        <div class="sidebar">
            <div class="video-testimonial-block">
                        <div class="video-thumbnail"><img src="{{asset('uploads/images/course/'.$course->image)}}" alt="image" class="img-fluid"></div>
                        <div class="video">
                            <iframe src="https://www.youtube.com/embed/KEiAVv1UNac" allowfullscreen>
                            </iframe>
                        </div>
                        <a href="#" class="video-play"></a>
                    </div>
            
            <div class="after-video">
                
            <div class="price">
            <div class="col-lg-5 nopad">
            <h1>${{$course->price}}</h1> 
            <br>
            </div>
            <!--    <div class="col-lg-7">-->
            <!--<label class="orginal-price">$ 50.10</label>-->
            <!--<label> 30% OFF </label>-->
            <!--    </div>-->
            <!--<p><strong><i class="fa fa-clock-o"></i>1 day </strong> left at this price!</p>    -->
            <div style="clear:both"></div>    
            </div>
                <?php $user =  isset($logged_in_user)?$logged_in_user : ''; ?>
            <div class="btn-block">
              @if($user) 
                @if($logged_in_user->hasBookmarked($course))
            <form method="POST" action="{{route('frontend.user.delete-bookmark',$course->id)}}">{{csrf_field()}} {{ method_field('DELETE') }}<button type ="submit" class="btn btn-skin btn-block btn-lg">Remove From Wishlist </form> </button>
            @else
            <form method="POST" action="{{route('frontend.user.create-bookmark',$course->id)}}">{{csrf_field()}} 
<button type ="submit" class="btn btn-skin btn-block btn-lg">Add To Wishlist </form> </button>
            @endif
        
            <!--<button class="btn btn-notskin btn-block btn-lg mar-top-30"> BUY NOW </button> -->
            @if(Helper::getPrice($course) == 'FREE')
                                    <a href="{{route('frontend.course.enroll', $course)}}" class="btn btn-notskin btn-block btn-lg mar-top-30">
                                        {{trans('strings.frontend.enroll-now')}}
                                    </a>
                                @else
                                <!--
                                    <a href="#" class="take-this-course mc-btn btn-style-1">
                                        {{trans('strings.frontend.buy-now')}}
                                    </a>
                                -->
                                    <a href="#" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#buy-now" class="btn btn-notskin btn-block btn-lg mar-top-30">
                                        {{trans('strings.frontend.buy-now')}}
                                    </a>
                                @endif
                        @else
                            <a class="btn btn-skin btn-block btn-lg mar-top-30" data-toggle="modal" data-target="#myModal1">Add To Wish List</a>
                            <a class="btn btn-notskin btn-block btn-lg mar-top-30" data-toggle="modal" data-target="#myModal1">{{trans('strings.frontend.buy-now')}}</a>
                                @endif
                            
            </div>   
                
            <div class="include">
            <p><strong>Includes :</strong></p>
            <ul>
                <li><i class="fa fa-book" ></i> 29.5 hours on-demand video</li>
                <li><i class="fa fa-phone" ></i> 29.5 hours on-demand video</li>
                <li><i class="fa fa-home" ></i> 29.5 hours on-demand video</li>
                <li><i class="fa fa-clock-o" ></i> 29.5 hours on-demand video</li>
                <li><i class="fa fa-book" ></i> 29.5 hours on-demand video</li>
                <li><i class="fa fa-phone" ></i> 29.5 hours on-demand video</li>
            </ul> 
            <a href="#"> Have A Coupon ?</a>
                <div style="clear:both"></div>
            </div>
              
            <!--<div class="share text-center">-->
            <!--    <h5>share via</h5>-->
            <!--</div>    -->
     <!--           <div class="wow fadeInDown" data-wow-delay="0.1s">-->
					<!--<div class="widget">-->
					<!--	<ul class="company-social">-->
					<!--			<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>-->
					<!--			<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>-->
					<!--			<li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>-->
					<!--			<li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>-->
					<!--			<li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>-->
					<!--	</ul>-->
					<!--</div>-->
					<!--</div>-->
            <div style="clear:both"></div> 
            </div>
        </div>
    </div>
	<div class="col-lg-8">
      <h1>{{$course->title}}</h1>
      <h3>{{$course->subtitle}}</h3>
        
        <span> <strong>Course Level </strong> {{$course->level}} </span>
        <hr>
        <br>
        
        <div class="reviews-shop-content">
            <span> <strong>{{$course->getNumOfStudents()}} </strong> students enrolled </span>
            <span><strong>{{$course->getTotalReviewsAttribute()}} </strong> ratings</span>
			<ul>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star"></i></li>
                <li><i class="fa fa-star-o"></i></li>
			</ul>   <p>{{$course->getAverageRatingAttribute()}}</p> 
            
            
        </div> 
        <div class="detail">
            <div class="col-lg-4  nopad">
            <p>Created by <strong> {{$course->author->first_name}} {{$course->author->last_name}}</strong></p>
            </div>
            <div class="col-lg-8">
            <span class="pad-50"><i class="fa fa-comments"></i> English </span>
            <span><i class="fa fa-cc"></i> English [ Auto Generated ] </span>
            </div>
        </div>
    </div>
	</div>
</div>	
</div>  
    
<section id="page-wrap" class=" home-section paddingtop-60 paddingbot-60">	
<div class="container">
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
        
    <!--<div class="why-learn">-->
    <!--<div class="header10">-->
    <!--<h3>What Will I Learn?</h3>    -->
    <!--</div>-->
    <!-- <div class="col-sm-3 col-md-6">-->

    <!--        <div class="wow fadeInRight" data-wow-delay="0.1s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->

    <!--        <div class="wow fadeInRight" data-wow-delay="0.2s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                  
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--        <div class="wow fadeInRight" data-wow-delay="0.3s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                 
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->


    <!--      </div>   -->
    <!-- <div class="col-sm-3 col-md-6">-->

    <!--        <div class="wow fadeInRight" data-wow-delay="0.1s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->

    <!--        <div class="wow fadeInRight" data-wow-delay="0.2s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                  
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->
    <!--        <div class="wow fadeInRight" data-wow-delay="0.3s">-->
    <!--          <div class="service-box">-->
    <!--            <div class="service-icon">-->
    <!--              <span class="fa fa-check fa-2x icon-success"></span>-->
    <!--            </div>-->
    <!--            <div class="service-desc">-->
                 
    <!--              <p>Vestibulum tincidunt enim in pharetra malesuada.</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->


    <!--      </div> -->
    <!-- <div style="clear:both"></div>      -->
    <!--</div>-->
        
    <div class="courses-table">
    <div class="header10">
    <h3>Curriculum For This Course</h3>    
    </div>
    
    <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <div class="section-header-left">
                        <span class="lecture-title">
                            <i class="fa fa-plus-square"></i> Course Overview
                        </span>
            </div>
            <div class="section-header-right">
                        <span class="section-header-length"> 
                            2 Lectures
                        </span>
                        <span class="section-header-length">
                            08:03
                        </span>
            </div>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
         <div class="section-header-left">
                        <span class="lecture-title">
                            <i class="fa fa-plus-square"></i> Course Overview
                        </span>
            </div>
            <div class="section-header-right">
                        <span class="section-header-length"> 
                            2 Lectures
                        </span>
                        <span class="section-header-length">
                            08:03
                        </span>
            </div>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          <div class="section-header-left">
                        <span class="lecture-title">
                            <i class="fa fa-plus-square"></i> Course Overview
                        </span>
            </div>
            <div class="section-header-right">
                        <span class="section-header-length"> 
                            2 Lectures
                        </span>
                        <span class="section-header-length">
                            08:03
                        </span>
            </div>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
       <div class="panel-body">
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
          <div class="lecture">
        <div class="left-content">
          <i class="fa fa-play-circle-o"></i> Course Overview
        </div>
          <div class="details">
          <span class="section-header-length"> 
                           <a href="#">Preview</a>
                        </span>
                        <span class="section-header-length">
                            02:03
                        </span>
          </div>
              </div>
      </div>
    </div>
  </div>
</div>    
    </div>    
        
    <!--<div class="requirment">-->
    <!--<div class="header10">-->
    <!--<h3>Requirments</h3>    -->
    <!--</div>-->
    <!--<ul id="w" >-->
    <!--<li>No programming experience is required to take this course. I’ll walk you through the entire process from scratch!</li>-->
    <!--<li>No programming experience is required to take this course. I’ll walk you through the entire process from scratch!</li>    -->
    <!--<l1></l1>  -->
    <!--</ul>    -->
    <!--</div>    -->
        
    <div class="description">
    <div class="header10">
    <h3>Description</h3>    
    </div>
    <p>{!! $course->description !!}</p>
        <!--<a href="#" class="btn btn-notskin">x</a>-->
    </div>  
     <?php
     $data = $course->getFeaturedReview();
     $review = $data[0]; $reviewer = $data[1];
     ?>  
     @if($data  && $data[0] && $data[1])
            <div class="Review">
            <div class="header10">
            <h3>Featured Review </h3>    
            </div>
            <figure class="snip1473">
          <img src="{{asset('uploads/avatar/$reviewer->avatar')}}" alt="profile-sample6" class="profile" />
          <figcaption>
            <blockquote>{{$review->comment}} </blockquote>
          </figcaption>
          <h3>{{$reviewer->first_name}}  {{$reviewer->last_name}}<span>{{$reviewer->tagline}}</span></h3>
        </figure>
            <div style="clear:both"></div> 
            </div> 
    @endif
    </div>
</div>

</div>
</section>
<span id="hide-firstx" class="hiddenx">
        @include('frontend._modals.checkout')
    </span>
    @endsection
    @section('after-scripts')
    <script type="text/javascript">
        var player = videojs('previewPlayer');
        $('.lesson-title').on("click", function () {
            $('.preview').removeClass('disabled ');
            $(this).parent('li').addClass('disabled');
            var video_src = $(this).data('video');
            var video_type = $(this).data('type');
            player.src({ "type": "video/"+video_type, "src": video_src});
            player.play();
        });
        $('.close').on('click', function(){
            player.pause();
            player.src('');
        })
    </script>
	
	
	<script>
	    /*===================
	    STRIPE PAYMENT
	    ====================*/
        $(function() {
            Stripe.setPublishableKey("{{config('services.stripe.key')}}");
            
		    $("#checkout-btn").click(function() {
		        var form = $("#checkout-form");
		        var submit = form.find("button");
		        var submitInitialText = submit.text();
		        submit.attr("disabled", "disabled").html("<i class='fa fa-gear fa-spin'></i> Processing...");
		        Stripe.card.createToken(form, function(status, response) {
		            if(response.error) {
		      	        $('.stripe-errors').removeClass('hidden');
		      	        $('.stripe-errors span').text(response.error.message);
		                form.find(".stripe-errors").text(response.error.message).show();
		                submit.removeAttr("disabled");
		                submit.text(submitInitialText);
		            } else {
		                form.append($("<input type='hidden' name='token'>").val(response.id));
		                form.submit();
		            }
		        });
		    });
		  
		});
		
		// paypal button click event
		$('#paypal-button').click(function() {
		    $(this).attr('disabled', 'disabled');
		    $(this).html("<i class='fa fa-gear fa-spin'></i> {{trans('strings.frontend.processing')}}");
		    $(this).parents('form').submit()
		})
		
		
		
		// Omise Payment
		$("#omise-payment").submit(function () {    
            
            var form = $(this);
            // Disable the submit button to avoid repeated click.
		    $('#create_token').attr('disabled', 'disabled');
		    $('#create_token').html("<i class='fa fa-gear fa-spin'></i> {{trans('strings.frontend.processing')}}");
    		
            // Serialize the form fields into a valid card object.
            var card = {
                "name": form.find("[data-omise=holder_name]").val(),
                "number": form.find("[data-omise=number]").val(),
                "expiration_month": form.find("[data-omise=expiration_month]").val(),
                "expiration_year": form.find("[data-omise=expiration_year]").val(),
                "security_code": form.find("[data-omise=security_code]").val()
            };
            // Send a request to create a token then trigger the callback function once
            // a response is received from Omise.
            //
            // Note that the response could be an error and this needs to be handled within
            // the callback.
            Omise.createToken("card", card, function (statusCode, response) {
                if (response.object == "error") {
                    // Display an error message.
                    $('#token_errors').removeClass('hidden');
	      	        $('#token_errors span').text(response.message);
	                form.find("#token_errors").text(response.message).show();
	                
                    $('#create_token').prop("disabled", false);
		            $('#create_token').html("{{trans('strings.frontend.pay')}}");
                    
                } else {
                    // Then fill the omise_token.
                    form.find("[name=omise_token]").val(response.id);
                    
                    setTimeout(function(){
                        form.get(0).submit();
                    }, 3000);
                    // And submit the form.
                };
            });
            // Prevent the form from being submitted;
            return false;
        });
		
	</script>
	<style type="text/css">
	    .checkbox.pull-right { margin: 0; }
        .pl-ziro { padding-left: 0px; }
	    .form-body{
	        min-height: 450px !important;
	    }

        .form-checkout .form-2 .form-email {
            clear: both;
            overflow: hidden;
            margin-top: 0px;
        }
        .form-checkout .fs-title {
            margin-top: 0;
            font-weight: bold;
        }
	</style>
@endsection
