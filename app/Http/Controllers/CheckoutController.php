<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    //
    public function checkoutPlan($slug){
        $plan = DB::select("SELECT * FROM plan where id=".$slug);
        $plan_name = $plan[0]->name;
        $plan_amount = $plan[0]->amount;
        $plan_id = $plan[0]->id;
        $type = $plan[0]->type;
        if($type == 'free'){
            $type = 'Free Daily';
        }
        $data = array(
            "plan_name"=>$plan_name,
            "plan_price"=>$plan_amount,
            "plan_id"=>$plan_id,
            "plan_quota"=>$plan[0]->quota,
            "plan_type"=>$type
        );
        
        return view('dashboard.pages.checkout',["active" => "plan",
        "resource" => $data]);
    }
}
