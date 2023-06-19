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
use Illuminate\Support\Facades\Storage;
//use App\account;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Traits\CPTrait;

use App\Mail\NewNotification;
use App\Mail\newroi;
use App\Mail\endplan;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, CPTrait;

    
    public function updatewebinfo(Request $request){
    
      $this->validate($request, [
        'logo' => 'mimes:jpg,jpeg,png|max:500|image',
        'favicon' => 'mimes:jpg,jpeg,png|max:500|image',
        ]);

      $settings = Settings::where('id', '=', '1')->first();
      $strtxt = $this->RandomStringGenerator(6);

      if($request->hasfile('logo'))
         {
          $file = $request->file('logo');
          $logoname = $strtxt . $file->getClientOriginalName() . time();
          // save to storage/app/uploads as the new $filename
          $path = $file->storeAs('public/photos', $logoname);
          
      } else {
        $logoname = $settings->logo;
      }

      if($request->hasfile('favicon'))
         {
          $favfile = $request->file('favicon');
          $favname = $strtxt . $favfile->getClientOriginalName() . time();
          // save to storage/app/uploads as the new $filename
          $pathfav = $favfile->storeAs('public/photos', $favname);
          
      }else {
        $favname = $settings->favicon;
      }

        Settings::where('id', $request['id'])
        ->update([
        'newupdate'=>$request['update'],
        'site_name'=>$request['site_name'],
        'description'=>$request['description'],
        'keywords'=>$request['keywords'],
        'site_title'=>$request['site_title'],
        'logo'=>$logoname,
        'favicon'=>$favname,
        'tawk_to'=>strip_tags($request['tawk_to']),
        'site_address'=>$request['site_address'],
        ]);
        return redirect()->back()
        ->with('message', 'Action Sucessful');
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

  public function updatepreference(Request $request){

    if(isset($request['trade_mode']) and $request['trade_mode']=='on'){
      $trade_mode="on";
    }else{
      $trade_mode="off";
    }

    if(isset($request['annouc']) and $request['annouc']=='on'){
      $annouc="on";
    }else{
      $annouc="off";
    }

    if(isset($request['googlet']) and $request['googlet']=='on'){
      $googlet="on";
    }else{
      $googlet="off";
    }
    
    
    if(isset($request['enable_kyc']) and $request['enable_kyc']=='yes'){
      $enable_kyc="yes";
    }else{
      $enable_kyc="no";
    }

    if(isset($request['weekend_trade']) and $request['weekend_trade']=='true'){
      $weekend_trade="true";
    }else{
      $weekend_trade="false";
    }

    if(isset($request['withdraw']) and $request['withdraw']=='true'){
      $withdraw="true";
    }else{
      $withdraw="false";
    }

    Settings::where('id', $request['id'])
        ->update([
        'contact_email'=>$request['contact_email'],
        'currency'=>$request['currency'],
        's_currency'=>$request['s_currency'],
        'site_preference'=>$request['site_preference'],
        'weekend_trade'=>$weekend_trade,
        'location'=> $request['location'],
        'trade_mode'=>$trade_mode,
        'google_translate'=>$googlet,
        'enable_kyc'=>$enable_kyc,
        'enable_with' => $withdraw,
        'enable_annoc'=>$annouc,
        ]);
        return redirect()->back()
        ->with('message', 'Action Sucessful');
  }


  public function updatebotswt(Request $request){
    
    Settings::where('id', $request['id'])
        ->update([
        'referral_commission'=>$request['ref_commission'],
        'referral_commission1'=>$request['ref_commission1'],
        'referral_commission2'=>$request['ref_commission2'],
        'referral_commission3'=>$request['ref_commission3'],
        'referral_commission4'=>$request['ref_commission4'],
        'referral_commission5'=>$request['ref_commission5'],
        'signup_bonus'=>$request['signup_bonus'],
        ]);
        return redirect()->back()
        ->with('message', 'Action Sucessful');
  }

   //Update Subscription Fees
   public function updatesubfee(Request $request){
     
    Settings::where('id', $request['id'])
    ->update([
    'monthlyfee'=>$request['monthlyfee'],
    'quarterlyfee'=>$request['quaterlyfee'],
    'yearlyfee'=>$request['yearlyfee'],
    ]);
    return redirect()->back()
    ->with('message', 'Action Sucessful');
}

public function updatemark(Request $request){

    markets::where('id', $request->id)
      ->update([
        'market'=> $request->mktcatgy,
        'base_curr'=> $request->base_currency,
        'quote_curr'=> $request->quote_currency,
        // 'commission_type'=> $request->commission_type,
        // 'commission_fee'=> $request->commission_fee,
      ]);
        return redirect()->back()
        ->with('message', 'Market Sucessfully Updated');
}

  public function updateasst(Request $request){
    Asset::where('id', $request->id)
    ->update([
        'name'=> $request->assname,
        'symbol'=> $request->assym,
        'category'=> $request->ascat,
        // 'commission_type'=> $request->commission_type,
        // 'commission_fee'=> $request->commission_fee,
    ]);
        return redirect()->back()
        ->with('message', 'Asset Sucessfully Updated');
    }

    
    //Add withdrawal and deposit method
    public function addwdmethod(Request $request){
      $method = new Wdmethod();
      $method->name=$request['name'];
      $method->minimum=$request['minimum'];
      $method->maximum=$request['maximum'];
      $method->charges_fixed=$request['charges_fixed'];
      $method->charges_percentage=$request['charges_percentage'];
      $method->duration=$request['duration'];
      $method->type=$request['type'];
      $method->status=$request['status'];
      $method->save();
      return redirect()->back()->with('message','Method added successful!');
      
  }
  
  //Update withdrawal and deposit method
  public function updatewdmethod(Request $request){
      
      Wdmethod::where('id', $request['id'])
        ->update([
        'name'=>$request['name'],
        'minimum'=>$request['minimum'],
        'maximum'=>$request['maximum'],
        'charges_fixed'=>$request['charges_fixed'],
        'charges_percentage'=>$request['charges_percentage'],
        'duration'=>$request['duration'],
        'type'=>$request['type'],
        'status'=>$request['status'],
        ]);
        return redirect()->back()
        ->with('message', 'Action Successful');
      
  }
  
  //Delete withdrawal and deposit method
  public function deletewdmethod($id){
      Wdmethod::where('id',$id)->delete();
      return redirect()->back()->with('message','Withdrawal method deleted successful!');
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

      //save Setttings to DB
      public function updatesettings(Request $request){

        Settings::where('id', $request['id'])
        ->update([
        'withdrawal_option'=>$request['withdrawal_option'],
        'payment_mode'=>$request['payment_mode1'].$request['payment_mode2'].
        $request['payment_mode3'].$request['payment_mode4'].$request['payment_mode5'].$request['payment_mode6'].$request['payment_mode7'],
        'bank_name'=>$request['bank_name'],
        'account_name'=>$request['account_name'],
        'account_number'=>$request['account_number'],
        'btc_address'=>$request['btc_address'],
        'ltc_address'=>$request['ltc_address'],
        'eth_address'=>$request['eth_address'],
        's_s_k'=>$request['s_s_k'],
        's_p_k'=>$request['s_p_k'],
        'pp_ci'=>$request['pp_ci'],
        'pp_cs'=>$request['pp_cs'],
        ]);
        return redirect()->back()
        ->with('message', 'Action Sucessful');
  }
  public function updateasset(Request $request){

    $assets = new assets;
    $assets->category=$request['asset_catgy'];
    $assets->name=$request['asset_name'];
    $assets->symbol=$request['asset_symbol'];
    //$assets->commission_type=$request['coom_type'];
    //$assets->commission_fee=$request['com_fee'];
    $assets->save();

    return redirect()->back()
    ->with('message', 'Action Sucessful');
}

public function updatemarket(Request $request){
  $market = new markets;
  $market->market=$request['mktcatgy'];
  $market->base_curr=$request['base_currency'];
  $market->quote_curr=$request['quote_currency'];
 // $market->commission_type=$request['commfee_type'];
  //$market->commission_fee=$request['live_com_fee'];
  $market->save();
  return redirect()->back()
    ->with('message', 'Action Sucessful');
}

public function updatefee(Request $request){

Settings::where('id', $request->id)
  ->update([
    'commission_type'=> $request->commission_type,
    'commission_fee'=> $request->commission_fee,
  ]);
return redirect()->back()
  ->with('message', 'Action Sucessful');
}

public function delmarket($id){
markets::where('id',$id)->delete();
return redirect()->back()
        ->with('message', 'Market Sucessfully Deleted');
}

public function delassets($id){
Asset::where('id',$id)->delete();
return redirect()->back()
        ->with('message', 'Asset Sucessfully Deleted');
}




}
