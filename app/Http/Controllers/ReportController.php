<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;

class ReportController extends Controller
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
        if($getPlan == null){
            return redirect()->route('plan');
        } else
		if($getInvoiceStatus == 'payment-process'){
			$data = array(
				'payment_status'=>'payment-process'
			);
			return view('dashboard.pages.report',["active"=>"report","resource"=>$data]);
		} else {
            $getQuota = $this->user->getQuota();
            $data = array(
                "quota"=>$getQuota["quota"],
                "type"=>$getQuota["type"],
                "user_plan_id"=>$getPlan->id
            );
            return view('dashboard.pages.report',["active"=>"report","resource"=>$data]);
            
        }
    }
}
