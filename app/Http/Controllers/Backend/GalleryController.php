<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Files;

class GalleryController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.gallery.';
    }

    public function gallery()
    {
    	$images = Files::where('table','Gallery')->get();
        return view($this->layout.'gallery', compact('images'));
    }

    public function addImage()
    {
        return view($this->layout.'addImage');
    }


    public function insertImage(Request $request)
    {

    	$name = $this->fileUpload($request);

    	$file = new Files;
    	$file->file_name = $name;
    	$file->table = "Gallery";
    	$file->type = "image";
    	$file->table_id = 0;
    	$file->userc_id = auth()->user()->id;
    	$file->save();

    	return $file;

        // return view($this->layout.'addStory');
    }

    public function editImage(Files $image)
    {
        return view($this->layout.'editImage', compact('image'));
    }

    public function deleteImage(Files $image)
    {
    	$del = $image->delete();
    	if ($del) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting Image";
    	}
    }

    public function updateImage(Request $request, Files $image)
    {
		if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);

	    	$image->file_name = $name;
	    	$image->update();
	    	return $image;
		}
		else {
			$image->file_name = $image->file_name;
	    	$image->update();
	    	return $image;
		}
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

}
