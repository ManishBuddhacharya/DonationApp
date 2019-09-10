<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\Cause;
use App\Files;

class HomeController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.frontend.pages.';
    }

    public function login()
    {
        return view($this->layout.'login.login');
    }
    
    public function signup()
    {
        return view($this->layout.'signup.signup');
    }

    public function story()
    {
        return view($this->layout.'stories.stories');
    }

    public function storyDetail()
    {
        return view($this->layout.'stories.detail');
    }

    public function news()
    {
        return view($this->layout.'news.news');
    }

    public function newsDetail()
    {
        return view($this->layout.'news.news');
    }

    public function event()
    {
        return view($this->layout.'events.events');
    }

    public function eventDetail()
    {
        return view($this->layout.'events.detail');
    }

    public function cause()
    {
        $causes = Cause::join('files',function($join){
                            $join->on('files.table',DB::raw('"Cause"'));
                            $join->on('files.table_id','causes.id');
                        })
                        ->join('categories','categories.id','causes.category_id')
                        ->select('files.*','categories.*','causes.*' )
                        ->get();
        return view($this->layout.'causes.causes', compact('causes'));
    }

    public function causeDetail($id)
    {
        $cause = Cause::join('files',function($join){
                            $join->on('files.table',DB::raw('"Cause"'));
                            $join->on('files.table_id','causes.id');
                        })
                        ->join('categories','categories.id','causes.category_id')
                        ->select('files.*','categories.*','causes.*' )
                        ->where('causes.id', $id)
                        ->first();
        return view($this->layout.'causes.detail', compact('cause'));
    }

    public function organization()
    {
        return view($this->layout.'organization.organization');
    }

    public function organizationDetail()
    {
        return view($this->layout.'organization.organization');
    }

    public function contact()
    {
        return view($this->layout.'contact.contact');
    }

    public function about()
    {
        return view($this->layout.'about.about');
    }

    public function profile()
    {
        return view($this->layout.'profile.profile');
    }

    public function gallery()
    {
        return view($this->layout.'gallery.gallery');
    }
    
}
