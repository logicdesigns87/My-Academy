@extends('frontend.layouts.app1')
@section('content')
<!-- ==================== CONTENT =========== -->

<!-- HEADER -->
<div class="info-bar row"> 
        
            <div class="col-md-7">
               <div class="media">
                  <div class="media-left">
                      <img class="media-object" src="{{asset($logged_in_user->avatar)}}" alt="profile-img" style="max-width:100px; max-height:100px;">
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
</header>

<!-- Profile CONTENT -->
<section id="profile">
    <div class="container">
    <!-- Edit Profile -->
        <section>
            <div class="row">
                <div class="panel panel1">
                      <div class="panel-heading">
                            <a class="toggle panel-title"><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>Edit Profile</a>
                      </div>
                      <div class="edit panel-body1" >
                          <form method="POST" action="{{route('frontend.user.profile.update')}}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                              {{ method_field('PUT') }}
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Username</span>
                              <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" name="username" value="{{$user->username}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text" class="form-control" placeholder="First Name" aria-describedby="basic-addon1" name="first_name" value="{{$user->first_name}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Last Name</span>
                              <input type="text" class="form-control" placeholder="Last Name" aria-describedby="basic-addon1" name="last_name" value="{{$user->last_name}}">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Job Title</span>
                              <input type="text" class="form-control" placeholder="Job Title" aria-describedby="basic-addon1" name="tagline" value="{{$user->tagline}}">
                            </div> 
                            <div class="panel panel-default">
                              <div class="about panel-heading">
                                <h3 class="panel-title">About ME</h3>
                              </div>
                              <textarea name="bio" class="about-text panel-body1" placeholder="Some Text About Me">{{$user->bio}}</textarea>
                            </div>
                            <label for="basic-url">facebook</label>
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon3">https://www.facebook.com/</span>
                              <input name="facebook" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Facebook" value="{{$user->facebook}}">
                            </div>
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon3">Image</span>
                              <!--<input name="facebook" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" placeholder="Facebook" value="">-->
                               <input type="file" name="image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-default">Save Changes</button>
                         </form>
                          
                      </div>
                </div>
            </div>
        </section>
        
        <!-- Change Password -->
        <section>
            <div class="row">
                <div class="panel panel1">
                      <div class="panel-heading">
                            <a class="toggle1 panel-title"><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i>Change Password</a>
                      </div>
                      <div class="edit1 panel-body1" >
                           <form method="POST" action="{{route('frontend.user.profile.change')}}" enctype="multipart/form-data">
                               {{ csrf_field() }}
                              {{ method_field('PUT') }}
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">CURRENT Password :</span>
                              <input name="old_password" type="password" class="form-control" placeholder="current password" aria-describedby="basic-addon1">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">NEW Password :</span>
                              <input name="password" type="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon1">
                            </div>  
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">CONFIRM The Password :</span>
                              <input type="password" class="form-control" placeholder="Confirm the Password" aria-describedby="basic-addon1">
                            </div>
                            <button type="submit" class="btn btn-default">Save Changes</button>
                         </form>
                          
                      </div>
                </div>
            </div>
        </section>
    </div>

   
</section>





<!------

@endsection