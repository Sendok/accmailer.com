<?php
include '../../config.php';
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

class IndexController extends Controller
{
	private $helper;
	// private $formatter;

	function __construct(){
		$this->helper = new Helper;
	}

	public function index(){
		$token = session('ad_session');
		if(isset($token)){
			
		}
	}
}
