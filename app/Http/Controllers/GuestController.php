<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
include(app_path().'/Http/Controllers/mainValidate.php');
class GuestController extends Controller
{
	public function index(){
		//creadential
		return view('landing.index');

	}
	public function validateGuest(Request $request){
		// return back();
		$date  =date("Y-m-d");
		$ip =  $request->input('ip');
		$lat =  $request->input('lat');
		$lon =  $request->input('lon');
		$email = $request->input('email');
		$status  = "guest.next";
		$c_guest = DB::select("SELECT count(id) as total FROM validate_email_guest where  guest_ip_address like '".$ip."' and date(created_at) = '".$date."'");
		if($c_guest[0]->total > 0){
			if($c_guest[0]->total > 4){
				$status  = "guest.max";
				$data = "Max";
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
				
				DB::table('validate_email_guest')->insert([
					'email' => $data["data"]["email"],
					'guest_ip_address' => $ip,
					'lat' => $lat,
					'lon' => $lon,
					'status_id' => $e_status,
					'smtp_host' => $data["data"]["smtp"],
					'domain' => $data["data"]["host"],
					'ttl'=>$data["data"]["ttl"],
					'mx_record' => $data["data"]["type"],
					'ip_target' => $data["data"]["target"]
				]);
				$data = $data["data"];
				// die(var_dump($data));
				return redirect()->back()->with($status, $data);
			}
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
			DB::table('validate_email_guest')->insert([
				'email' => $data["data"]["email"],
				'guest_ip_address' => $ip,
				'lat' => $lat,
				'lon' => $lon,
				'status_id' => $e_status,
				'smtp_host' => $data["data"]["smtp"],
				'domain' => $data["data"]["host"],
				'ttl'=>$data["data"]["ttl"],
				'mx_record' => $data["data"]["type"],
				'ip_target' => $data["data"]["target"]
			]);
			$data = $data["data"];
			return redirect()->back()->with($status, $data);
		}
	}


}
