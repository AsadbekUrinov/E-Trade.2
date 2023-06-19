<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
use App\Models\Agent;
use App\Models\User_plans;
use App\Models\Admin;
use App\Models\Faq;
use App\Models\Images;
use App\Models\Testimony;
use App\Models\Content;
use App\Models\Asset;
use App\Models\Mt4Details;
use App\Models\Deposit; 
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Cp_transaction;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;
use App\Mail\NewNotification;
use App\Mail\NewRoi;
use App\Mail\endplan;
use Illuminate\Support\Facades\Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests,CPTrait;

    public function dashboard(Request $request)
    {
        
        $settings=Settings::where('id','1')->first();
        
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        
        $key = $this->generate_string($permitted_chars, 5);
        
        //set files key if not set
        if($settings->files_key == NULL){
            Settings::where('id','1')->update([
                'files_key' => 'OT_'.$key,
                ]);
        }

        //new line
        
        //Check if the user is referred by someone after a successful registration
        $settings=Settings::where('id','1')->first();
        if($request->session()->has('ref_by')) {
            $ref_by = $request->session()->get('ref_by');
            if($ref_by != Auth::user()->id) {
            
            //update the user ref_by with the referral ID 
            User::where('id', Auth::user()->id)
            ->update([
            'ref_by' => $ref_by,
            ]);

           $ag = Agent::where('agent',$ref_by)->first();
          //check if the refferral already exists
          if(count($ag)>0){
            //update the agent info
            Agent::where('id',$ag->id)->increment('total_refered', 1);
          }
          else{
            //add the referee to the agents model

          $agent_id = DB::table('agents')->insertGetId(
            [
              'agent' => $ref_by,
              'created_at' => \Carbon\Carbon::now(),
              'updated_at' => \Carbon\Carbon::now(),
            ]
           );
          //increment refered clients by 1
          Agent::where('id',$agent_id)->increment('total_refered', 1);
            }
            $request->session()->forget('ref_by');
          }
      }
        

	      //check for users without ref link and update them with it
          $usf=User::all();
          foreach($usf as $usf){
            //if the ref_link column is empty
            if($usf->ref_link==''){
              User::where('id', $usf->id)
            ->update([
            'ref_link' => $settings->site_address.'/ref/'.$usf->id,
            'ref_bonus' => '0',
            'bonus_released' => '0',
            ]);
          }
          //give reg bonus if new
          if($usf->created_at->diffInDays() < 2 && $usf->signup_bonus!="received"){
              User::where('id', $usf->id)
            ->update([
              'bonus' =>$usf->bonus + $settings->signup_bonus,
            'account_bal' => $usf->account_bal + $settings->signup_bonus,
            'signup_bonus' => "received",
            ]);
          }
          } 
          
          
          //get referral earnings
          
        $dref=Agent::where('agent',Auth::user()->id)->first();
        if(count($dref)==0){
            $ref_earnings = "0.00";
        }else{
           $ref_earnings = "$dref->earnings";
        }

        
        //sum total deposited
        $total_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as count"))->where('user', Auth::user()->id)->
        where('status','Processed')->get();
          
      
        if($settings->payment_mode=='Bank transfer'){
          $condition=empty(Auth::user()->account_no) or empty(Auth::user()->account_name) or empty(Auth::user()->bank_name) or empty(Auth::user()->phone);
        }elseif($settings->payment_mode=='BTC'){
          $condition=empty(Auth::user()->btc_address) or empty(Auth::user()->phone);
        }elseif($settings->payment_mode=='ETH'){
          $condition=empty(Auth::user()->eth_address) or empty(Auth::user()->phone);
        }else{
          $condition=empty(Auth::user()->id);
        }

        //Get bonus from users table
        $total_bonus = User::where('id', Auth::user()->id)->first();

        //count the number of plans users have purchased
        $user_plan = User_plans::where('user', Auth::user()->id)->get();

        $user_plan_active = User_plans::where([
                    ['user', '=', Auth::user()->id],
                    ['active', '=', 'yes']
                ])->get();
        
          //log user out if not approved
        if(Auth::user()->status != "active"){
          $request->session()->flush();
          $request->session()->put('reged','yes');
          return redirect()->route('dashboard');
        }//Also log user out if web dashboard is not enabled and user is not admin
        
        return view('user.dashboard')
        ->with(array(
        //'earnings'=>$earnings,
        'title'=>'User panel',
        'ref_earnings' => $ref_earnings,
        'deposited' => $total_deposited,
        'total_bonus' => $total_bonus,
        'user_plan' => $user_plan,
        'user_plan_active'=> $user_plan_active,
        'upplan' => Plans::where('id', Auth::user()->promo_plan)->first(),
        'uplan' => Plans::where('id', Auth::user()->plan)->first(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    	//}
    }  

      //Skip enter account details
      public function skip_account(Request $request)
      {
        $request->session()->put('skip_account', 'skip account');
        return redirect()->route('dashboard');
      } 
  
      //Subscription Trading 
      public function subtrade(Request $request)
      {
        return view('user.subtrade')
        ->with(array(
        'title'=>'Subscription Trade',
        'subscriptions' => Mt4Details::where('client_id', auth::user()->id)->orderBy('id', 'desc')->get(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
      } 

      public function delsubtrade($id){
        Mt4Details::where('id',$id)->delete();
        return redirect()->back()
                ->with('message', 'MT4 Details Sucessfully Deleted');
      }

       //Subscription Trading 
       public function subpricechange(Request $request)
       {

        $setprice=Settings::where('id','1')->first();
        $monthlyfee=$setprice->monthlyfee;
        $quaterlyfee=$setprice->quaterlyfee;
        $yearlyfee=$setprice->yearlyfee;
        $Subscriptionfee=10;
        $request['duration']=="";
        if ($request['duration']=="Monthly" ) {
          $Subscriptionfee = $monthlyfee; 
        }elseif($request['duration'] == "Quaterly"){
          $Subscriptionfee = $quaterlyfee; 
        }else{
          $Subscriptionfee = $yearlyfee; 
        }

        return response()->json($Subscriptionfee);
       } 

     
       //Save MT4 details to database
       public function savemt4details(Request $request)
    {
        $mt4=new mt4details;
        $mt4->client_id=Auth::user()->id;
        $mt4->mt4_id= $request['userid'];
        $mt4->mt4_password=  $request['pswrd'];
        $mt4->account_type= $request['acntype'];
        $mt4->currency= $request['currency'];
        $mt4->leverage= $request['leverage'];
        $mt4->server= $request['server'];
        $mt4->duration= $request['duration'];
        $mt4->save();
        return redirect()->back()
        ->with('message', 'MT4 Details Submitted Successfully, Please wait for the system to validate your credentials');
    } 

  

    //Return deposit route
    public function deposits()
    {
    	return view('user.deposits')
        ->with(array(
        'title'=>'Deposits',
        'deposits' => Deposit::where(['user'=>Auth::user()->id])
        ->orderBy('id', 'desc')
        ->get(),
        // 'deposits' => DB::table('deposits')
        //         ->where('user', Auth::user()->id)
        //         ->orderBy('id')
        //         ->get(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    } 

     //Return withdrawals route
     public function withdrawals()
     {
       return view('user.withdrawals')
         ->with(array(
         'title'=>'withdrawals',
         'withdrawals' => Withdrawal::where('user', Auth::user()->id)
         ->orderBy('id', 'desc')
        ->get(),
         'settings' => Settings::where('id', '=', '1')->first(),
         'wmethods' => Wdmethod::where('type', 'withdrawal')
         ->where('status','enabled')->get(),
         ));
     } 
     
     
      //verify PayPal deposits
     public function paypalverify($amount){
      
       $user=User::where('id',Auth::user()->id)->first();
       
      //save and confirm the deposit
        $dp=new Deposit();

        $dp->amount= $amount;
        $dp->payment_mode= "PayPal";
        $dp->status= 'Processed';
        $dp->proof= "Paypal";
        $dp->plan= "0";
        $dp->user= $user->id;
        $dp->save();
    

          //add funds to user's account
        User::where('id',$user->id)
      ->update([
      'account_bal' => $user->account_bal + $amount,
      ]);
        
        //get settings 
        $settings=Settings::where('id', '=', '1')->first();
        $earnings=$settings->referral_commission*$amount/100;

        if(!empty($user->ref_by)){
          //increment the user's referee total clients activated by 1
          Agent::where('agent',$user->ref_by)->increment('total_activated', 1);
          Agent::where('agent',$user->ref_by)->increment('earnings', $earnings);
          
          //add earnings to agent balance
          //get agent
          $agent=User::where('id',$user->ref_by)->first();
          User::where('id',$user->ref_by)
          ->update([
          'account_bal' => $agent->account_bal + $earnings,
          ]);
          
          //credit commission to ancestors
          $deposit_amount = $amount;
          $array=User::all();
          $parent=$user->id;
          $this->getAncestors($array, $deposit_amount, $parent);
          
        }
        
         //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "$user->name, This is to inform you that your deposit of $settings->currency$amount has been received and confirmed.";
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Deposit processed!";
            
        Mail::bcc($user->email)->send(new NewNotification($objDemo));


      //return redirect()->route('deposits')
      //->with('message', 'Deposit Sucessful!');
    }
      

      

    //Main Plans route
    public function mplans()
    {
    	return view('user.mplans')
        ->with(array(
        'title'=>'Main Plans',
        'plans'=> Plans::where('type', 'main')->get(),
        'settings' => Settings::where('id','1')->first(),
        ));
    }
    
    //My Plans route
    public function myplans()
    {
        $plans=User_plans::where('user', Auth::user()->id)->get();
        if(count($plans)<1){
            return redirect()->back()->with('message','You do not have a package at the moment');
        }
        
    	return view('user.myplans')
        ->with(array(
        'title'=>'Your packages',
        'plans'=> User_plans::where('user', Auth::user()->id)->get(),
        'cplan'=> User_plans::where('id', Auth::user()->user_plan)->first(),
        'settings' => Settings::where('id','1')->first(),
        ));
        
        
        
         //fect user
         /*
                        $user=User::where('tele_id',$this->bot->getUser()->getId())->first();
                        //fetch plans
                        $plans=User_plans::where('user',$user->id)->get();
                        $this->say("Your packages:");
                        foreach($plans as $plan){
                        //view packages
                        if($plan->active=="yes"){
                           $status="active"; 
                        }else{
                            $status="Not active"; 
                        }
                        $dplans=Plans::where('id',$plan->plan)->first();
                        //fetch site settings
                        $settings=Settings::where('id','1')->first();

                        $this->say("$dplans->name : $status.  ");
                        }*/
    }

    //Promo Plans route
    public function pplans()
    {
    	return view('pplans')
        ->with(array(
        'title'=>'Promo Plans',
        'plans'=> Plans::where('type', 'promo')->get(),
        'settings' => Settings::where('id','1')->first(),
        ));
    }

     //Jon a plan
     public function joinplan(Request $request){
    //get user
    $user=User::where('id',Auth::user()->id)->first();
    //get plan
    $plan=Plans::where('id',$request['id'])->first();
    
    if(isset($request['iamount']) && $request['iamount']>0){
        $plan_price=$request['iamount'];
    }else{
        $plan_price = $plan->price;
    }
    //check if the user account balance can buy this plan
    if($user->account_bal < $plan_price){
        //redirect to make deposit
        return redirect()->route('deposits')
      ->with('message', 'Your account is insufficient to purchase this plan. Please make a deposit.');
        
    }
  
      if($plan->type=='Main'){
          //debit user
          User::where('id', $user->id)
          ->update([
         'account_bal'=>$user->account_bal-$plan_price,
        ]);
        
        //create history
             Tp_Transaction::create([
              'user' => $user->id,
              'plan' => $plan->name,
              'amount'=>$plan_price,
              'type'=>"Plan purchase",
            ]);
        
          //save user plan
          $userplanid = DB::table('user_plans')->insertGetId(
            [
            'plan' => $plan->id,
            'user' => Auth::user()->id,
            'amount' => $plan_price,
            'active' => 'yes',
            'inv_duration'=>$request['duration'],
            'activated_at' => \Carbon\Carbon::now(),
            'last_growth' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            ]
        );
                   
        User::where('id',Auth::user()->id)
        ->update([
          'plan'=>$plan->id,
          'user_plan' => $userplanid,
          'entered_at'=>\Carbon\Carbon::now(),
        ]);
        
        
      }elseif($plan->type=='Promo'){
        User::where('id',Auth::user()->id)
        ->update([
          'promo_plan'=>$plan->id,
        ]);
      }
      return redirect()->back()
      ->with('message', 'You successfully purchased a plan and your plan is now active.');
    }

   
    //support route
    public function support()
    {
    	return view('user.support')
        ->with(array(
        'title'=>'Support',
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    } 
    
 

   
  
 //Controller self ref issue
public function ref(Request $request, $id){
  if(isset($id)){
  $request->session()->flush();
  if(count(User::where('id',$id)->first())==1){
    $request->session()->put('ref_by', $id);
  }
  return redirect()->route('register');
}
}

  

   

    //return add account form
    public function accountdetails(Request $request){
      return view('user.updateacct')->with(array(
        'title'=>'Update account details',
        'settings' => Settings::where('id', '=', '1')->first()
        ));
    }
    //update account and contact info
    public function updateacct(Request $request){
    
          User::where('id', $request['id'])
          ->update([
          'bank_name' => $request['bank_name'],
          'account_name' =>$request['account_name'], 
          'account_no' =>$request['account_number'], 
          'btc_address' =>$request['btc_address'], 
          'eth_address' =>$request['eth_address'], 
          ]);
          return redirect()->back()
          ->with('message', 'User updated Sucessful');
    }

    //return add change password form
    public function changepassword(Request $request){
      return view('includes.changepassword')->with(array('title'=>'Change Password','settings' => Settings::where('id', '=', '1')->first()));
    }

    //Update Password
    public function updatepass(Request $request){
        if(!password_verify($request['old_password'],$request['current_password']))
        {
          return redirect()->back()
          ->with('message', 'Incorrect Old Password');
        }
        $this->validate($request, [
        'password_confirmation' => 'same:password',
        'password' => 'min:6',
        ]);

          User::where('id', $request['id'])
          ->update([
          'password' => bcrypt($request['password']),
          ]);
          return redirect()->back()
          ->with('message', 'Password Updated Sucessful');
    } 

    public function referuser(){
      return view('includes.referuser')->with(array(
        'title'=>'Refer user',
        'settings' => Settings::where('id', '=', '1')->first()));

    }
    
    
    // pay with coinpayment option
    public function cpay($amount, $coin, $ui, $msg){
     
     return $this->paywithcp($amount, $coin, $ui, $msg);
        
    }
    
    public function autotopup()
    {
        //calculate top up earnings and
        //auto increment earnings after the increment time
          
        //get user plans
        $plans=User_plans::where('active','yes')->get();
        foreach($plans as $plan){
            //get plan
            $dplan=Plans::where('id',$plan->plan)->first();
            //get user
            $user=User::where('id',$plan->user)->first();
            //get settings
            $settings=Settings::where('id','1')->first();
              
              //check if trade mode is on
            if($settings->trade_mode=='on'){
                 //get plan expected return
                 $to_receive=$dplan->expected_return;
                 //know the plan increment interval
                 if($dplan->increment_interval=="Monthly"){
                 $togrow=\Carbon\Carbon::now()->subMonths(1)->toDateTimeString();
                 $dtme = $plan->last_growth->diffInMonths();
               }elseif($dplan->increment_interval=="Weekly"){
                 $togrow=\Carbon\Carbon::now()->subWeeks(1)->toDateTimeString();
                 $dtme = $plan->last_growth->diffInWeeks();
               }elseif($dplan->increment_interval=="Daily"){
                 $togrow=\Carbon\Carbon::now()->subDays(1)->toDateTimeString();
                 $dtme = $plan->last_growth->diffInDays();
               }elseif($dplan->increment_interval=="Hourly"){
                 $togrow=\Carbon\Carbon::now()->subHours(1)->toDateTimeString();
                 $dtme = $plan->last_growth->diffInHours();
               }
               
               //expiration
               if($plan->inv_duration=="One week"){
                 $condition=$plan->activated_at->diffInDays() < 7 && $user->trade_mode=="on";
                 $condition2=$plan->activated_at->diffInDays() >= 7;
               }elseif($plan->inv_duration=="One month"){
                 $condition=$plan->activated_at->diffInDays() < 30 && $user->trade_mode=="on";
                 $condition2=$plan->activated_at->diffInDays() >= 30;
               }elseif($plan->inv_duration=="Three months"){
                 $condition=$plan->activated_at->diffInDays() < 90 && $user->trade_mode=="on";
                 $condition2=$plan->activated_at->diffInDays() >= 90;
               }elseif($plan->inv_duration=="Six months"){
                 $condition=$plan->activated_at->diffInDays() < 180 && $user->trade_mode=="on";
                 $condition2=$plan->activated_at->diffInDays() >= 180;
               }
               elseif($plan->inv_duration=="One year"){
                 $condition=$plan->activated_at->diffInDays() < 360 && $user->trade_mode=="on";
                 $condition2=$plan->activated_at->diffInDays() >= 360;
               }
               
               //calculate increment
               if($dplan->increment_type=="Percentage"){
                 $increment=($plan->amount*$dplan->increment_amount)/100;
               }else{
                 $increment=$dplan->increment_amount;
               }
               
               if($condition){
                  if ($settings->weekend_trade=='true') {
                      if($plan->last_growth <= $togrow){
                        $amt = intval($dtme/1);
                    
                        User::where('id', $plan->user)
                        ->update([
                        'roi' => $user->roi + $increment,
                        'account_bal' => $user->account_bal + $increment,
                        ]);
                        
                        //save to transactions history
                        $th = new Tp_Transaction();
                        $th->plan = $dplan->name;
                        $th->user = $user->id;
                        $th->amount = $increment;
                        $th->type = "ROI";
                        $th->save();
                        
                        User_plans::where('id', $plan->id)
                            ->update([
                            'last_growth' => \Carbon\Carbon::now()
                        ]);
                        
                        //send email notification
                        $objDemo = new \stdClass();
                        $objDemo->receiver_email = $user->email;
                        $objDemo->receiver_plan = $dplan->name;
                        $objDemo->received_amount = "$settings->currency$increment";
                        $objDemo->sender = $settings->site_name;
                        $objDemo->receiver_name = $user->name;
                        $objDemo->date = \Carbon\Carbon::Now();
                    
                        Mail::to($user->email)->send(new NewRoi($objDemo));
                        
                      }
                  } else {

                      $dt = \Carbon\Carbon::Now();

                      if ($dt->isWeekday()) {

                        if($plan->last_growth <= $togrow){
                          $amt = intval($dtme/1);
                      
                          User::where('id', $plan->user)
                          ->update([
                          'roi' => $user->roi + $increment,
                          'account_bal' => $user->account_bal + $increment,
                          ]);
                          
                          //save to transactions history
                          $th = new Tp_Transaction();
                          $th->plan = $dplan->name;
                          $th->user = $user->id;
                          $th->amount = $increment;
                          $th->type = "ROI";
                          $th->save();
                          
                          User_plans::where('id', $plan->id)
                              ->update([
                              'last_growth' => \Carbon\Carbon::now()
                          ]);
                          
                          //send email notification
                          $objDemo = new \stdClass();
                          $objDemo->receiver_email = $user->email;
                          $objDemo->receiver_plan = $dplan->name;
                          $objDemo->received_amount = "$settings->currency$increment";
                          $objDemo->sender = $settings->site_name;
                          $objDemo->receiver_name = $user->name;
                          $objDemo->date = \Carbon\Carbon::Now();
                      
                          Mail::to($user->email)->send(new NewRoi($objDemo));
                          
                        }
                      } elseif ($dt->isWeekend()) {
                      
                      } else{
                      
                      }

                  }
                  
               }
               
               //release capital
               if($condition2){
                   User::where('id', $plan->user)
                       ->update([
                       'account_bal' => $user->account_bal + $plan->amount,
                   ]);
                   
                   //plan expired
                   User_plans::where('id', $plan->id)
                   ->update([
                   'active' => "expired",
                   ]);
                   
                   //save to transactions history
                   $th = new Tp_transaction();
                   
                   $th->plan = $dplan->name;
                   $th->user = $plan->user;
                   $th->amount = $plan->amount;
                   $th->type = "Investment capital";
                   $th->save();
                   
                   //send email notification
                   $objDemo = new \stdClass();
                   $objDemo->receiver_email = $user->email;
                   $objDemo->receiver_plan = $dplan->name;
                   $objDemo->received_amount = "$settings->currency$plan->amount";
                   $objDemo->sender = $settings->site_name;
                   $objDemo->receiver_name = $user->name;
                   $objDemo->date = \Carbon\Carbon::Now();
                   $objDemo->subject = "Investment plan closed";
           
                   Mail::to($user->email)->send(new endplan($objDemo));
               }
                
      
            }
              
        }
        //do auto confirm payments
        return $this->cpaywithcp();
    }
    
    public function checkdate(){
      $dt = \Carbon\Carbon::Now();

      if ($dt->isWeekday()) {
          return "This is a week day";
      } elseif ($dt->isWeekend()) {
          return "Today is Weekend";
      } else{
       
      }
      
    }

    public function getRefs($array, $parent, $level = 0) {
            $referedMembers = '';
            $array=User::all();
            foreach ($array as $entry) {
                if ($entry->ref_by == $parent) {
                   // return "$entry->id <br>";
                    $referedMembers .= '- ' . $entry->name . '<br/>';
                    $referedMembers .= $this->getRefs($array, $entry->id, $level+1);
                    
                    if($level == 1){
                        $referedMembers .="1 <br>";
                    }elseif($level == 2){
                        $referedMembers .="2 <br>";
                    }elseif($level == 3){
                        $referedMembers .="3 <br>";
                    }elseif($level == 4){
                        $referedMembers .="4 <br>";
                    }elseif($level == 5){
                        $referedMembers .="5 <br>";
                    }elseif($level == 0){
                        $referedMembers .="0 <br>";
                    }
                }
            }
            return $referedMembers;
    }
    
    //Get uplines
function getAncestors($array, $deposit_amount, $parent = 0, $level = 0) {
  $referedMembers = '';
  $parent=User::where('id',$parent)->first();
  foreach ($array as $entry) {
    
      if ($entry->id == $parent->ref_by) {
          //get settings 
          $settings=Settings::where('id', '=', '1')->first();
                    
           if($level == 1){
          $earnings=$settings->referral_commission1*$deposit_amount/100;
          //add earnings to ancestor balance
            User::where('id',$entry->id)
            ->update([
            'account_bal' => $entry->account_bal + $earnings,
            'ref_bonus' => $entry->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $entry->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
            
          }elseif($level == 2){
          $earnings=$settings->referral_commission2*$deposit_amount/100;
          //add earnings to ancestor balance
            User::where('id',$entry->id)
            ->update([
            'account_bal' => $entry->account_bal + $earnings,
            'ref_bonus' => $entry->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $entry->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
            
          }elseif($level == 3){
          $earnings=$settings->referral_commission3*$deposit_amount/100;
          //add earnings to ancestor balance
            User::where('id',$entry->id)
            ->update([
            'account_bal' => $entry->account_bal + $earnings,
            'ref_bonus' => $entry->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $entry->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
            
          }elseif($level == 4){
          $earnings=$settings->referral_commission4*$deposit_amount/100;
          //add earnings to ancestor balance
            User::where('id',$entry->id)
            ->update([
            'account_bal' => $entry->account_bal + $earnings,
            'ref_bonus' => $entry->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $entry->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
            
          }elseif($level == 5){
          $earnings=$settings->referral_commission5*$deposit_amount/100;
          //add earnings to ancestor balance
            User::where('id',$entry->id)
            ->update([
            'account_bal' => $entry->account_bal + $earnings,
            'ref_bonus' => $entry->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $entry->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
         
          }

          if($level == 6){
          break;
          }
          
          //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
          $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level+1);
      
       }
  }
  return $referedMembers;
}
function generate_string($input, $strength = 16) {
  $input_length = strlen($input);
  $random_string = '';
  for($i = 0; $i < $strength; $i++) {
      $random_character = $input[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
  }

  return $random_string;
}

}
 