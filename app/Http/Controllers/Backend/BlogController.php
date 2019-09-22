<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use App\Blog;
use App\Files;

class BlogController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.blog.';
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
        return view($this->layout.'blog', compact('blogs'));
    }

    public function addBlog()
    {
        return view($this->layout.'addBlog');
    }


    public function insertBlog(Request $request)
    {
        $blog = new Blog;

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->userc_id = auth()->user()->id;

        $blog->save();


    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "Blog";
    	$file->type = "image";
    	$file->table_id = $blog->id;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $blog;

        // return view($this->layout.'addStory');
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
        return view($this->layout.'BlogDetail', compact('blog'));
    }

    public function editBlog($id)
    {
    	$blog = Blog::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Blog"'));
	                        $join->on('files.table_id','blogs.id');
	                    })
	                    ->join('categories','categories.id','blogs.category_id')
	                    ->select('files.*','categories.*','blogs.*' )
	                    ->where('blogs.id', $id)
	                    ->first();
        return view($this->layout.'editBlog', compact('blog'));
    }

    public function deleteBlog($id)
    {
    	$blog = Blog::find($id)->delete();
    	if ($blog) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting Blog";
    	}
    }

    public function updateBlog(Request $request, $id)
    {
        $blog = Blog::find($id);

        $blog->title = $request->title?:$blog->title;
        $blog->content = $request->content?:$blog->content;
        $blog->category_id = $request->category_id?:$blog->category_id;

        $blog->update();


		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
	    	$file = Files::where('table','Story')->where('table_id',$blog->id)->first();
	    	$file->file_name = $name;
	    	$file->update();
		}

    	return $blog;
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
