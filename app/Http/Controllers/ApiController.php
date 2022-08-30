<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;
use Response;
include(app_path().'/Http/Controllers/mainValidate.php');

class ApiController extends Controller
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
			return view('dashboard.pages.api',["active"=>"api","resource"=>$data]);
		} else 
        if($getPlan == null){
            return redirect()->route('plan');
        } else{
            $plan_id = $getPlan->plan_id;
            if($plan_id == 1){
                $data = array(
                    'plan_free'=>true
                );
                return view('dashboard.pages.api',["active"=>"api","resource"=>$data]);
            } else {
                $getQuota = $this->user->getQuota();
                $getAPIToken = $this->user->getAPIToken();
                $data = array(
                    "quota"=>$getQuota["quota"],
                    "type"=>$getQuota["type"],
                    "user_plan_id"=>$getPlan->id,
                    "token"=>$getAPIToken,
                );
                return view('dashboard.pages.api',["active"=>"api","resource"=>$data]);
            }
            
            
            
        }
    }
    public function generatApiToken(){
        $getPlan = $this->user->getPlan();
        $length = 50;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $token = $randomString;
        DB::update(
            'update validate_token_api set status = "not-active" where user_plan_id = ?',
            [$getPlan->id]
        );
        DB::table('validate_token_api')->insert([
            'token' => $token,
            'user_id' =>  $getPlan->user_id,
            'user_plan_id' => $getPlan->id,
            'status' => 'active'
        ]);
        return redirect()->route('api');

    }
    public function APIVerification(Request $request){
        $date = date('Y-m-d H:i:s');
        $email = trim($request->email);
        $header = \Request::header();
        $key = $header["accmailer-api-key"][0];
        $token = DB::select("select t.token, t.user_plan_id, p.user_id,p.plan_id from validate_token_api t join user_plan p on (t.user_plan_id = p.id) where p.end_at >= '".$date."' and t.token like '".$key."'");
        if(isset($token[0])){
            
            $user_id = $token[0]->user_id;
            $user_plan_id = $token[0]->user_plan_id;
            $plan_id = $token[0]->plan_id;
            //cek quota
            $date = date('Y-m-d H:i:s');
            $getPlan = DB::select("select quota, type from plan where id = ".$plan_id." ");
            $quota = $getPlan[0]->quota;
            $type = $getPlan[0]->type;
            $getValidateUsed = DB::select("select count(id) as total from validate_email where user_plan_id = ".$user_plan_id." ");
            $totalUsed = $getValidateUsed[0]->total;
            $quota = $quota - $totalUsed;
            if($quota > 0){
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
                    'validate_type' => 'api',
                    'user_id' => $user_id,
                    'user_plan_id' => $user_plan_id
                ]);
                $response = $data["data"];
                $response = array(
                    "email"=>$data["data"]["email"],
                    "status"=>$data["data"]["status"],
                    "smtp_host"=>$data["data"]["smtp"],
                    "domain"=>$data["data"]["host"],
                    "mx_record"=>$data["data"]["type"],
                    "ttl"=>$data["data"]["ttl"],
                    "ip_target"=>$data["data"]["target"]
                );
                $code = 200;
            } else {
                //quota reach max
                $response = array(
                    "message"=>"Verification quota has reached the limit",
                    "status"=>"quota_max"
                );
                $code = 200;
            }
            
        } else {
            //unautorized
            $response = array(
                "message"=>"Unauthorized or Wrong Api Key",
                "status"=>"error"
            );
            $code = 403;
        }
        return Response::json($response, $code);
    }
 
}
