<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\UserPosition;
use App\Files;


class OrganizationController extends Controller
{
    protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.backend.organization.';
    }

    public function organization()
    {    	
        return view($this->layout.'organization');
    }

    public function addMemberPosition()
    {
        return view($this->layout.'addMemberPosition');
    }

    public function memberPositions()
    {
        $users = DB::table('user_positions')
        ->join('users','users.id', '=', 'user_positions.user_id')
        ->join('positions','positions.id', '=', 'user_positions.position_id')
        ->select('users.*', 'positions.*', 'user_positions.*')
        ->orderBy('positions.rank')
        ->get();
        $data=json_encode($users);
        return $data;

    }

    public function allMemberPositions()
    {
        $users = DB::table('user_positions')
        ->join('users','users.id', '=', 'user_positions.user_id')
        ->join('positions','positions.id', '=', 'user_positions.position_id')
        ->select( 'user_positions.*', 'positions.*', 'users.*')
        ->orderBy('positions.rank')
        ->get();
        $data=json_encode($users);
        return $data;

    }


    public function insertMemberPosition(Request $request)
    {
        $position = new UserPosition;

        $position->user_id = $request->user_id;
        $position->position_id = $request->position_id;
        $position->userc_id = auth()->user()->id;

        $position->save();

    	return $position;

        // return view($this->layout.'addStory');
    }

    public function editMemberPosition($id)
    {
    	$position = UserPosition::join('positions','positions.id','user_positions.position_id')
    					->join('users','users.id','user_positions.id')
	                    ->select('users.*','positions.*','user_positions.*' )
	                    ->where('user_positions.id', $id)
	                    ->first();
        return view($this->layout.'editMemberPosition', compact('position'));
    }

    public function deleteMemberPosition($id)
    {
    	$position = UserPosition::find($id)->delete();
    	if ($position) {
	        return "Delete Successful";
    	}
    	else {
    		return "Something went wrong while deleting News";
    	}
    }

    public function updateMemberPosition(Request $request, $id)
    {
        $position = UserPosition::find($id);

        $position->position_id = $request->position_id?:$position->position_id;
        $position->user_id = $request->user_id?:$position->user_id;

        $position->update();

    	return $position;
    }

	/*Positions*/
	public function fetchPositions(Request $req)
    {
        $data = DB::table('positions')
                ->where('position_name', 'like', $req->term.'%')
                ->get();

        if (!is_null($req->terms)){
            $data[] = ['id' => $req->terms, 'text' => $req->terms ];
        }

        return response()->json($data);
    }

    /*Users*/
	public function fetchUsers(Request $req)
    {
        $data = DB::table('users')
                ->where('name', 'like', $req->term.'%')
                ->get();

        if (!is_null($req->terms)){
            $data[] = ['id' => $req->terms, 'text' => $req->terms ];
        }

        return response()->json($data);
    }
}
