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
//use App\Models\markets;
use App\Models\Mt4dDtails;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Cp_transaction;
use App\Models\Tp_Transaction;
use App\Models\Notification;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;

use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class LogicController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CPTrait;


     //Add plan requests
     public function addplan(Request $request){
       
        $plan=new Plans();
  
        $plan->name= $request['name'];
        $plan->price= $request['price'];
        $plan->min_price= $request['min_price'];
        $plan->max_price= $request['max_price'];
        $plan->minr=$request['minr'];
        $plan->maxr=$request['maxr'];
        $plan->gift=$request['gift'];
        $plan->expected_return= $request['return'];
        $plan->increment_type= $request['t_type'];
        $plan->increment_interval= $request['t_interval'];
        $plan->increment_amount= $request['t_amount'];
        $plan->expiration= $request['expiration'];
        $plan->type= 'Main';
        $plan->save();
      return redirect()->back()
      ->with('message', 'Plan created Sucessfully!');
    }


    //Update plans
    public function updateplan(Request $request){
        Plans::where('id', $request['id'])
        ->update([
        'name' => $request['name'],
        'price' => $request['price'],
        'min_price' => $request['min_price'],
        'max_price' => $request['max_price'],
        'minr' => $request['minr'],
        'maxr' => $request['maxr'],
        'gift' => $request['gift'],
        'expected_return' => $request['return'],
        'increment_type' => $request['t_type'],
        'increment_amount' => $request['t_amount'],
        'increment_interval' => $request['t_interval'],
        'type' => 'Main',
        'expiration' => $request['expiration'],
        ]);
        return redirect()->back()
        ->with('message', 'Plan Update Sucessful!');
      }

          //top up route
    public function topup(Request $request){

        $user = User::where('id', $request->user_id)->first();
        $userdpo = Deposit::where('user', $request['user_id'])->first();

        $user_bal=$user->account_bal;
        $user_bonus=$user->bonus;
        $user_roi=$user->roi;
        $user_Ref=$user->ref_bonus;
        $user_deposit = $userdpo->amount;
  
        if($request['t_type']=="Credit") {
          if ($request['type']=="Bonus") {
            User::where('id', $request['user_id'])
              ->update([
              'bonus'=> $user_bonus + $request['amount'],
              'account_bal'=> $user_bal + $request->amount,
              ]);
          }elseif ($request['type']=="Profit") {
            User::where('id', $request->user_id)
              ->update([
                'roi'=> $user_roi + $request->amount,
                'account_bal'=> $user_bal + $request->amount,
              ]);
          }elseif($request['type']=="Ref_Bonus"){
            User::where('id', $request->user_id)
              ->update([
                'ref_bonus'=> $user_Ref + $request->amount,
                'account_bal'=> $user_bal + $request->amount,
              ]);
          }elseif ($request['type']=="Deposit") {
            $dp=new Deposit();
            $dp->amount= $request['amount'];
            $dp->payment_mode= 'Express Deposit';
            $dp->status= 'Processed';
            $dp->plan= $request['user_pln'];
            $dp->user= $request['user_id'];
            $dp->save();

            User::where('id', $request['user_id'])
              ->update([
                'account_bal'=> $user_bal + $request->amount,
              ]);
          }
          
          //add history
         Tp_Transaction::create([
        'user' => $request->user_id,
        'plan' => "Credit",
         'amount'=>$request->amount,
         'type'=>$request->type,
        ]);
        
        }elseif($request['t_type']=="Debit") {
          if ($request['type']=="Bonus") {
            User::where('id', $request['user_id'])
              ->update([
              'bonus'=> $user_bonus - $request['amount'],
              'account_bal'=> $user_bal - $request->amount,
              ]);
          }elseif ($request['type']=="Profit") {
              User::where('id', $request->user_id)
                ->update([
                  'roi'=> $user_roi - $request->amount,
                  'account_bal'=> $user_bal - $request->amount,
                ]);
            }elseif($request['type']=="Ref_Bonus"){
              User::where('id', $request->user_id)
                ->update([
                  'Ref_Bonus'=> $user_Ref - $request->amount,
                  'account_bal'=> $user_bal - $request->amount,
                ]);
            }
            
             //add history
         Tp_Transaction::create([
        'user' => $request->user_id,
        'plan' => "Credit reversal",
         'amount'=>$request->amount,
         'type'=>$request->type,
        ]);
        
        }
            return redirect()->route('manageusers')
            ->with('message', 'Action Successful!');
      }


      // Send Mail to all users
      public function sendmailtoall(Request $request){
        $settings=Settings::where('id', '=', '1')->first();
        
        //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = $request['message'];
        $objDemo->sender = $settings->site_name;
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject ="$settings->site_name Notification";
            
        Mail::bcc(User::all())->send(new NewNotification($objDemo));
        
        return redirect()->back()->with('message','Your message was sent successful!');
    }

    //Send mail to one user
    public function sendmailtooneuser(Request $request){
        $settings=Settings::where('id', '=', '1')->first();
        $notif = Notification::create([
          'user_id' => $request->user_id,
           'message' => $request->message,
          ]);
        //send email notification
        $mailduser=User::where('id',$request->user_id)->first();
        $objDemo = new \stdClass();
        $objDemo->message = $request['message'];
        $objDemo->sender = $settings->site_name;
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject ="$settings->site_name Notification";
       
        Mail::bcc($mailduser->email)->send(new NewNotification($objDemo));
        return redirect()->back()->with('message','Your message was sent successful!');
  
    } 
    
    
    //Manually Add Trading History to Users Route
    public function addHistory(Request $request)
    {
      $history = Tp_Transaction::create([
        'user' => $request->user_id,
         'plan' => $request->plan,
         'amount'=>$request->amount,
         'type'=>$request->type,
        ]);
        $user=User::where('id', $request->user_id)->first();
        $user_bal=$user->account_bal;
        if (isset($request['amount'])>0) {
            User::where('id', $request->user_id)
            ->update([
            'account_bal'=> $user_bal + $request->amount,
            ]);
        }
        $user_roi=$user->roi;
        if ( isset($request['type'])=="ROI") {
          User::where('id', $request->user_id)
            ->update([
            'roi'=> $user_roi + $request->amount,
            ]);
        }

        return redirect()->back()
      ->with('message', 'Action Sucessful!');
    }

    //update users info
    public function edituser(Request $request){
    
        User::where('id', $request['user_id'])
        ->update([
        'name' => $request['name'],
        'email' =>$request['email'], 
        'phone' =>$request['phone'], 
        'ref_link' =>$request['ref_link'], 
        ]);
        return redirect()->back()
        ->with('message', 'User updated Successful!');
  }

        //Reset Password
        public function resetpswd(Request $request, $id){
            User::where('id', $id)
            ->update([
            'password' => Hash::make('user01236'),
            ]);
            return redirect()->route('manageusers')
            ->with('message', 'Password has been reset to default');
        } 
        //Access users account
        public function switchuser(Request $request, $id){
            $user = User::where('id',$id)->first();
            $settings=Settings::where("id","1")->first();
            //Byeppass 2FA
            $user->token_2fa_expiry = \Carbon\Carbon::now()->addMinutes(15)->toDateTimeString();
            $user->save();
            Auth::loginUsingId($user->id, true);
            return redirect()->route('dashboard')
            ->with('message', "You are logged in as $user->name !");
    } 

    
      //Clear user Account
      public function clearacct(Request $request, $id){

        $deposits=Deposit::where('user',$id)->get();
        if(!empty($deposits)){
            foreach($deposits as $deposit){
                Deposit::where('id', $deposit->id)->delete();
            }
        }

        $withdrawals=Withdrawal::where('user',$id)->get();
        if(!empty($withdrawals)){
            foreach($withdrawals as $withdrawals){
                Withdrawal::where('id', $withdrawals->id)->delete();
            }
        }

        User::where('id', $id)
        ->update([
        'account_bal' => '0',
        'roi' => '0',
        'bonus' => '0',
        'ref_bonus' => '0',
        ]);
        return redirect()->route('manageusers')
        ->with('message', 'Account cleared to $0.00');
      }

        //Delete deposit
        public function deldeposit(Request $request, $id){
            Deposit::where('id', $id)->delete();
            return redirect()->back()
            ->with('message', 'Deposit history has been deleted!');
        }

          //process deposits
     public function pdeposit($id){
      
        //confirm the users plan
        $deposit=Deposit::where('id',$id)->first();
        $user=User::where('id',$deposit->user)->first();
        if($deposit->user==$user->id){
            //add funds to user's account
          User::where('id',$user->id)
        ->update([
        'account_bal' => $user->account_bal + $deposit->amount,
        
        ]);
          
          //get settings 
          $settings=Settings::where('id', '=', '1')->first();
          $earnings=$settings->referral_commission*$deposit->amount/100;
  
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
            'ref_bonus' => $agent->ref_bonus + $earnings,
            ]);
            
            //create history
             Tp_Transaction::create([
            'user' => $user->ref_by,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
            
            //credit commission to ancestors
            $deposit_amount = $deposit->amount;
            $array=User::all();
            $parent=$user->id;
            $this->getAncestors($array, $deposit_amount, $parent);
          }

           //send email notification
          $objDemo = new \stdClass();
          $objDemo->message = "$user->name, This is to inform you that your deposit of $settings->currency$deposit->amount has been received and confirmed.";
          $objDemo->sender = "$settings->site_name";
          $objDemo->date = \Carbon\Carbon::Now();
          $objDemo->subject = "Deposit processed!";
              
          //Mail::bcc($user->email)->send(new NewNotification($objDemo));
      
        }
  
        //update deposits
        Deposit::where('id',$id)
        ->update([
        'status' => 'Processed',
        ]);
        return redirect()->back()
        ->with('message', 'Action Sucessful!');
      }
  
       //process withdrawals
       public function pwithdrawal($id){
  
        $withdrawal=Withdrawal::where('id',$id)->first();
        $user=User::where('id',$withdrawal->user)->first();
        //if($withdrawal->user==$user->id){
          //debit the processed amount
          //User::where('id',$user->id)
        //->update([
        //'account_bal' => $user->account_bal-$withdrawal->to_deduct,
        //]);
        //}
        Withdrawal::where('id',$id)
        ->update([
        'status' => 'Processed',
        ]);
        
        $settings=Settings::where('id', '=', '1')->first();
          //send email notification
          $objDemo = new \stdClass();
          $objDemo->message = "This is to inform you that your withdrawal request of $settings->currency$withdrawal->amount have approved and funds have been sent to your selected account";
          $objDemo->sender = $settings->site_name;
          $objDemo->subject ="Successful withdrawal";
          $objDemo->date = \Carbon\Carbon::Now();
              
        Mail::bcc($user->email)->send(new NewNotification($objDemo));
        return redirect()->back()
        ->with('message', 'Action Sucessful!');
        }

         //process withdrawals
       public function rejectwithdrawal(Request $request){
  
        $withdrawal=Withdrawal::where('id',$request->id)->first();
        $user=User::where('id',$withdrawal->user)->first();
        if($withdrawal->user==$user->id){
          //debit the processed amount
            User::where('id',$user->id)
          ->update([
          'account_bal' => $user->account_bal+$withdrawal->to_deduct,
          ]);
        }
        
        $settings=Settings::where('id', '=', '1')->first();
          //send email notification
          $objDemo = new \stdClass();
          $objDemo->message = "$request->reason";
          $objDemo->sender = $settings->site_name;
          $objDemo->subject ="Rejected Withdrawal Request";
          $objDemo->date = \Carbon\Carbon::Now();
              
          Mail::bcc($user->email)->send(new NewNotification($objDemo));

          Withdrawal::where('id',$request->id)->delete();

          return redirect()->back()
          ->with('message', 'Withdrawal Request Canceled!');
        }
  
  
       //Trash Plans route
       public function trashplan($id)
       {
        //remove users from the plan before deleting
        $users=User::where('confirmed_plan',$id)->get();
        foreach($users as $user){
          User::where('id',$user->id)
          ->update([
              'plan' => 0,
              'confirmed_plan' => 0,
          ]);  
        }
        Plans::where('id',$id)->delete();
        return redirect()->back()
        ->with('message', 'Investment Plan deleted Successfully!');
       }
  
       
    public function delagent(Request $request, $id){
        //delete the user from agent model if exists
         $agent=Agent::where('id',$id)->first();
         
        if(!empty($agent)){
            Agent::where('id', $agent->id)->delete();
        }
        return redirect()->back()
        ->with('message', "Action successful!.");
  }
    
    
    //Add agent
  public function addagent(Request $request){
    
    //get agent if exists
   $ag = Agent::where('agent',$request['user'])->first();
          //check if the agent already exists
          if(count($ag)>0){
            //update the agent info
            Agent::where('id',$ag->id)->increment('total_refered', $request['referred_users']);
          }
          else{
            //add the referee to the agents model

          $agent_id = DB::table('agents')->insertGetId(
            [
              'agent' => $request['user'],
              'created_at' => \Carbon\Carbon::now(),
              'updated_at' => \Carbon\Carbon::now(),
            ]
           );
          //increment refered clients by 1
          Agent::where('id',$agent_id)->increment('total_refered', $request['referred_users']);
            }
    
    return redirect()->route('agents')
    ->with('message', 'action successful!');
  }
   

  //Notification
