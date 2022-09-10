<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Session;
use App\Helpers\SessionHelper;
 

class UserController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new SessionHelper;
    }
    public function Logout(){
        $getUser = $this->user->getUser();
        $user_id = $getUser->id;
        DB::update(
            'update users set remember_token = null where id = ?',
            [$user_id]
        );
        $flight = Session::where('user_id', $user_id);
        $flight->delete();
        return redirect()->route('login');
    }
}
