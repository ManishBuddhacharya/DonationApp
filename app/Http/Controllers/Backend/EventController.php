<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Event;
use App\Files;

class EventController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.event.';
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
        return view($this->layout.'event', compact('events'));
    }

    public function addEvent()
    {
        return view($this->layout.'addEvent');
    }


    public function insertEvent(Request $request)
    {
        $event = new Event;

        $event->title = $request->title;
        $event->content = $request->content;
        $event->address = $request->address;
        $event->dateTime = $request->dateTime;
        $event->category_id = $request->category_id;
        $event->userc_id = auth()->user()->id;

        $event->save();


    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "Event";
    	$file->type = "image";
    	$file->table_id = $event->id;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $event;

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
        return view($this->layout.'eventDetail', compact('event'));
    }

    public function editEvent($id)
    {
    	$event = Event::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Event"'));
	                        $join->on('files.table_id','events.id');
	                    })
	                    ->join('categories','categories.id','events.category_id')
	                    ->select('files.*','categories.*','events.*' )
	                    ->where('events.id', $id)
	                    ->first();
        return view($this->layout.'editEvent', compact('event'));
    }

    public function deleteEvent($id)
    {
    	$event = Event::find($id)->delete();
    	if ($event) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting Event";
    	}
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::find($id);

        $event->title = $request->title?:$event->title;
        $event->content = $request->content?:$event->content;
        $event->address = $request->address?:$event->address;
        $event->dateTime = $request->dateTime?:$event->dateTime;
        $event->category_id = $request->category_id?:$event->category_id;

        $event->update();


		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
	    	$file = Files::where('table','Event')->where('table_id',$event->id)->first();
	    	$file->file_name = $name;
	    	$file->update();
		}

    	return $event;
    }

    public function fileUpload(Request $request) {
	    if ($request->hasFile('file')) {
	        $image = $request->file('file');
	        $name = time().'.'.$image->getClientOriginalExtension();
	        $destinationPath = public_path('/images');
	        $image->move($destinationPath, $name);
	        // $this->save();

	        return $name;
	    }
	}

	/*Categories*/
	public function fetchCategories(Request $req)
    {
        $data = DB::table('categories')
                ->where('name', 'like', $req->term.'%')
                ->get();

        if (!is_null($req->terms)){
            $data[] = ['id' => $req->terms, 'text' => $req->terms ];
        }

        return response()->json($data);
    }
}