//   public function notification(Request $request){

//     return view('notification')->with(array('title'=>'Notification','settings' => Settings::where('id', '=', '1')->first()));
// }

  //Delete user
  public function delsystemuser(Request $request, $id){
    //delete the user's withdrawals and deposits
    $deposits=Deposit::where('user',$id)->get();
    if(!empty($deposits)){
        foreach($deposits as $deposit){
            Deposit::where('id', $deposit->id)->delete();
        }
    }
    $withdrawals=Withdrawal::where('user',$id)->get();
    if(!empty($withdrawals)){
        foreach($withdrawals as $withdrawals){
            Withdrawal::where('id', $withdrawals->id)->delete();
        }
    }
    //delete the user plans
    $userp=User_plans::where('user',$id)->get();
    if(!empty($userp)){
        foreach($userp as $p){
            //delete plans that their owner does not exist 
        User_plans::where('id',$p->id)->delete();
        }
    }
    //delete the user from agent model if exists
     $agent=Agent::where('agent',$id)->first();
    if(!empty($agent)){
        Agent::where('id', $agent->id)->delete();
    }
    User::where('id', $id)->delete();
    return redirect()->route('manageusers')
    ->with('message', 'User has been deleted!');
  }  

  

  public function confirmsub($id){
    //get the sub details
    $sub = Mt4Details::where('id',$id)->first();
    //get user
    $user = User::where('id',$sub->client_id)->first();

    if($sub->duration == 'Monthly'){
      $end_at = \Carbon\Carbon::now()->addMonths(1)->toDateTimeString();
    }elseif($sub->duration == 'Quaterly'){
      $end_at = \Carbon\Carbon::now()->addMonths(4)->toDateTimeString();
    }elseif($sub->duration == 'Yearly'){
      $end_at = \Carbon\Carbon::now()->addYears(1)->toDateTimeString();
    }
    Mt4Details::where('id',$id)->update([
      'start_date' => \Carbon\Carbon::now(),
      'end_date' => $end_at,
      'status' => "Active",
    ]);

    $settings = Settings::where('id', '=', '1')->first();
    //notify the client via email
    $objDemo = new \stdClass();
    $objDemo->message = "$user->name, This is to inform you that your trading account management
    request has been reviewed and processed. Thank you for trusting $settings->site_name";
    $objDemo->sender = "$settings->site_name";
    $objDemo->date = \Carbon\Carbon::Now();
    $objDemo->subject = "Managed Account Started!";
        
    //Mail::bcc($user->email)->send(new NewNotification($objDemo));

    return redirect()->back()
            ->with('message', 'Subscription Sucessfully started!');
  }

  public function delsub($id){
    Mt4Details::where('id',$id)->delete();
    return redirect()->back()
            ->with('message', 'Subscription Sucessfully Deleted');
  }

  public function saveuser(Request $request){

    $this->validate($request, [
    'name' => 'required|max:255',
    'email' => 'required|email|max:255|unique:users',
    'password' => 'required|min:8|confirmed',
    'Answer' => 'same:Captcha_Result',
    ]);


    $thisid = DB::table('users')->insertGetId( 
      [
        'name'=>$request['name'],
        'email'=>$request['email'],
        'phone'=>$request['phone'],
        'ref_by'=>Auth::user()->id,
        'password' => Hash::make($request->password),
        'created_at'=>\Carbon\Carbon::now(),
        'updated_at'=>\Carbon\Carbon::now(),
      ]
     ); 
     
     
     //assign referal link to user
      $settings=Settings::where('id', '=', '1')->first();

      User::where('id', $thisid)
        ->update([
        'ref_link' => $settings->site_address.'/ref/'.$thisid,
        ]);
      return redirect()->back()
      ->with('message', 'User Registered Sucessful!');
}

