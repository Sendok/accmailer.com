<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;

class PlanController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new SessionHelper;
    }
    // public index
    public function index(){
        //check user plan
        $getPlan = $this->user->getPlan();
		//check if status invoice payment-process
		$getInvoiceStatus = $this->user->getInvoiceStatus();
        
		if($getInvoiceStatus == 'payment-process'){
			$data = array(
				'payment_status'=>'payment-process'
			);
			return view('dashboard.pages.plan',["active"=>"plan","resource"=>$data]);
		} else 
        if($getPlan == null){
            return view('dashboard.pages.plan',["active"=>"plan"]);
        } else {
            $plan_id = $getPlan->plan_id;
            $getQuota = $this->user->getQuota();
            $data = array(
                "plan_id"=>$plan_id,
                "quota"=>$getQuota["quota"]
            );
            return view('dashboard.pages.plan',["active"=>"plan","resource"=>$data]);
            
        }
    }
}
