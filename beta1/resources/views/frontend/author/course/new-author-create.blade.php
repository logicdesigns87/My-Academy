@extends('frontend.layouts.app1')
@section('title')
    {{ trans('navs.frontend.instructor_dashboard') }} - {{trans('strings.frontend.create-course')}}
@stop
@section('content')
<!-- CREATE FORM -->
<div class="info-bar row">
    <div class="col-md-7">
       <div class="media">
          <div class="media-left">
              <img class="media-object" src="{{asset('img1/testimonials/'.$logged_in_user->avatar)}}" alt="profile-img">
          </div>
          <div class="media-body">
            <h3 class="media-heading">Instructor Dashboard</h3>
             <h4 class="media-heading">{{$logged_in_user->first_name}} {{$logged_in_user->last_name}}</h4>

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
<section id="create">
    <div class="container">
        <section>
            <div class="row">
                <div class="panel panel1">
                      <div class="panel-heading panel-heading1">
                            <a class="panel-title"><i class="glyphicon glyphicon-th-list"></i>CREATE Course</a>
                      </div>
                      <div class="panel-body panel-body1" >
                          <form method="POST" action="{{route('frontend.user.become.author.store')}}">
                              {{csrf_field()}}
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course title: </span>
                                  <input type="text" name="title" class="form-control" placeholder="Course title" aria-describedby="basic-addon1">
                              </div>  
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Slug: </span>
                                  <input name="slug" type="text" class="form-control" placeholder="Slug" aria-describedby="basic-addon1">
                              </div> 
                              <label for="basic-url">Permalink:</label>
                              <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon3">https://www.myacademy.com/courses/</span>
                                  <input type="text" class="form-control" placeholder=" " id="basic-url" aria-describedby="basic-addon3">
                              </div>
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course subtitle: </span>
                                  <input name="subtitle" type="text" class="form-control" placeholder="Course subtitle" aria-describedby="basic-addon1">
                              </div>  
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course category: </span>
                                  <select name = "category" class="form-control" aria-describedby="basic-addon1">
                                 @foreach( $categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name}} </option>
                                    @endforeach
                                  </select>
                              </div>  
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Course description: </span>
                                  <input name="description" type="text" class="form-control" aria-describedby="basic-addon1">
                              </div>  
                               <div class="input-group">
                                  <span class="input-group-addon" id="basic-addon1">Tags: </span>
                                  <input name = 'tags' type="text" class="multipleInput form-control" aria-describedby="basic-addon1" multiple value="Algeria,Angola" data-initial-value='[{"text": "Algeria", "value" : "Algeria"}, {"text": "Angola", "value" : "Angola"}]'
    data-user-option-allowed="true">
                              </div>  
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" class="btn btn-default">Create Course</button>
                                </div>
                              </div>
                            </form>
                      </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection