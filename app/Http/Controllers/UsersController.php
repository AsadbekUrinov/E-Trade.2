<?php

namespace App\Http\Controllers;

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
use App\Models\Mt4dDtails;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Cp_transaction;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{ 
    

    public function index()
    {
    $settings=Settings::where('id', '=', '1')->first();
    //   $logoname = $settings->logo;
    //   $favicon = $settings->favicon;

    //   if(($logoname != NULL))
    //     {
    //       if ($settings->location == "AWS S3") {
    //         if (Storage::disk('s3')->exists($logoname)) {
    //           $logourl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    //           $logofile = Storage::disk('s3')->get($logoname);
    //           $src = $logourl.$logofile; 
    //         }
    //       } elseif ($settings->location == "SFTP") {
    //         $logourl = $settings->site_address . '/';
    //         $logofile = Storage::disk('sftp')->get($favicon);
    //         $src = $favurl.$favfile;
    //       }
    //       elseif ($settings->location == "FTP") {
    //         $logourl = $settings->site_address . '/';
    //         $logofile = Storage::disk('ftp')->get($favicon);
    //         $src = $favurl.$favfile;
    //       }else{
    //         $src='';
    //       } 
    //   }else{
    //     $src='';
    //   }

    //   if(($favicon != NULL))
    //   {
    //     if ($settings->location == "AWS S3") {
    //       if (Storage::disk('s3')->exists($favicon)) {
    //         $favurl = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    //         $favfile = Storage::disk('s3')->get($favicon);
    //         $favsrc = $favurl.$favfile;
    //       }
    //     } elseif ($settings->location == "SFTP") {
    //       $favurl = $settings->site_address . '/';
    //       $favfile = Storage::disk('sftp')->get($favicon);
    //       $favsrc = $favurl.$favfile;
    //     }
    //     elseif ($settings->location == "FTP"){
    //       $favurl = $settings->site_address . '/';
    //       $favfile = Storage::disk('ftp')->get($favicon);
    //       $favsrc = $favurl.$favfile;
    //     }else {
    //       $favsrc='';
    //     }
         
    //   }else
    // {
    //   $favsrc='';
    // }
        //sum total deposited
        $total_deposits = DB::table('deposits')->select(DB::raw("SUM(amount) as total"))->
        where('status','Processed')->get();
        
        //sum total withdrawals
        $total_withdrawals = DB::table('withdrawals')->select(DB::raw("SUM(amount) as total"))->
        where('status','Processed')->get();
        
      
        return view('home.index')->with(array(
          'settings' => $settings,
          'total_users' => User::count(),
          'plans' => Plans::all(),
          'total_deposits' => $total_deposits,
          'total_withdrawals' => $total_withdrawals,
          // 'logosrc' => $src,
          // 'favsrc' => $favsrc,
          'faqs'=> Faq::orderby('id', 'desc')->get(),
          'test'=> Testimony::orderby('id', 'desc')->get(),
          'withdrawals' => Withdrawal::orderby('id','DESC')->take(7)->get(),
          'deposits' => Deposit::orderby('id','DESC')->take(7)->get(),
          'title' => $settings->site_title,
          'mplans' => Plans::where('type','Main')->get(),
          'pplans' => Plans::where('type','Promo')->get(),
        ));
    }

    //Licensing and registration route
   public function licensing(){
      
    return view('home.licensing')
    ->with(array(
      'mplans' => Plans::where('type','Main')->get(),
        'pplans' => Plans::where('type','Promo')->get(),
        'title' => 'Licensing, regulation and registration',
      'settings' => Settings::where('id', '=', '1')->first(),
    ));
  }

    //Terms of service route
    public function terms(){
      
      return view('home.terms')
      ->with(array(
        'mplans' => Plans::where('type','Main')->get(),
        'title' => 'Terms of Service',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
    }

    //Privacy policy route
    public function privacy(){
      
      return view('home.privacy')
      ->with(array(
        'mplans' => Plans::where('type','Main')->get(),
           
        'title' => 'Privacy Policy',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
    }

     //FAQ route
     public function faq(){
      
      return view('home.faq')
      ->with(array(
        'mplans' => Plans::where('type','Main')->get(),
            'pplans' => Plans::where('type','Promo')->get(),
           
        'title' => 'FAQs',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
    }

     //about route
     public function about(){
      
      return view('home.about')
      ->with(array(
        'mplans' => Plans::where('type','Main')->get(),
           
        'title' => 'About',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
    }

     //Contact route
     public function contact(){
      
      return view('home.contact')
      ->with(array(
        'mplans' => Plans::where('type','Main')->get(),
            'pplans' => Plans::where('type','Promo')->get(),
           
        'title' => 'Contact',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
    }

    

    //send contact message to admin email
    public function sendcontact(Request $request){

      $settings=Settings::where('id','1')->first();
      
       $objDemo = new \stdClass();
        $objDemo->message = substr(wordwrap($request['message'],70),0,350);
        $objDemo->sender = "$settings->site_name";
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject = "Inquiry from $request->name with email $request->email";
          
        Mail::bcc($settings->contact_email)->send(new NewNotification($objDemo));

      return redirect()->back()
      ->with('message', ' Your message was sent successfully!');
  
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
          'account_number' =>$request['account_no'], 
          'btc_address' =>$request['btc_address'], 
          'eth_address' =>$request['eth_address'], 
          'ltc_address' =>$request['ltc_address'], 
          ]);
          return redirect()->back()
          ->with('message', 'Withdrawal Info updated Sucessfully');
    }

    //return add change password form
    public function changepassword(Request $request){
      return view('user.changepassword')->with(array('title'=>'Change Password','settings' => Settings::where('id', '=', '1')->first()));
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
        'password' => 'min:8',
        ]);

        $request->user()->fill([
          'password' => Hash::make($request->password)
        ])->save();
        
        return redirect()->back()
          ->with('message', 'Password Updated Sucessful');
    } 
  
  
	
	//Make or remove admin
    public function makeadmin(Request $request, $id, $action){
        if($action=="on"){
            $action = "1";
        }elseif($action == "off"){
            $action = "0";
        }else{
            return redirect()-back()->with('message',"Unknown action!");
        }
        
        User::where('id', $id)
        ->update([
        'type' => $action,
        ]);
        return redirect()->back()
        ->with('message', "User type has been changed successful!.");
  }
  
  //Change user email
    public function chngemail(Request $request){
      $user=User::where('id',$request['user_id'])->first();
      User::where('id', $request['user_id'])
          ->update([
          'email'=> $request['email'],
          ]);
          return redirect()->route('manageusers')
          ->with('message', 'Action Successful!');
    }
    

  public function referuser(){
    $array = User::all();
    return view('user.referuser')->with(array(
      'title'=>'Refer Users',
      'team' => User::where('ref_by',0)->get(),
      'settings' => Settings::where('id', '=', '1')->first()));

  }


  //Get downlines level
public function getdownlines($array, $parent = 0, $level = 0) {
  $referedMembers = '';
  foreach ($array as $entry) {
      if ($entry->ref_by == $parent) {
        
        if($level==0){
          $levelQuote= "Direct referral";
        }else{
          $levelQuote= "Indirect referral level $level";
        }

          $referedMembers .= "
          <tr>
          <td> $entry->name $entry->l_name </td> 
          <td> $levelQuote </td>".
          '<td>'. $this->getUserParent($entry->id).'</td>'.
          '<td>'. $this->getUserStatus($entry->id).'</td>
          <td>'. $this->getUserRegDate($entry->id).'</td>
          </tr>';

          $referedMembers .= $this->getdownlines($array, $entry->id, $level+1);
      }

      if($level == 5){
      break;
      }
  }
  return $referedMembers;
}

//Get user Parent
function getUserParent($id) {
  $user = User::where('id',$id)->first();
  $parent = User::where('id',$user->ref_by)->first();
  if($parent){
    return "$parent->name $parent->l_name";
  }else{
  return "null";
  }
}

//Get user status
function getUserStatus($id) {
  $user = User::where('id',$id)->first();

  return $user->status;
}

//Get User Registration Date
function getUserRegDate($id) {
  $user = User::where('id',$id)->first();

  return $user->created_at;
}

//Get User Registration Date
function forgotpassword() {
  return view('auth.forgot-password', [
    'title' => 'Forgot Password',
    'settings' => Settings::where('id', '1')->first(),
  ]);
}

function verifyemail() {
  return view('auth.verify-email', [
    'title' => 'Verify your email address',
    'settings' => Settings::where('id', '1')->first(),
  ]);
}

function twofa() {
  return view('profile.show', [
    'title' => 'Two Factor Authentication',
    'settings' => Settings::where('id', '1')->first(),
  ]);
}

function verifyaccount() {
  return view('user.verify', [
    'title' => 'Verify your Account',
    'settings' => Settings::where('id', '1')->first(),
  ]);
}


    // pay with card option
    public function paywithcard(Request $request, $amount){
      require_once'billing/config.php';
      
      $t_p=$amount*100; //total price in cents

    //session variables for stripe charges
    $request->session()->put('t_p', $t_p);
    $request->session()->put('c_email', Auth::user()->email);
    
    return view('user.payment')->with(array(
        'title'=>'Pay with card',
        't_p' => $t_p,
        'settings' => Settings::where('id', '=', '1')->first()));

    echo'<link href="'.asset('css/bootstrap.css').'" rel="stylesheet">
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="'.asset('js/bootstrap.min.js').'"></script>';
    return('<div style="border:1px solid #f5f5f5; padding:10px; margin:150px; color:#d0d0d0; text-align:center;"><h1>You will be redirected to your payment page!</h1>
    
    <h4 style="color:#222;">Click on the button below to proceed.</h4>

    <form action="charge" method="post">
    <input type="hidden" name="_token" value="'.csrf_token().'">
      <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
          data-key="'.$stripe['publishable_key'].'"
          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
          data-name="'.$set->site_name.'"
          data-description="Account fund"
          data-amount="'.$t_p.'"
          data-locale="auto">
      </script>
    </form>
    </div>

    ');
    }

    //stripe charge customer
    public function charge(Request $request){
      include'billing/charge.php';

  //process deposit and confirm the user's plan
  //confirm the users plan

  User::where('id',Auth::user()->id)
  ->update([
  'confirmed_plan' => Auth::user()->plan,
  'activated_at' => \Carbon\Carbon::now(),
  'last_growth' => \Carbon\Carbon::now(),
  ]);
    //get plan
    $p=Plans::where('id',Auth::user()->plan)->first();
    //get settings 
    $settings=Settings::where('id', '=', '1')->first();
    $earnings=$settings->referral_commission*$up/100;

    if(!empty(Auth::user()->ref_by)){
  //increment the user's referee total clients activated by 1
  Agent::where('agent',Auth::user()->ref_by)->increment('total_activated', 1);
  Agent::where('agent',Auth::user()->ref_by)->increment('earnings', $earnings);
  
  //add earnings to agent balance
          //get agent
          $agent=User::where('id',Auth::user()->ref_by)->first();
          User::where('id',Auth::user()->ref_by)
          ->update([
          'account_bal' => $agent->account_bal + $earnings,
          ]);
          
          //create history
             Tp_Transaction::create([
            'user' => auth::user()->id,
            'plan' => "Credit",
             'amount'=>$earnings,
             'type'=>"Ref_bonus",
            ]);
          
          //credit commission to ancestors
          $deposit_amount = $up;
          $array=User::all();
          $parent=Auth::user()->id;
          $this->getAncestors($array, $deposit_amount, $parent);
    }
  

  //save deposit info
  $dp=new Deposit();

  $dp->amount= $up;
  $dp->payment_mode= 'Credit card';
  $dp->status= 'processed';
  $dp->proof= 'stripe';
  $dp->plan= Auth::user()->plan;
  $dp->user= Auth::user()->id;
  $dp->save();
  
  return redirect()->route('dashboard')->with('message',"Successfully charged $set->currency$up!");

  echo '<h1 style="border:1px solid #f5f5f5; padding:10px; margin:150px; color:#d0d0d0; text-align:center;">Successfully charged '.$set->currency.''.$up.'!<br/>
  <small style="color:#333;">Returning to dashboard</small>
  </h1>';

  //redirect to dashboard after 5 secs
echo'
  <script>
  window.setTimeout(function(){
    window.location.href = "../";
  }, 5000);
  </script>
    ';
  }
  
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
    

}
