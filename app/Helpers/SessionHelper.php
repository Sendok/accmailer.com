<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class SessionHelper
{
    // get User ID from session 
    public function getUser(){
        $pass = session()->all()["password_hash_sanctum"];
        $getUser = DB::select("select * from users where password like '".$pass."'");
        $getUser = $getUser[0];
        return $getUser;
    }
    public function getPlan(){
        $date = date('Y-m-d H:i:s');
        $user = $this->getUser();
        $user_id = $user->id;
        $getUserPlan = DB::select("select * from user_plan where user_id = ".$user_id." and (end_at >= '".$date."' or end_at is null)");
        if($getUserPlan == false){
            $getUserPlan = null;
        } else {
            $getUserPlan = $getUserPlan[0];
        }
        return $getUserPlan;
    }
    public function getQuota(){
        $date = date('Y-m-d H:i:s');
        $plan = $this->getPlan();
        $user_plan_id = $plan->id;
        $plan_id = $plan->plan_id;
        $getPlan = DB::select("select quota, type from plan where id = ".$plan_id." ");
        $quota = $getPlan[0]->quota;
        $type = $getPlan[0]->type;
       
        if($type == 'free'){
            $getValidateUsed = DB::select("select count(id) as total from validate_email where date(created_at) = date(curdate()) and  user_plan_id = ".$user_plan_id." ");
        } else 
        {
            $getValidateUsed = DB::select("select count(id) as total from validate_email where user_plan_id = ".$user_plan_id." ");
        }
        $totalUsed = $getValidateUsed[0]->total;
        $quota = $quota - $totalUsed;
        $data = array(
            "quota"=>$quota,
            "type"=>$type
        );
        return $data;
    }
    public function getInvoiceStatus(){
        $getUser = $this->getUser();
        $getInvoice = DB::select("SELECT * FROM invoice where user_id =".$getUser->id." and status = 'payment-process' order by id DESC LIMIT 1");
        
        if($getInvoice == false){
            $status = null;
        } else {
            $status = $getInvoice[0]->status;
        }
        return $status;
    }
    public function getIDRCurrency($price){
        // Fetching JSON
        $req_url = 'https://api.exchangerate-api.com/v4/latest/USD';
        $response_json = file_get_contents($req_url);
        // Continuing if we got a result
        if(false !== $response_json) {

            // Try/catch for json_decode operation
            try {

            // Decoding
            $response_object = json_decode($response_json);

            // YOUR APPLICATION CODE HERE, e.g.
            $IDR_price = round(($price * $response_object->rates->IDR), 2);
            return $IDR_price;
            }
            catch(Exception $e) {
                // Handle JSON parse error...
                return false;
            }
        }
    }
}
