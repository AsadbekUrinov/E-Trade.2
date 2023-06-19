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
use Illuminate\Support\Facades\Hash;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;

use App\Mail\NewNotification;
use App\Mail\newroi;
use App\Mail\endplan;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CPTrait;



   //block user
   public function ublock($id){
  
    Admin::where('id',$id)
    ->update([
    'acnt_type_active' => 'blocked',
    ]);
    return redirect()->back()
    ->with('message', 'Manager Blocked');
  }

   //unblock user
   public function unblock($id){

    Admin::where('id',$id)
    ->update([
    'acnt_type_active' => 'active',
    ]);
    return redirect()->back()
    ->with('message', 'Manager Unblocked');
  }

  //Reset Password
  public function resetadpwd(Request $request, $id){
    Admin::where('id', $id)
    ->update([
    'password' => Hash::make('admin01236'),
    ]);
    return redirect()->back()
    ->with('message', 'Password reset Successful.');
} 

public function deluser(Request $request, $id){
  
    Admin::where('id', $id)->delete();
    return redirect()->back()
    ->with('message', 'Manager has been deleted!');
  }  

  //update users info
  public function editadmin(Request $request){
    
    Admin::where('id', $request['user_id'])
    ->update([
    'firstName' => $request['fname'],
    'lastName' => $request['l_name'],
    'email' =>$request['email'], 
    'phone' =>$request['phone'], 
    'type' =>$request['type'], 
    ]);
    return redirect()->back()
    ->with('message', 'Account updated Successfully!');
}

    //Send mail to one user
    public function sendmail(Request $request){

        $settings=Settings::where('id', '=', '1')->first();
        //send email notification
        $mailduser=Admin::where('id',$request->user_id)->first();
        $objDemo = new \stdClass();
        $objDemo->message = $request['message'];
        $objDemo->sender = $settings->site_name;
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject ="$settings->site_name Notification";
        Mail::bcc($mailduser->email)->send(new NewNotification($objDemo));
        return redirect()->back()->with('message','Your message was sent successfully!');

    } 

    public function adminchangepassword(Request $request){
        return view('admin.changepassword')->with(array(
            'title'=>'Change Password',
            'settings' => Settings::where('id', '=', '1')->first()
        ));
      }


       //Update Password
    public function adminupdatepass(Request $request){
        if(!password_verify($request['old_password'],$request['current_password']))
        {
          return redirect()->back()
          ->with('message', 'Incorrect Old Password');
        }
        $this->validate($request, [
        'password_confirmation' => 'same:password',
        'password' => 'min:8',
        ]);

          Admin::where('id', $request['id'])
          ->update([
          'password' => Hash::make($request['password']),
          ]);
          return redirect()->back()
          ->with('message', 'Password Changed Sucessfully');
    } 

    
   //accept KYC route
   public function acceptkyc($id)
   {
     //update user
     User::where('id',$id)
     ->update([
         'account_verify' => 'Verified',
         ]);
 
   return redirect()->back()
   ->with('message', 'Action Sucessful!');
   }
   
    //accept KYC route
   public function rejectkyc($id)
   {
     //update user
     User::where('id',$id)
     ->update([
         'account_verify' => 'Rejected',
         'id_card'=> NULL,
         'passport' => NULL,
    ]);
 
   return redirect()->back()
   ->with('message', 'Action Sucessful!');
   }
 
    //accept KYC route
    public function changestyle(Request $request)
    {
      if(isset($request['style']) and $request['style']=='true'){
        $dashboard_style="dark";
      }else{
        $dashboard_style="light";
      }
        //change dashboard style
      Admin::where('id', Auth('admin')->User()->id)
      ->update([
          'dashboard_style' => $dashboard_style,
          ]);
        return response()->json(['success'=>'Changed']);
        
    }

}
