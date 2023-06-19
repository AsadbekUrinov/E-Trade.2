<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
// use App\Models\hisplans;
use App\Models\Agent;
//use App\Models\confirmations;
use App\Models\User_plans;
//use App\Models\fees;
use App\Models\Admin;
use App\Models\Faq;
//use App\Models\Task;
use App\Models\Images;
use App\Models\Testimony;
use App\Models\Content;
use App\Models\Asset;
use App\Models\Mt4dDtails;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Cp_transaction;
use App\Models\Tp_Transaction;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;

use App\Mail\NewNotification;
use App\Mail\newroi;
use App\Mail\endplan;
use Illuminate\Support\Facades\Mail;

class SystemController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CPTrait;


     //block user
   public function ublock($id){
  
    User::where('id',$id)
    ->update([
    'status' => 'blocked',
    ]);
    return redirect()->route('manageusers')
    ->with('message', 'Action Sucessful!');
  }

   //unblock user
   public function unblock($id){

    User::where('id',$id)
    ->update([
    'status' => 'active',
    ]);
    return redirect()->route('manageusers')
    ->with('message', 'Action Sucessful!');
  }


  //Turn on/off user trade
  public function usertrademode(Request $request, $id, $action){
    if($action=="on"){
        $action = "on";
    }elseif($action == "off"){
        $action = "off";
    }else{
        return redirect()-back()->with('message',"Unknown action!");
    }
    
    User::where('id', $id)
    ->update([
    'trade_mode' => $action,
    ]);
    return redirect()->back()
    ->with('message', "User trade mode has been turned $action.");
}


}
