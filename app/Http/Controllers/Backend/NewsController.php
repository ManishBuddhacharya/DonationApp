<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\News;
use App\Files;

class NewsController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.news.';
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
        return view($this->layout.'news', compact('news'));
    }

    public function addNews()
    {
        return view($this->layout.'addNews');
    }


    public function insertNews(Request $request)
    {
        $news = new News;

        $news->title = $request->title;
        $news->content = $request->content;
        $news->category_id = $request->category_id;
        $news->userc_id = auth()->user()->id;

        $news->save();


    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "News";
    	$file->type = "image";
    	$file->table_id = $news->id;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $news;

        // return view($this->layout.'addStory');
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
        return view($this->layout.'newsDetail', compact('news'));
    }

    public function editNews($id)
    {
    	$news = News::join('files',function($join){
	                        $join->on('files.table',DB::raw('"News"'));
	                        $join->on('files.table_id','news.id');
	                    })
	                    ->join('categories','categories.id','news.category_id')
	                    ->select('files.*','categories.*','news.*' )
	                    ->where('news.id', $id)
	                    ->first();
        return view($this->layout.'editNews', compact('news'));
    }

    public function deleteNews($id)
    {
    	$news = News::find($id)->delete();
    	if ($news) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting News";
    	}
    }

    public function updateNews(Request $request, $id)
    {
        $news = News::find($id);

        $news->title = $request->title?:$news->title;
        $news->content = $request->content?:$news->content;
        $news->category_id = $request->category_id?:$news->category_id;

        $news->update();


		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
	    	$file = Files::where('table','News')->where('table_id',$news->id)->first();
	    	$file->file_name = $name;
	    	$file->update();
		}

    	return $news;
    }

    public function fileUpload(Request $request) {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            // $image->move($destinationPath, $name);
            Storage::disk('images')->put($name, file_get_contents($image));
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
