<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;

class CheckoutController extends Controller
{
    //
    protected $user;

    public function __construct()
    {
        $this->user = new SessionHelper;
    }
    public function checkoutPlan($slug){
        $plan = DB::select("SELECT * FROM plan where id=".$slug);
        $plan_name = $plan[0]->name;
        $plan_amount = $plan[0]->amount;
        $plan_id = $plan[0]->id;
        $type = $plan[0]->type;
        if($type == 'free'){
            $type = 'Free Daily';
        }
        $plan_amount_idr = (int)$this->user->getIDRCurrency($plan_amount);
        $data = array(
            "plan_name"=>$plan_name,
            "plan_price"=>$plan_amount,
            "plan_price_idr"=>$plan_amount_idr,
            "plan_id"=>$plan_id,
            "plan_quota"=>$plan[0]->quota,
            "plan_type"=>$type
        );
        
        return view('dashboard.pages.checkout',["active" => "plan",
        "resource" => $data]);
    }
}
