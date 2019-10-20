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
    
    public function index()
    {
        $cause = Cause::join('files',function($join){
                            $join->on('files.table',DB::raw('"Cause"'));
                            $join->on('files.table_id','causes.id');
                        })
                        ->join('categories','categories.id','causes.category_id')
                        ->select('files.*','categories.*','causes.*' )
                        ->first();
        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        $news = News::join('files',function($join){
                            $join->on('files.table',DB::raw('"News"'));
                            $join->on('files.table_id','news.id');
                        })
                        ->join('categories','categories.id','news.category_id')
                        ->select('files.*','categories.*','news.*' )
                        ->take(3)
                        ->get();


        $stories = Story::join('files',function($join){
                            $join->on('files.table',DB::raw('"Story"'));
                            $join->on('files.table_id','story.id');
                        })
                        ->join('categories','categories.id','story.category_id')
                        ->select('files.*','categories.*','story.*' )
                        ->take(5)
                        ->get();

        return view('index', compact('event', 'cause', 'news', 'blogs','stories'));
    }

    public function login()
    {
        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'login.login', compact('blogs'));
    }
    

    public function signup()
    {
        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'signup.signup', compact('blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'stories.stories', compact('stories', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'stories.detail', compact('story', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'blogs.blogs', compact('blogs', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'blogs.detail', compact('blog', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'news.news', compact('news', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'news.detail', compact('news', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'events.events', compact('events', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'events.detail', compact("event", 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'causes.causes', compact('causes', 'event', 'blogs'));
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

        $event = Event::join('files',function($join){
                            $join->on('files.table',DB::raw('"Event"'));
                            $join->on('files.table_id','events.id');
                        })
                        ->join('categories','categories.id','events.category_id')
                        ->select('files.*','categories.*','events.*' )
                        ->first();

        $blogs = Blog::join('files',function($join){
                            $join->on('files.table',DB::raw('"Blog"'));
                            $join->on('files.table_id','blogs.id');
                        })
                        ->join('categories','categories.id','blogs.category_id')
                        ->select('files.*','categories.*','blogs.*' )
                        ->take(2)
                        ->get();

        return view($this->layout.'causes.detail', compact('cause', 'event', 'blogs'));
    }

    public function organization()
    {
        $members = DB::table('user_positions')
        ->join('users','users.id', '=', 'user_positions.user_id')
        ->join('positions','positions.id', '=', 'user_positions.position_id')
        ->select( 'user_positions.*', 'positions.*', 'users.*')
        ->orderBy('positions.rank')
        ->get();
        return view($this->layout.'organization.organization', compact('members'));
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
        $images = Files::where('table','Gallery')->get();
        return view($this->layout.'gallery.gallery', compact('images'));
    }
    
}
