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
use App\Models\Mt4Dtails;
use App\Models\Deposit;
use App\Models\Notification;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Models\Cp_transaction;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\DB;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Mail\NewNotification;
use App\Mail\UserUpload;
use App\Mail\KycUpload;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\CPTrait;

class SomeController extends Controller
{
    use CPTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

    
    
   

      //Trading history route
     public function tradinghistory(){
      
      return view('user.thistory')
      ->with(array(
        
        't_history' => Tp_Transaction::where('user',Auth::user()->id)
        ->where('type','ROI')
        ->orderBy('id', 'desc')
        ->get(),
        'title' => 'Trading History',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
  }
  
   //Account transactions history route
     public function accounthistory(){
      
      return view('user.transactions')
      ->with(array(
        
        't_history' => Tp_Transaction::where('user',Auth::user()->id)
        ->where('type','<>','ROI')
        ->orderBy('id', 'desc')
        ->get(),
        'withdrawals' => Withdrawal::where('user', Auth::user()->id)->orderBy('id', 'desc')
        ->get(),
        'deposits' => Deposit::where('user', Auth::user()->id)->orderBy('id', 'desc')
        ->get(),
        'title' => 'Account Transactions History',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
  }
  
  //Notification route
  public function notification(){
      
    return view('user.notification')
    ->with(array(
      'Notif' => Notification::where('user_id',Auth::user()->id)->orderBy('id', 'desc')
             ->paginate(12),
      'title' => 'Notification',
      'settings' => Settings::where('id', '=', '1')->first(),
    ));
}

//Profile route
public function profile(){
  $userinfo = User::where('id',Auth::user()->id)->first();
  return view('user.profile')->with(array(
    'userinfo' => $userinfo,
    'title' => 'Profile',
    'settings' => Settings::where('id', '=', '1')->first(),
  ));
}


//Updating Profile Route
public function updateprofile(Request $request){

    User::where('id', Auth::user()->id)
        ->update([
          'name'=> $request->name,
          'dob'=> $request->dob,
		      'phone'=> $request->phone,
          'address'=> $request->address,
        ]);
    return redirect()->back()
    ->with('message', 'Profile Information Updated Sucessfully!');
    
}

public function delnotif($id){
  Notification::where('id',$id)->delete();
  //$notif =notifcations::where('id',$id)->delete();
  return redirect()->back()
          ->with('message', 'Message Sucessfully Deleted');
}

  //save CoinPayments credentials to DB
        public function updatecpd(Request $request){

          Cp_transaction::where('id', '1')
          ->update([
          'cp_p_key'=>$request['cp_p_key'],
          'cp_pv_key'=>$request['cp_pv_key'],
          'cp_m_id'=>$request['cp_m_id'],
          'cp_ipn_secret'=>$request['cp_ipn_secret'],
          'cp_debug_email'=>$request['cp_debug_email'],
          
          ]);
          return redirect()->back()
          ->with('message', 'Action Sucessful');
    }


  
  //accept KYC route
  public function changetheme(Request $request)
  {
    if(isset($request['style']) and $request['style']=='true'){
      $dashboard_style="dark";
    }else{
      $dashboard_style="light";
    }
      //change dashboard style
    User::where('id', Auth::user()->id)
    ->update([
        'dashboard_style' => $dashboard_style,
        ]);
      return response()->json(['success'=>'Changed']);
      
  }

       //Save verification documents requests
  public function savevdocs(Request $request){

      $this->validate($request, [
      'idcard' => 'mimes:jpg,jpeg,png|max:4000|image',
      'passport' => 'mimes:jpg,jpeg,png|max:4000|image',
      ]);
      
      $settings = Settings::where('id', '=', '1')->first();
      $strtxt = $this->RandomStringGenerator(6);

        if($request->hasfile('idcard'))
         {
          $document1 = $request->file('idcard');
          $filename1 = $document1->getClientOriginalName();
          $ext = array_pop(explode(".", $filename1));
          $whitelist = array('jpeg','jpg','png');

          if (in_array($ext, $whitelist)) {

            if ($settings->location  == "Email") {
              $cardname = $strtxt . $filename1 . time();

             }elseif ($settings->location  == "Local") {
                $cardname = $strtxt . $filename1 . time();
                // save to storage/app/uploads as the new $filename
                $path = $document1->storeAs('public/photos', $cardname);
             }else {
                $cardname = $strtxt . $filename1 . time();
                $filePath = 'storage/' . $cardname;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
             }

          } else {
            return redirect()->back()
            ->with('message', 'Unaccepted ID Card Image Uploaded, try renaming the image file');
          }
            
        } 




        if($request->hasfile('passport'))
         {
          $document2 = $request->file('passport');
          $filename2 = $document2->getClientOriginalName();

          $ext = array_pop(explode(".", $filename2));
          $whitelist = array('jpeg','jpg','png');

          if (in_array($ext, $whitelist)) {

            if ($settings->location  == "Email") {
              $passname = $strtxt . $filename2 . time();
             }elseif ($settings->location  == "Local") {
                $passname = $strtxt . $filename2 . time();
                // save to storage/app/uploads as the new $filename
                $path = $document2->storeAs('public/photos', $passname);
             }else {
                $passname = $strtxt . $filename2 . time();
                $filePaths = 'storage/' . $passname;
                Storage::disk('s3')->put($filePaths, file_get_contents($file));
             }

          } else {
            return redirect()->back()
            ->with('message', 'Unaccepted Passport Image Uploaded, try renaming the image file');
          }
        } 

        if ($settings->location  == "Email") {
          $data = [
            'document' => $document1,
            'document1' => $document2,
          ];
          Mail::to($settings->contact_email)->send(new KycUpload($data));
        }else {
          //send email notification
          $objDemo = new \stdClass();
          $objDemo->message = "This is to inform you of a successfull KYC Document Upload that just occured on your system., please login to review documents.";
          $objDemo->sender = $settings->site_name;
          $objDemo->date = \Carbon\Carbon::Now();
          $objDemo->subject ="Successful Deposit";
          Mail::bcc($settings->contact_email)->send(new NewNotification($objDemo));
        }


    //update user
    User::where('id',Auth::user()->id)
    ->update([
        'id_card' => $cardname,
        'passport' => $passname,
        'account_verify' => 'Under review',
        ]);

  return redirect()->back()
  ->with('message', 'Action Sucessful! Please wait for system to validate your submission.');
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

    //Return payment page
    public function deposit(Request $request){

      $settings = Settings::where('id', '1')->first();
      $secretkey = $settings->s_s_k;
      $publickey = $settings->s_p_k;

     // return $secretkey;

      $zero = '00';
      $amt = $request->amount.$zero;
      //return  $amt;

      \Stripe\Stripe::setApiKey($secretkey);

      $paymentIntent  = \Stripe\PaymentIntent::create([

        'amount' => $amt,
        'currency' => 'usd',
        'payment_method_types' => ['card'],
        // Verify your integration in this guide by including this parameter
        'metadata' => ['integration_check' => 'accept_a_payment'],
      ]);
      
      $output = [
        'publishableKey' => $publickey,
        'clientSecret' => $paymentIntent->client_secret,
      ];
      
  
      $client_secret = $paymentIntent->client_secret;
      //return $client_secret;


      //store payment info in session
      $request->session()->put('amount', $request['amount']);
      $request->session()->put('payment_mode', $request['payment_mode']);
      $request->session()->put('intent', $client_secret);
      
      if(isset($request['pay_type'])){
      $request->session()->put('pay_type', $request['pay_type']);
      $request->session()->put('plan_id', $request['plan_id']);
      }

      return redirect()->route('payment')
      ->with(array(
        'title' => 'Make deposit',
        'settings' => Settings::where('id', '=', '1')->first(),
      ));
  }

   //payment route
   public function payment(Request $request){

    return view('user.payment')
    ->with(array(
      'amount'=>$request->session()->get('amount'),
      'payment_mode'=>$request->session()->get('payment_mode'),
      'pay_type' => $request->session()->get('pay_type'),
      'plan_id' => $request->session()->get('plan_id'),
      'intent' => $request->session()->get('intent'),
      'title' => 'Make deposit',
      'settings' => Settings::where('id', '=', '1')->first(),
    ));
}

  //Save deposit requests
  public function savedeposit(Request $request){

      $this->validate($request, [
      'proof' => 'image|mimes:jpg,jpeg,png|max:500',
      ]);
        
        $settings = Settings::where('id', '=', '1')->first();

        $strtxt = $this->RandomStringGenerator(6);

        if($request->hasfile('proof'))
         {
          $file = $request->file('proof');
          $name = $file->getClientOriginalName();

          $ext = array_pop(explode(".", $name));
          $whitelist = array('jpeg','jpg','png');
              
          if (in_array($ext, $whitelist)) {

            if ($settings->location  == "Email") {
              $proofname = $strtxt . $name . time();
                $data = [
                  'document' => $file
                ];
                Mail::to($settings->contact_email)->send(new UserUpload($data));
    
             }elseif ($settings->location  == "Local") {
                $proofname = $strtxt . $name . time();
                // save to storage/app/uploads as the new $filename
                $path = $file->storeAs('public/photos', $proofname);
             }else {
                $filePath = 'storage/' . $name;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
             }

          } else {
            return redirect()->back()
            ->with('message', 'Unaccepted Image Uploaded');
          }

        }else { 
          //get user
          $user=User::where('id',Auth::user()->id)->first();
        
          //send email notification
          $objDemo = new \stdClass();
          $objDemo->message = "This is to inform you of a successfull Deposit of $settings->currency $request->amount, that just occured on your system. please login to review this changes";
          $objDemo->sender = $settings->site_name;
          $objDemo->date = \Carbon\Carbon::Now();
          $objDemo->subject ="Successful Deposit";
          Mail::bcc($settings->contact_email)->send(new NewNotification($objDemo));
        }

        //end screenshot process
        if($request['pay_type']=='plandeposit'){
          //add the user to this plan for approval
          User::where('id',Auth::user()->id)
          ->update([
            'plan'=> $request['plan_id'],
          ]);
          $plan=$request['plan_id'];
        }elseif($request['pay_type'] == 'Subscription Trading'){
          $plan="Subscription Trading";
        }
        else{
          $plan=Auth::user()->plan;
        }
    

    $dp=new Deposit();
    $dp->amount= $request['amount'];
    $dp->payment_mode= $request['payment_mode'];
    $dp->status= 'Pending';
    $dp->plan= $plan;
    $dp->proof = $proofname;
    $dp->user= Auth::user()->id;
    $dp->save();
 
    // Kill the session variables
    $request->session()->forget('plan_id');
    $request->session()->forget('pay_type');
    $request->session()->forget('payment_mode');
    $request->session()->forget('amount');

  return redirect()->route('deposits')
  ->with('message', 'Action Sucessful! Please wait for system to validate this transaction.');
}

    //Save withdrawal requests
     public function withdrawal(Request $request){
            //get settings
            $settings=Settings::where('id','1')->first();
            
             if($settings->enable_kyc =="yes"){
                if(Auth::user()->account_verify != "Verified"){
                    return redirect()->back()->with('message','Your account must be verified before you can make withdrawal.');
                }
             }
            
            $method=Wdmethod::where('id',$request['method_id'])->first();
            $charges_percentage = $request['amount'] * $method->charges_percentage/100;
            $to_withdraw = $request['amount'] + $charges_percentage + $method->charges_fixed;
            //return if amount is lesser than method minimum withdrawal amount
            

            if(Auth::user()->account_bal < $to_withdraw){
               return redirect()->back()
            ->with('message', 'Sorry, your account balance is insufficient for this request.'); 
            }
            
            if($request['amount'] < $method->minimum){
               return redirect()->back()
            ->with("message", "Sorry, The minimum amount is $settings->currency$method->minimum."); 
            }
            
            //get user last investment package
            $last_user_plan=User_plans::where('user',Auth::user()->id)
            ->where('active','yes')
            ->orderby('activated_at','ASC')->first();
            
          //get user
         $user=User::where('id',Auth::user()->id)->first();
         
         $amount= $request['amount'];
         $ui = $user->id;

         if(empty($user->btc_address) && empty($user->ltc_address) && empty($user->eth_address) && empty($user->account_number)){
          return redirect()->route('acountdetails')
          ->with('message', 'You must set up your coins wallet address before you can withdraw.');
        }
         
         if($request['payment_mode']=='Bitcoin'){
            if(empty($user->btc_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Bitcoin";
          $coin="BTC"; 
          $wallet=$user->btc_address;
          //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }elseif($request['payment_mode']=='Ethereum'){
            if(empty($user->eth_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Ethereum";
          $coin="ETH"; 
          $wallet=$user->eth_address;
          //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }elseif($request['payment_mode']=='Litecoin'){
            if(empty($user->ltc_address)){
                return redirect()->route('acountdetails')
                ->with('message', 'You must set up your coins wallet address before you can withdraw.');
            }
          $payment_mode = "Litecoin";
          $coin="LTC";  
          $wallet=$user->ltc_address;
          //create transaction
        //create auto transaction
          if($settings->withdrawal_option =="auto"){
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
          }
         }else{
             $payment_mode = "Bank transfer";
         }

         //debit user
         User::where('id',$user->id)
          ->update([
           'account_bal' => $user->account_bal-$to_withdraw,
          ]);
      
        //send notification
        $settings=Settings::where('id', '=', '1')->first();
        //send email notification
        $objDemo = new \stdClass();
        $objDemo->message = "This is to inform you that you a user have successfully made a withdrawal request of $settings->currency$amount, kindly login to your account and review and take neccesary action.";
        $objDemo->sender = $settings->site_name;
        $objDemo->date = \Carbon\Carbon::Now();
        $objDemo->subject ="Successful withdrawal";
            
        Mail::bcc($settings->contact_email)->send(new NewNotification($objDemo));

        //save withdrawal info
        $dp=new Withdrawal();
        //$dp->txn_id= $txn_id;         
        $dp->amount= $amount;
        $dp->to_deduct= $to_withdraw;
        $dp->payment_mode= "$payment_mode";
        $dp->status= 'Pending';
        $dp->user= $user->id;
        
        $dp->save();  
        
        return redirect()->back()
      ->with('message', 'Action Sucessful! Please wait for system to process your request.');
      
        
    }

}
