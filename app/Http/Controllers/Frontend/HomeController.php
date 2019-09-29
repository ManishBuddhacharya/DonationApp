<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Mail\sendTicket;

use App\User;
use App\Cause;
use App\Story;
use App\Blog;
use App\News;
use App\Event;
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
        $stories = Story::join('files',function($join){
                            $join->on('files.table',DB::raw('"Story"'));
                            $join->on('files.table_id','story.id');
                        })
                        ->join('categories','categories.id','story.category_id')
                        ->select('files.*','categories.*','story.*' )
                        ->get();
        return view($this->layout.'stories.stories', compact('stories'));
    }

    public function storyDetail($id)
    {
        $story = Story::join('files',function($join){
                            $join->on('files.table',DB::raw('"Story"'));
                            $join->on('files.table_id','story.id');
                        })
                        ->join('categories','categories.id','story.category_id')
                        ->select('files.*','categories.*','story.*' )
                        ->where('story.id', $id)
                        ->first();
        return view($this->layout.'stories.detail', compact('story'));
    }

    public function blog()
    {
        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->get();
        return view($this->layout.'blogs.blogs', compact('blogs'));
    }

    public function blogDetail($id)
    {
        $blog = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->where('blogs.id', $id)
                        ->first();
        return view($this->layout.'blogs.detail', compact('blog'));
    }

    public function news()
    {
        $news = News::join('files',function($join){
                            $join->on('files.table',DB::raw('"News"'));
                            $join->on('files.table_id','news.id');
                        })
                        ->join('categories','categories.id','news.category_id')
                        ->select('files.*','categories.*','news.*' )
                        ->get();
        return view($this->layout.'news.news', compact('news'));
    }

    public function newsDetail($id)
    {
        $news = News::join('files',function($join){
                            $join->on('files.table',DB::raw('"News"'));
                            $join->on('files.table_id','news.id');
                        })
                        ->join('categories','categories.id','news.category_id')
                        ->select('files.*','categories.*','news.*' )
                        ->where('news.id', $id)
                        ->first();
        return view($this->layout.'news.detail', compact('news'));
    }

    public function event()
    {
        $events = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->get();
        return view($this->layout.'events.events', compact('events'));
    }

    public function eventDetail($id)
    {
        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->where('events.id', $id)
                        ->first();
        return view($this->layout.'events.detail', compact("event"));
    }

    public function sendEventMail(Event $event, User $user)
    {
        \Mail::to($user->email)->send(
            new sendTicket($event, $user)
        );

        return "Mail has been sent";
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