public function saveadmin(Request $request){

    $this->validate($request, [
    'fname' => 'required|max:255',
    'l_name' => 'required|max:255',
    'email' => 'required|email|max:255|unique:admins',
    'password' => 'required|min:8|confirmed',
    ]);


    $thisid = DB::table('admins')->insertGetId( 
      [
        'firstName'=>$request['fname'],
        'lastName'=>$request['l_name'],
        'email'=>$request['email'],
        'phone'=>$request['phone'],
        'type'=>$request['type'],
        'acnt_type_active'=>"active",
        'status'=>"active",
        'dashboard_style'=> "dark",
        'password'=> Hash::make($request['password']),
        'created_at'=>\Carbon\Carbon::now(),
        'updated_at'=>\Carbon\Carbon::now(),
      ]
     );
      return redirect()->back()
      ->with('message', 'Manager added Sucessfull!y');
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

// for front end content management
function RandomStringGenerator($n) 
      { 
          $generated_string = ""; 
          $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"; 
          $len = strlen($domain); 
          for ($i = 0; $i < $n; $i++) 
          { 
              $index = rand(0, $len - 1); 
              $generated_string = $generated_string . $domain[$index]; 
          } 
          // Return the random generated string 
          return $generated_string; 
      } 
       
    public function savefaq(Request $request){

      $String = $this->RandomStringGenerator(6);

      $faq=new Faq();
      $faq->ref_key = $String;
      $faq->question= $request['question'];
      $faq->answer= $request['answer'];
      $faq->save();
      return redirect()->back()
      ->with('message', 'Faq Added Sucessfully!');
    }

    public function savetestimony(Request $request){
      $String = $this->RandomStringGenerator(6);
      $tes=new Testimony();
      $tes->name= $request['testifier'];
      $tes->ref_key = $String;
      $tes->position= $request['position'];
      $tes->what_is_said= $request['said'];
      $tes->picture= $request['picture'];
      $tes->save();
      return redirect()->back()
      ->with('message', 'Testimony Added Sucessfully!');
    }


    public function saveimg(Request $request){
      $settings = Settings::where('id', '=', '1')->first();
      $String = $this->RandomStringGenerator(6);

      $this->validate($request, [
        'image' => 'required|mimes:jpg,jpeg,png|image',
        ]);
      
        if($request->hasfile('image'))
        {
          $filef = $request->file('image');
          $namef = $String . $filef->getClientOriginalName() . time();
          // save to storage/app/uploads as the new $filename
          $path = $filef->storeAs('public/photos', $namef);
        }

        $img=new Images();
        $img->title= $request['img_title'];
        $img->ref_key = $String;
        $img->description= $request['img_desc'];
        $img->img_path= $namef;
        $img->save();
        return redirect()->back()
        ->with('message', 'Image Added Sucessfully!');
    }


    public function savecontents(Request $request){
      $String = $this->RandomStringGenerator(6);
      $cont=new Content();
      $cont->title= $request['title'];
      $cont->ref_key = $String;
      $cont->description= $request['content'];
      $cont->save();
      return redirect()->back()
      ->with('message', 'Contents Added Sucessfully!');
    }

    public function updatefaq(Request $request){
      Faq::where('id', $request['id'])
      ->update([
      'question' => $request['question'],
      'answer' => $request['answer'],
      ]);
      return redirect()->back()
      ->with('message', 'Faq Update Sucessful!');
    }

    public function updatetestimony(Request $request){
      Testimony::where('id', $request['id'])
      ->update([
      'name'=>$request['testifier'],
      'position'=> $request['position'],
      'what_is_said'=> $request['said'],
      'picture'=> $request['picture'],
      ]);
      return redirect()->back()
      ->with('message', 'Testimony Update Sucessful!');
    }

    public function updatecontents(Request $request){
      Content::where('id', $request['id'])
      ->update([
      'title'=> $request['title'],
      'description'=> $request['content'],
      ]);
      return redirect()->back()
      ->with('message', 'Content Update Sucessful!');
    }

    public function updateimg(Request $request){
    $settings = Settings::where('id', '=', '1')->first();
      $this->validate($request, [
        'image' => 'mimes:jpg,jpeg,png|image',
        ]);
      
        $imgs = Images::where('id', '=', $request->id)->first();
        $String = $this->RandomStringGenerator(6);

        if(empty($request->file('image'))){
          $filePathf=$imgs->img_path;
        }else{
          if($request->hasfile('image'))
            {
              $filef = $request->file('image');
              $namef = $String . $filef->getClientOriginalName() . time();
              // save to storage/app/uploads as the new $filename
              $path = $filef->storeAs('public/photos', $namef);
          }
        }

      Images::where('id', $request['id'])
      ->update([
      'title'=> $request['img_title'],
      'description'=> $request['img_desc'],
      'img_path'=> $namef,
      ]);
      return redirect()->back()
      ->with('message', 'Image Updated Sucessfully!');
    }

    public function delfaq($id){
      Faq::where('id',$id)->delete();
      return redirect()->back()
              ->with('message', 'Faq Sucessfully Deleted');
    }

    public function deltest($id){
      Testimony::where('id',$id)->delete();
      return redirect()->back()
              ->with('message', 'Testimonial Sucessfully Deleted');
    }
    

   
}
