 
 <!------------- Header (Navbar) ------------->
 <?php
// dd($logged_in_user->id);
//  dd(auth()->user()->id);
//dd(auth()->user());
    //$id = user()->id;
   
 ?>

<nav class="navbar navbar-custom navbar-fixed-top">
   

  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::to('/')}}"><img src="{{asset('img1/logo2.png')}}" width="180px" ></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="categ fa fa-th"></i> <strong class="strongli">Categories</strong> </a>
          <ul class="dropdown-menu">
              
                @foreach($categories as $category)
                    
                      <li>
                        <a href="{{route('frontend.category.get',$category->slug)}}">{{ $category->name }}</a>
                      </li>
                    
                @endforeach
              
            <!--<li><a href="#">Action</a></li>-->
            <!--<li><a href="#">Another action</a></li>-->
            <!--<li><a href="#">Something else here</a></li>-->
            <!--<li role="separator" class="divider"></li>-->
            <!--<li><a href="#">Separated link</a></li>-->
            <!--<li role="separator" class="divider"></li>-->
            <!--<li><a href="#">One more separated link</a></li>-->
          </ul>
        </li>
      </ul>
    
      <form class="navbar-form navbar-left" action="{{ route('frontend.courses.get') }}" method="get">
        <div class="form-group">
          <input type="text" name="search" class="form-control" placeholder="Search">
            <i class="fa fa-search"></i>
        </div>
        
      </form>
        
        <ul class="nav navbar-nav navbar-right buttons">
        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
        @if(!(auth()->user()))
        <li><a href="#" class="btn btn-notskin btn-lg" data-toggle="modal" data-target="#myModal1"> Log In </a></li>
        <li><a href="#" class="btn btn-skin btn-lg" data-toggle="modal" data-target="#myModal"> Sign Up </a></li>
        @endif
        @if(auth()->user())
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$logged_in_user->last_name}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
              
            @if(auth()->user()->hasRole('Administrator'))
              <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            @endif
              <li><a href="{{route('frontend.user.become.author')}}">Create Course</a></li>
            
            <li><a href="{{route('frontend.user.profile.show',['user' => $logged_in_user] )}}" >Profile</a></li>
            <li><a href="{{route('frontend.user.courses.wishlist')}}" >My Wishlist</a></li>
            <li><a href="{{route('frontend.auth.logout')}}">Logout</a></li>
            
            <!--<li><a href="#">Something else here</a></li>-->
            <!--<li role="separator" class="divider"></li>-->
            <!--<li><a href="#">Separated link</a></li>-->
          </ul>
        </li>
        @endif
        </ul>
        
      <ul class="nav navbar-nav navbar-right">
        <li class=""><a href="{{URL::to('/')}}">HOME</a></li>
        <li ><a href="{{route('frontend.about')}}">ABOUT</a></li>
       
        <!--<li class="dropdown">-->
        <!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CATEGORIES <span class="caret"></span></a>-->
        <!--  <ul class="dropdown-menu">-->
        <!--    <li><a href="#">Action</a></li>-->
        <!--    <li><a href="#">Another action</a></li>-->
        <!--    <li><a href="#">Something else here</a></li>-->
        <!--    <li role="separator" class="divider"></li>-->
        <!--    <li><a href="#">Separated link</a></li>-->
        <!--  </ul>-->
        <!--</li>-->
           <li ><a href="#" data-toggle="modal" data-target="#myModal2">CONTACT</a></li>
      </ul>
           
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>
     <div id="page-wrap">
        <div class="alert-messages">
          @include('includes.partials.messages')
        </div>
    </div> 

