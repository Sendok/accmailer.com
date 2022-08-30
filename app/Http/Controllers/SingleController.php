<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;
use App\Exports\SingleExport;
use Maatwebsite\Excel\Facades\Excel;
include(app_path().'/Http/Controllers/mainValidate.php');

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
		if($getInvoiceStatus == 'payment-process'){
			$data = array(
				'payment_status'=>'payment-process'
			);
			return view('dashboard.pages.single',["active"=>"single","resource"=>$data]);
		} else 
		if($getPlan == null){
            return redirect()->route('plan');
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
		$email = $request->input('email');
		$ip = $request->input('ip');
		$lat = $request->input('lat');
		$lon = $request->input('lon');
		$status  = "validate.next";
        $getQuota = $this->user->getQuota();
		$getPlan = $this->user->getPlan();
        $quota = $getQuota["quota"];
        if($quota == 0){
			$status = "validate.max";
			$data = array(
				"quota"=>0
			);
            return redirect()->back()->with($status,$data);
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
			$insert = DB::table('validate_email')->insert([
				'email' => $data["data"]["email"],
				'ip_address' => $ip,
				'lat' => $lat,
				'lon' => $lon,
				'status_id' => $e_status,
				'smtp_host' => $data["data"]["smtp"],
				'domain' => $data["data"]["host"],
				'mx_record' => $data["data"]["type"],
				'ip_target' => $data["data"]["target"],
				'ttl'=>$data["data"]["ttl"],
				'validate_type' => 'single',
				'user_id' => $getPlan->user_id,
				'user_plan_id' => $getPlan->id
			]);
			$length = 20;
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$data["data"]["id"] = $randomString.''.DB::getPdo()->lastInsertId();
			$data = $data["data"];
			return redirect()->back()->with($status, $data);
		}
    }
	public function SingleExport($slug){
		$id = substr($slug, 20);
		return Excel::download(new SingleExport($id), 'SingleVerification#accid'.$id.'.xlsx');
	}
}
