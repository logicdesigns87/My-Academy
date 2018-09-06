<?php

namespace App\Http\Controllers\Frontend;

use DB;
use Agent;
use Helper;
use App\Models\Blog;
use Carbon\Carbon;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Coupon;
use App\Models\Category;
use App\Models\Access\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Frontend\Auth\Socialite;


/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        // make sure to only return categories that actually have courses with content, and at least one content should be a video preview
        
        // $categories = Category::All();
        $featuredCategories = Category::has('courses')
            ->has('courses.sections')
            ->has('courses.sections.lessons')
            ->has('courses.sections.lessons.content')
            ->with(['courses' => function($q){
                $q->where('featured', true)
                    ->whereHas('sections', function($q){
                    $q->whereHas('lessons', function($q){
                        $q->where('preview', true)
                            ->whereHas('content', function($q){
                                $q->where('content_type', '=', 'video');
                            });
                    });
            });
        }])->orderByRaw("RAND()")->paginate(3);

        foreach($featuredCategories as $category){
            
            foreach($category->courses as $course){
                $course->image = Helper::coverImage($course);
            }
        }
        
        /*
        $featuredCourses = Course::where('featured', true)
            ->whereHas('sections', function($q){
                $q->whereHas('lessons', function($q){
                    $q->where('preview', true)
                        ->whereHas('content', function($q){
                            $q->where('content_type', '=', 'video');
                        });
                });
            })->get();
        
        foreach($featuredCourses as $course){
            $course->image = Helper::coverImage($course);
        }
        */
        
        
        $coupon = Coupon::where(['sitewide' => true, 'active'=> true ])->where('expires', '>=', Carbon::now())->first();
        
        
        if(!is_null($coupon)){
            $expires = Carbon::parse($coupon->expires);
            $coupon->days_left = $expires->diffInDays(Carbon::now());
        }
        
        $posts = Blog::latest()->where(['type' => 'article', 'featured_frontend' => true])->get()->take(2);
        $featured_page = Blog::where(['type' => 'page', 'featured_frontend' => true])->get()->first();
        $users= DB::table('users')->join('role_user',function($join){
            $join->on('users.id','=','role_user.user_id')->where('role_user.role_id','=',2);
        })->limit(2)->get();
        // ->join('reviews',function($join){
        //     $join->on('users.id','=','reviews.user_id')->where('reviews.rating','in','(SELECT rating FROM reviews WHERE rating <= (SELECT MAX(rating) FROM reviews))');
        // })
        
        // return view('frontend.index', compact('featuredCategories', 'posts', 'coupon', 'featured_page'));
        return view('frontend.index1', compact('featuredCategories', 'posts', 'coupon', 'featured_page', 'courses_details','users' ))->withSocialiteLinks((new Socialite())->getSocialLinks());
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }
    public function about(){
    return view('frontend.about');
}
}
