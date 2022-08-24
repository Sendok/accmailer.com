<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;

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
 
}
