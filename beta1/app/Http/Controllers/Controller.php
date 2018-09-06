<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Category;
use View;
use Auth;
use App\Helpers\Frontend\Auth\Socialite;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
      {
        //   echo "hamied";
        //its just a dummy data object.
        $categories = Category::All();    
        $socialite_links = new Socialite();
         $socialite_links= $socialite_links->getSocialLinks();
        // Sharing is caring
        View::share('categories', $categories);
        View::share('socialite_links', $socialite_links);
         
      }

    
    
}
