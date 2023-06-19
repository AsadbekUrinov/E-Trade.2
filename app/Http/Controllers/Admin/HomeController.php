<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Settings;
use App\Models\Plans;
// use App\Models\hisplans;
use App\Models\Agent;
//use App\Models\confirmations;
use App\Models\User_plans;
use App\Models\Mt4Details;
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
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   
     /**
      * Show Admin Dashboard.
      * 
      * @return \Illuminate\Http\Response
      */
     public function index(){

        //sum total deposited
        $total_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as count"))->where('status','Processed')->get();
        $pending_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as count"))->where('status','Pending')->get();
        $total_withdrawn = DB::table('withdrawals')->select(DB::raw("SUM(amount) as count"))->where('status','Processed')->get();
        $pending_withdrawn = DB::table('withdrawals')->select(DB::raw("SUM(amount) as count"))->where('status','Pending')->get();

        $userlist = User::count();
        $activeusers = User::where('status', 'active')->count();
        $blockeusers = User::where('status', 'blocked')->count();
        $plans = Plans::count();
        $unverifiedusers = User::where('account_verify', '!=' ,'yes')->count();
      
         return view('admin.dashboard',[
            'title' => 'Admin Dashboard',
            'total_deposited' => $total_deposited,
            'pending_deposited' => $pending_deposited,
            'total_withdrawn' => $total_withdrawn,
            'pending_withdrawn' => $pending_withdrawn,
            'user_count' => $userlist,
            'plans'=> $plans,
            'activeusers' => $activeusers,
            'blockeusers' => $blockeusers,
            'unverifiedusers'=> $unverifiedusers,
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
     }
     //Plans route
    public function plans()
    {
    	return view('admin.plans')
        ->with(array(
        'title'=>'System Plans',
        'plans'=> Plans::where('type', 'Main')->orderby('created_at','ASC')->get(),
        'pplans'=> Plans::where('type', 'Promo')->get(),
        'settings' => Settings::where('id','1')->first(),
        ));
    }

    //Return manage users route
    public function manageusers()
    {
      $pl = Plans::all();
      return view('admin.users')
        ->with(array(
        'title'=>'All users',
        'pl'=> $pl,
        'users' => User::orderBy('id', 'desc')->get(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }


     //Return search subscription route
     public function searchsub(Request $request)
     {
       $searchItem=$request['searchItem'];
       if($request['type']=='subscription'){
         $result=Mt4Details::whereRaw("MATCH(mt4_id,account_type,server) AGAINST('$searchItem')")->paginate(10);
       }
       return view('admin.msubtrade')
         ->with(array(
         'title'=>'Subscription search result',
         'subscriptions' => $result,
         'settings' => Settings::where('id', '=', '1')->first(),
         ));
     }

       //Return search route for Withdrawals
       public function searchWt(Request $request)
       { 
        $dp = Withdrawal::all();
        $searchItem=$request['wtquery'];
        
        $result=Withdrawal::where('user', $searchItem)
			->orwhere('amount',$searchItem)
			->orwhere('payment_mode',$searchItem)
			->orwhere('status',$searchItem)
			->paginate(10);
        
        return view('admin.mwithdrawals')
          ->with(array(
          'dp'=> $dp,
          'title'=>'Withdrawals search result',
          'withdrawals' => $result,
          'settings' => Settings::where('id', '=', '1')->first(),
          ));
       }
    

      //Return manage withdrawals route
      public function mwithdrawals()
      {
        return view('admin.mwithdrawals')
          ->with(array(
          'title'=>'Manage users withdrawals',
          'withdrawals' => Withdrawal::orderBy('id', 'desc')->get(),
          'settings' => Settings::where('id', '=', '1')->first(),
          ));
      }

      //Return manage deposits route
      public function mdeposits()
      {
        return view('admin.mdeposits')
          ->with(array(
          'title'=>'Manage users deposits',
          'deposits' => Deposit::orderBy('id', 'desc')->get(),
          'settings' => Settings::where('id', '=', '1')->first(),
          ));
      }

      //Return agents route
      public function agents()
      {
        return view('admin.agents')
          ->with(array(
          'title'=>'Manage agents',
          'users' => User::orderBy('id', 'desc')
               ->get(),
          'agents' => Agent::all(),
          'settings' => Settings::where('id', '=', '1')->first(),
          ));
      }
      
       //Return view agent route
      public function viewagent($agent)
      {
        return view('admin.viewagent')
          ->with(array(
          'title'=>'Agent record',
          'agent'=> User::where('id',$agent)->first(),
          'ag_r' => User::where('ref_by',$agent)->get(),
          'settings' => Settings::where('id', '=', '1')->first(),
          ));
      }

       //return settings form
    public function settings(Request $request){
        include'currencies.php';
        return view('admin.settings')->with(array(
          'settings' => Settings::where('id', '=', '1')->first(),
          'wmethods' => Wdmethod::where('type', 'withdrawal')->get(),
          'assets' => Asset::all(),
          //'markets' => markets::all(),
          'cpd' => Cp_transaction::where('id', '=', '1')->first(),
          'currencies' => $currencies,
          'title' =>'System Settings'));
        //return view('settings')->with(array('settings' => Settings::where('id', '=', '1')->first(),'title' =>'System Settings'));
      }

      public function msubtrade()
      {
        return view('admin.msubtrade')
        ->with(array(
        'subscriptions' => Mt4Details::orderBy('id', 'desc')->get(),
        'title'=>'Manage Subscription',
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
      } 
      
      public function userplans($id)
      {
        return view('admin.user_plans')
        ->with(array(
        'plans' => User_plans::where('user', $id)->orderBy('id', 'desc')->get(),
        'user' => User::where('id' , $id)->first(),
        'title'=>'User Investment Plan(s)',
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
      } 

      public function userwallet($id)
      {
        $user = User::where('id' , $id)->first();
         //sum total deposited
         $total_deposited = DB::table('deposits')->select(DB::raw("SUM(amount) as count"))->where('user', $id)->
         where('status','Processed')->get();
           
        return view('admin.user_wallet')
        ->with(array(
        'ref_bonus' => $user->ref_bonus,
        'deposited' => $total_deposited,
        'bonus' => $user->bonus,
        'roi' => $user->roi,
        'account_bal' => $user->account_bal,
        'user' => $user->name,
        'title'=>'User Investment Plan(s)',
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
      } 
      
    //return front end management page
    public function frontpage(Request $request){
        return view('admin.frontpage')->with(array(
        'title'=>'Frontend management',
        'faqs' => Faq::all(),
        'images' => Images::orderBy('id', 'desc')->get(),
        'testimonies' => Testimony::orderBy('id', 'desc')->get(),
        'contents' => Content::orderBy('id', 'desc')->get(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }

    
  public function adduser(){
    return view('admin.referuser')->with(array(
      'title'=>'Add new Users',
      'settings' => Settings::where('id', '=', '1')->first()));
  }

  public function addmanager(){
    return view('admin.addadmin')->with(array(
      'title'=>'Add new manager',
      'settings' => Settings::where('id', '=', '1')->first()));
  }
  public function madmin(){
    return view('admin.madmin')->with(array(
      'admins' => Admin::orderby('id', 'desc')->get(),
      'title'=>'Add new manager',
      'settings' => Settings::where('id', '=', '1')->first(),

    ));
  }

    //Return KYC route
    public function kyc()
    {
      return view('admin.kyc')
        ->with(array(
        'title'=>'KYC',
        'users' => User::where('id_card','!=', NULL)
        ->where('passport','!=', NULL)->get(),
        'settings' => Settings::where('id', '=', '1')->first(),
        ));
    }
    
    // public function calendar()
    // {
    //   return view('admin.calender')
    //     ->with(array(
    //     'title'=>'Create To do List',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }

    // public function showtaskpage()
    // {
    //   return view('admin.task')
    //     ->with(array(
    //     'admin' => Admin::orderby('id', 'desc')->get(),
    //     'title'=>'Create a New Task',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }

    // public function mtask()
    // {
    //   return view('admin.mtask')
    //     ->with(array(
    //     'admin' => Admin::orderby('id', 'desc')->get(),
    //     'tasks' => Task::orderby('id', 'desc')->get(),
    //     'title'=>'Manage Task',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }
    // public function viewtask()
    // {
    //   return view('admin.vtask')
    //     ->with(array(
    //     'tasks' => Task::orderby('id', 'desc')->where('designation', Auth('admin')->User()->id)->get(),
    //     'title'=>'View my Task',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }

    // public function leads()
    // {
    //   return view('admin.leads')
    //     ->with(array(
    //     'admin' => Admin::orderBy('id', 'desc')->get(),
    //     'users' => User::orderby('id', 'desc')->where('user_plan', NULL)->get(),
    //     'title'=>'Manage New Registered Clients',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }
    // public function leadsassign()
    // {
    //   return view('admin.lead_asgn')
    //     ->with(array(
    //     'usersAssigned' => User::orderby('id', 'desc')->where([
    //       ['assign_to', Auth('admin')->User()->id],
    //       ['cstatus', NULL]
    //     ])->get(),
        
    //     'title'=>'Manage New Registered Clients',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }


    // public function customer()
    // {
    //   return view('admin.customer')
    //     ->with(array(
    //     'users' => User::orderby('id', 'desc')->where('cstatus', 'Customer')->get(),
    //     'title'=>'Manage New Registered Clients',
    //     'settings' => Settings::where('id', '=', '1')->first(),
    //     ));
    // }
     
}
