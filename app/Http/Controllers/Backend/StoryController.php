<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Story;
use App\Files;

class StoryController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.story.';
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
        return view($this->layout.'story', compact('stories'));
    }

    public function addStory()
    {
        return view($this->layout.'addStory');
    }


    public function insertStory(Request $request)
    {
        $story = new Story;

        $story->title = $request->title;
        $story->content = $request->content;
        $story->category_id = $request->category_id;
        $story->userc_id = auth()->user()->id;

        $story->save();


    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "Story";
    	$file->type = "image";
    	$file->table_id = $story->id;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $story;

        // return view($this->layout.'addStory');
    }

    public function StoryDetail($id)
    {
    	$story = Story::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Story"'));
	                        $join->on('files.table_id','story.id');
	                    })
	                    ->join('categories','categories.id','story.category_id')
	                    ->select('files.*','categories.*','story.*' )
	                    ->where('story.id', $id)
	                    ->first();
        return view($this->layout.'StoryDetail', compact('story'));
    }

    public function editStory($id)
    {
    	$story = Story::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Story"'));
	                        $join->on('files.table_id','story.id');
	                    })
	                    ->join('categories','categories.id','story.category_id')
	                    ->select('files.*','categories.*','story.*' )
	                    ->where('story.id', $id)
	                    ->first();
        return view($this->layout.'editStory', compact('story'));
    }

    public function deleteStory($id)
    {
    	$story = Story::find($id)->delete();
    	if ($story) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting Story";
    	}
    }

    public function updateStory(Request $request, $id)
    {
        $story = Story::find($id);

        $story->title = $request->title?:$story->title;
        $story->content = $request->content?:$story->content;
        $story->category_id = $request->category_id?:$story->category_id;

        $story->update();


		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
	    	$file = Files::where('table','Story')->where('table_id',$story->id)->first();
	    	$file->file_name = $name;
	    	$file->update();
		}

    	return $story;
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
