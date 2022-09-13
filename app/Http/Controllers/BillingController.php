<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class BillingController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = new SessionHelper;
    }
    public function index(){
        //check user plan
        $getPlan = $this->user->getPlan();
		//check if status invoice payment-process
		$getInvoiceStatus = $this->user->getInvoiceStatus();
        
		if($getInvoiceStatus == 'payment-process'){
			$data = array(
				'payment_status'=>'payment-process'
			);
			return view('dashboard.pages.report',["active"=>"billing","resource"=>$data]);
		} else 
        if($getPlan == null){
            return redirect()->route('plan');
        } else {
            $getUser = $this->user->getUser();
            $user_id = $getUser->id;
            $report = DB::select("SELECT i.`id`, i.`invoice_number`, i.`price`, i.`currency`, u.`name`, i.status, p.`method` FROM invoice i join plan u on (i.plan_id = u.id) join payment_transaction p on (i.id = p.`invoice_id`) where i.user_id =".$user_id." ORDER BY i.created_at DESC");
            if($report == false){
                $data =[];
            } else {
                $data = $report;
                
            }
            
            return view('dashboard.pages.billing',["active"=>"billing","resource"=>$data]);
            
        }
    }
    public function generateInvoicePDF()
    {
        $pdf = PDF::loadView('dashboard.partials.invoice');

        return $pdf->download('AccMailerInvoice#12121.pdf');
    }
}
