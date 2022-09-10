<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;
use Response;
use App\Exports\BulkExport;
use Maatwebsite\Excel\Facades\Excel;
include(app_path().'/Http/Controllers/mainValidate.php');

class BulkController extends Controller
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
			return view('dashboard.pages.bulk',["active"=>"bulk","resource"=>$data]);
		} else 
        if($getPlan == null){
            return redirect()->route('plan');
        } else{
            $plan_id = $getPlan->plan_id;
            if($plan_id == 1){
                $data = array(
                    'plan_free'=>true
                );
                return view('dashboard.pages.bulk',["active"=>"bulk","resource"=>$data]);
            } else {
                $getQuota = $this->user->getQuota();
                $data = array(
                    "quota"=>$getQuota["quota"],
                    "type"=>$getQuota["type"],
                    "user_plan_id"=>$getPlan->id
                );
                return view('dashboard.pages.bulk',["active"=>"bulk","resource"=>$data]);
            }
            
        }
    }
    public function validateBulk(Request $request){
		
		$email = $request->email;
		$code = $request->code;
        $getQuota = $this->user->getQuota();
		$getPlan = $this->user->getPlan();
		DB::update(
            'update user_plan set bulk_inuse = 1 where id = ?',
            [$getPlan->id]
        );
        $quota = $getQuota["quota"];
        if($quota == 0){
			$response = array(
				"message"=>"max"
			);
        } else {
			$data = json_decode(main($email), true);	
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
				'status_id' => $e_status,
				'smtp_host' => $data["data"]["smtp"],
				'domain' => $data["data"]["host"],
				'mx_record' => $data["data"]["type"],
				'ip_target' => $data["data"]["target"],
				'ttl'=>$data["data"]["ttl"],
				'validate_type' => 'bulk',
				'validate_bulk_code_id'=>$code,
				'user_id' => $getPlan->user_id,
				'user_plan_id' => $getPlan->id
			]);
			$response = array();
			$response["status"] = $data["data"]["status"];
			$response["message"] = 'next';
			DB::update(
				'update user_plan set bulk_inuse = 0 where id = ?',
				[$getPlan->id]
			);
			return $response;
		}
    }
	public function validateCountBulk(Request $request){
		$date = date('Y-m-d H:i:s');
		$count = $request->count;
        $getQuota = $this->user->getQuota();
		$getPlan = $this->user->getPlan();
        $quota = $getQuota["quota"];
		
        if($count > $quota){
			$response = array(
				"message"=>"max"
			);
        } else {
			$response = array(
				"message"=>"next"
			);
			$length = 8;
			$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$code = $randomString;
			$insert = DB::table('validate_bulk_code')->insert([
				'code' => $randomString,
				'user_plan_id' => $getPlan->id
			]);
			$insert_id = DB::getPdo()->lastInsertId();
			$response["code"] = $insert_id;
			$response["re_code"] = $randomString;
		}

		
		return $response;
	}
	public function BulkExport($slug){
		return Excel::download(new BulkExport($slug), 'BulkVerification#ACC'.$slug.'.xlsx');
	}

}
