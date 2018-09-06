<?php

namespace App\Http\Controllers\Frontend\User;

use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Models\Access\User\User;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepository;
use App\Helpers\Helper;
/**
 * Class ProfileController.
 */
class ProfileController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;
    protected $imageManager;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user, ImageManager $imageManager)
    {
        parent ::__construct();
        $this->user = $user;
        $this->imageManager = $imageManager;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function update(Request $request)
    {
        // dd("hamied");
        $output = $this->user->updateProfile(access()->id(), $request->only('username', 'first_name', 'last_name', 'bio', 'tagline', 'facebook', 'youtube', 'twitter', 'linkedin', 'web', 'github',  'email'));
       if(!empty($request['image'])){
        $this->updateAvatar($request,access()->id());
        }
        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            access()->logout();

            return redirect()->route('frontend.index')->withFlashInfo(trans('strings.frontend.user.email_changed_notice'));
        }
            // return view('frontend.profile.editProfile', compact('user'));
        return back()->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
    public function change(Request $request)
    {
        // dd("hamied");
        $output = $this->user->changePassword($request->only('old_password','password'));

        // E-mail address was updated, user has to reconfirm
            // return view('frontend.profile.editProfile', compact('user'));
        return back()->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
    public function edit($id) {
        $data = $this->user->query()->where('id', $id)->first();
         $courses = $data->authored_courses();
        $students = $data->students();
        $rating = $data->average_rating();
        $reviews = $data->reviews();
        
        return view('frontend.profile.editProfile',['user' => $data,'rating' => $rating,'courses' =>$courses,'students'=>$students,'reviews'=>$reviews]);
    }
    
    public function updateAvatar(Request $request, $user)
    {
        
        $user = User::where('id', $user)->first();
        
        $oldImage = $user->avatar; // delete the old image from the file system after new one is uploaded
        
        $processedImage = $this->imageManager->make($request->file('image')->getRealPath())
            ->fit(70, 70, function ($c) {
                $c->aspectRatio();
            })
            ->save(public_path('img1/testimonials/' . $filename = $request['image']->getClientOriginalName()));
        
        $user->avatar = $filename;
        $user->save();
        
        if(!is_null($oldImage)){
            if(Storage::disk('server')->exists('avatars/'.$oldImage)){
                Storage::disk('server')->delete('avatars/'.$oldImage);
            }
        }
        $path = '/uploads/avatars/'.$user->avatar; 
        
        return response()->json($path, 200);
    }
    public function show(Request $request, User $user)
    {
         $courses = $user->authored_courses;
        // $students = $user->students();
        // $rating = $user->average_rating();
        // $reviews = $user->reviews();
        foreach($courses as $course){
            $course->image = Helper::coverImage($course);
        }
        // dd($user);
        return view('frontend.profile.profile',
        [
            'user'=>$user,
            'students'=>$user->students(),
            'rating'=>$user->average_rating(),
            'reviews'=>$user->reviews(),
            'courses'=>$courses
            ]
      );
    }
}
