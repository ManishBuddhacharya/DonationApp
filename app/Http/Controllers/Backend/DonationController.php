<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;

use App\Donation;
use App\Cause;

class DonationController extends Controller
{
	protected $layout;
    public function __construct()
    {
        $this->layout = 'layouts.frontend.pages.causes.';
    }

	public function causeDonation($id)
    {
    	$cause = Cause::join('files',function($join){
	                        $join->on('files.table',DB::raw('"Cause"'));
	                        $join->on('files.table_id','causes.id');
	                    })
	                    ->join('categories','categories.id','causes.category_id')
	                    ->select('files.*','categories.*','causes.*' )
	                    ->where('causes.id', $id)
	                    ->first();
        return view($this->layout.'inc.donation', compact('cause'));
    }

    /*Donation*/
    public function donation(Request $request)
    {
        \Stripe\Stripe::setApiKey ('sk_test_jSydx2o1jNo3Je8dPelgZOPM00EM7cSJBQ');
        try {
        	$customer = \Stripe\Customer::create([
			      "description" => "Customer for Donation app",
			      'source'  => "tok_amex"
			  ]);

			$charge = \Stripe\Charge::create([
				'customer' => $customer->id,
		      	'amount'   => $request->amount * 100,
		      	'currency' => 'usd',
                "description" => "Donation payment." 
			]);

            if ($charge) {
            	$donation = new Donation;

		        $donation->user_id = auth()->user()->id;
		        $donation->cause_id = $request->cause_id;
		        $donation->amount = $request->amount;
		        $donation->userc_id = auth()->user()->id;

		        $donation->save();
            }
            Session::flash ( 'success-message', 'Donation successfully !' );
	        return Redirect::back ();
        } catch ( \Exception $e ) {
        	Session::flash ( 'fail-message', "Error! Please Try again." );
			return Redirect::back ();
        }
    }
}

