
<!------------- Footer ------------->

	<footer class="text-white">
	
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="widget">
						<h5>About Medicio</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Laboratory</a></li>
							<li><a href="#">Medical treatment</a></li>
							<li><a href="#">Terms & conditions</a></li>
                            <li><a href="#">Medical treatment</a></li>
						</ul>
					</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="widget">
						<h5>Medicio center</h5>
						<p>
						Nam leo lorem, tincidunt id risus ut, ornare tincidunt naqunc sit amet.
						</p>
						<ul>
							<li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-calendar-o fa-stack-1x fa-inverse"></i>
								</span> Monday - Saturday
							</li>
							<li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-phone fa-stack-1x fa-inverse"></i>
								</span> +62 0888 904 711
							</li>
							<li>
								<span class="fa-stack fa-lg">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
								</span> hello@medicio.com
							</li>

						</ul>
					</div>
					</div>
				</div>
                
                <div class="col-sm-6 col-md-3">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="widget">
						<h5>About Medicio</h5>
						<ul>
							<li><a href="#">Home</a></li>
							<li><a href="#">Laboratory</a></li>
							<li><a href="#">Medical treatment</a></li>
							<li><a href="#">Terms & conditions</a></li>
                            <li><a href="#">Medical treatment</a></li>
						</ul>
					</div>
					</div>
				</div>
                
				<div class="col-sm-6 col-md-3">
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="widget">
						<h5>Our location</h5>
						<p>The Suithouse V303, Kuningan City, Jakarta Indonesia 12940</p>		
						
					</div>
					</div>
					<div class="wow fadeInDown" data-wow-delay="0.1s">
					<div class="widget">
						<h5>Follow us</h5>
						<ul class="company-social">
								<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
								<li class="social-dribble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
						</ul>
					</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-8 col-lg-8">
					<div class="wow fadeInLeft" data-wow-delay="0.1s">
					<div class="text-left">
					<p>&copy;Copyright 2018 - <strong>MY Academy</strong>. All rights reserved. Designed % Devolped by <strong>Logic-designs</strong></p>
					</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 col-lg-4">
					<div class="wow fadeInRight" data-wow-delay="0.1s">
					<div class="pull-right">
						<img style="
    position:  relative;
    margin-top: -17px;
" src="{{asset('img1/logo2.png')}}" width="220px">
					</div>
					</div>
				</div>
			</div>	
		</div>
		</div>
	</footer>

</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user"></i> SIGN UP</h4>
      </div>
      <div class="modal-body">
        <!--<form action="" method="post" role="form" class="contactForm lead">-->
        {{ Form::open(['route' => 'frontend.auth.register.post', 'class' => 'contactForm lead']) }}
                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>First Name</label>
                              <input type="text" name="first_name" id="first_name" class="form-control input-md"  placeholder="First Name" required>
                              <div class="validation"></div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" name="last_name" id="last_name" class="form-control input-md"  placeholder="Last name" required>
                              <div class="validation"></div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" id="email" class="form-control input-md"  placeholder="Your email" required>
                              <div class="validation"></div>
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>Username</label>
                              <input type="text" name="username" id="phone" class="form-control input-md" placeholder="Username" required>
                              <div class="validation"></div>
                            </div>
                          </div>
                        </div>
			 <div class="row">
                          <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>your password</label>
                              <input type="password" name="password" id="first_name" class="form-control input-md"   placeholder="password" required>
                              <div class="validation"></div>
                            </div>
                          </div>
				 <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                              <label>confirm password</label>
                              <input type="password" name="password_confirmation" id="first_name" class="form-control input-md"  placeholder="password confirmation" required>
                              <div class="validation"></div>
                            </div>
                          </div>
			</div>
        	<div class="modal-footer">
                <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
            </div>

		  <!--</form>-->
		    	   {{ Form::close() }}

      </div>
    </div>
  </div>
</div>
	
	
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> SIGN IN</h4>
      </div>
      <div class="modal-body">
        <!--<form action="" method="post" role="form" class="contactForm lead">-->
        {{ Form::open(['url' => 'login', 'class' => 'contactForm lead']) }}
        
			 <div class="row">
				  <div class="col-xs-12 col-sm-12 col-md-12">
					  <div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-user"></i></span>
  <input type="email" name="username" value="{{ old('email') }}" id="email" class="form-control input-md" data-rule="email" data-msg="Please enter a valid email" placeholder="Your email" aria-describedby="sizing-addon1" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

</div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
							  <div class="input-group input-group-lg">
  <span class="input-group-addon" id="sizing-addon1"><i class="fa fa-lock"></i></span>
  <input type="password" name="password" id="first_name" class="form-control input-md"  placeholder="Valid password" aria-describedby="sizing-addon1" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

</div>
                          </div>
				 <div class="col-xs-12 col-sm-12 col-md-12">
				 	<div class="checkbox">
								<label class="control-label" for="remember_me">
									<input type="checkbox" name="remember" id="remember_me" value="1" class=""  /> Remember Me
								</label>
						</div>
				 </div>
			</div>
		  <!--</form>-->
	  <div class="modal-footer">
        <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
      </div>
                        <ul class="list-unstyled social-login">
                                {!! $socialite_links !!}
                                
                                <li style="display:inline-block"><a href="{{ route('frontend.auth.social.login',['provider' => 'facebook']) }}"><i class="fa fa-facebook"></i></a></li>
                                <!--<li style="display:inline-block"><a href="{{ route('frontend.auth.social.login',['provider' => 'twitter']) }}"><i class="fa fa-twitter"></i></a></li>-->
                                <!--<li style="display:inline-block"><a href="{{ route('frontend.auth.social.login',['provider' => 'linkedin']) }}"><i class="fa fa-linkedin"></i></a></li>-->
                                <li style="display:inline-block"><a href="{{ route('frontend.auth.social.login',['provider' => 'google']) }}"><i class="fa fa-google"></i></a></li>
                                <!--<li style="display:inline-block"><a href="{{ route('frontend.auth.social.login',['provider' => 'github']) }}"><i class="fa fa-github"></i></a></li>-->
                                
                            </ul>
  	   {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
	
    
    
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-in"></i> Contact US</h4>
      </div>
      <div class="modal-body">
        <form class="contact-form js-form row">
          <div class="form-group col-md-4">
            <input autocomplete="off" type="text" name="name" class="form-control required" placeholder="Full Name">
          </div>
          <div class="form-group col-md-4">
            <input autocomplete="off" type="email" name="email" class="form-control required" placeholder="Email address">
          </div>
          <div class="form-group col-md-4">
            <input autocomplete="off" type="text" name="phone" class="form-control" placeholder="Phone number">
          </div>
          <div class="form-group col-md-12">
            <textarea name="message" class="form-control required" placeholder="Your message"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Submit" class="btn btn-skin btn-block btn-lg">
      </div>
    </div>
  </div>
</div>    
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
