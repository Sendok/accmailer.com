<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\SessionHelper;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;

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
        
		if($getInvoiceStatus == 'payment-process'){
			$data = array(
				'payment_status'=>'payment-process'
			);
			return view('dashboard.pages.report',["active"=>"report","resource"=>$data]);
		} else 
        if($getPlan == null){
            return redirect()->route('plan');
        } else {
            $getUser = $this->user->getUser();
            $user_id = $getUser->id;
            $report = DB::select("SELECT * FROM reports where month(created_at) = month(curdate()) and year(created_at) = year(curdate()) and user_id =".$user_id." ");
            if($report == false){
                $data =[];
            } else {
                $data = $report;
                $length = 20;
                $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                $data[0]->user_id = $randomString.''.$user_id;
            }
            
            return view('dashboard.pages.report',["active"=>"report","resource"=>$data]);
            
        }
    }
    public function reportExport($slug){
        $id = substr($slug, 20);
        $date = date('#Y#m#d');
		return Excel::download(new ReportExport($id), 'Report#AccMailer'.$date.'.xlsx');
    }
}
