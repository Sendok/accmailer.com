<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;

class SingleController extends Controller
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
			return view('dashboard.pages.single',["active"=>"single","resource"=>$data]);
		} else {
            $getQuota = $this->user->getQuota();
            $data = array(
                "quota"=>$getQuota["quota"],
                "type"=>$getQuota["type"],
                "user_plan_id"=>$getPlan->id
            );

            return view('dashboard.pages.single',["active"=>"single","resource"=>$data]);
        }
    }
    public function validateSingle(Request $request){
        $date  =date("Y-m-d");
		$email = $request->input('email');
		$status  = "validate.next";
        $getQuota = this->user>getQUota();
        $quota = $getQuota["quota"];
        if($quota == 0){
			$status = 'validate.max';
            return redirect()->back()->with($status);
        } 
		$c_guest = DB::select("SELECT count(id) as total FROM validate_email where  ip_address like '".$ip."' and date(created_at) = '".$date."'");
		if($c_guest[0]->total > 0){
			$data = json_decode(main($request->input('email')), true);	
			if($data["data"]["status"] == 'valid'){
				$e_status = 1;
			} else 
			if($data["data"]["status"] == 'invalid'){
				$e_status = 2;
			} else {
				$e_status = 3;
			}	
			
			DB::table('validate_email')->insert([
				'email' => $data["data"]["email"],
				'guest_ip_address' => $ip,
				'lat' => $lat,
				'lon' => $lon,
				'status_id' => $e_status,
				'smtp_host' => $data["data"]["smtp"],
				'domain' => $data["data"]["host"],
				'mx_record' => $data["data"]["type"],
				'ip_target' => $data["data"]["target"]
			]);
			$data = $data["data"];
			return redirect()->back()->with($status, $data);
		
		} else {
			$data = json_decode(main($request->input('email')), true);	
			if($data["data"]["status"] == 'valid'){
				$e_status = 1;
			} else 
			if($data["data"]["status"] == 'invalid'){
				$e_status = 2;
			} else {
				$e_status = 3;
			}	
			DB::table('validate_email')->insert([
				'email' => $data["data"]["email"],
				'guest_ip_address' => $ip,
				'lat' => $lat,
				'lon' => $lon,
				'status_id' => $e_status,
				'smtp_host' => $data["data"]["smtp"],
				'domain' => $data["data"]["host"],
				'mx_record' => $data["data"]["type"],
				'ip_target' => $data["data"]["target"]
			]);
			$data = $data["data"];
			return redirect()->back()->with($status, $data);
		}
    }
}
