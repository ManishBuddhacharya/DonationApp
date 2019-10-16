<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Files;
use App\User;

class SettingController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.setting.';
    }

    public function setting()
    {
    	$user = auth()->user();
        return view($this->layout.'setting', compact('user'));
    }


    public function updateProfile(Request $request, User $user)
    {
        $user->name = $request->name?:$user->name;
        $user->email = $request->email?:$user->email;
        $user->phone = $request->phone?:$user->phone;
        $user->address = $request->address?:$user->address;

        $user->update();

    	return $user;
    }

    public function updateProfilePicture(Request $request, User $user)
    {
        if ($request->hasFile('file')){
	    	$name = $this->fileUpload($request);
		    $user->profile_img = $name;
	    	$user->update();
		}

    	return $user;
    }

    public function updatePassword(Request $request, User $user)
    {
        $user->password = $request->password?Hash::make($request->password):$user->password;

        $user->update();

    	return $user;
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
