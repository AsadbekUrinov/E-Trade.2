<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Models\Settings;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
   
//cron url
Route::get('/cron', 'App\Http\Controllers\Controller@autotopup')->name('cron');

//Front Pages Route
Route::get('/', 'App\Http\Controllers\UsersController@index')->name('home');
// Route::get('terms', 'UsersController@terms')->name('terms');
// Route::get('privacy', 'UsersController@privacy')->name('privacy');
// Route::get('about', 'UsersController@about')->name('about');
// Route::get('contact', 'UsersController@contact')->name('contact');
// Route::get('faq', 'UsersController@faq')->name('faq');
// Everything About Admin Route started here
Route::prefix('adminlogin')->group(function () {
	Route::get('login','App\Http\Controllers\Admin\Auth\LoginController@showLoginForm')->name('adminloginform');
	Route::post('login','App\Http\Controllers\Admin\Auth\LoginController@adminlogin')->name('adminlogin');
	Route::post('logout','App\Http\Controllers\Admin\Auth\LoginController@adminlogout')->name('adminlogout');
	Route::get('dashboard','App\Http\Controllers\Admin\Auth\LoginController@validate_admin')->name('validate_admin');
});
Route::post('/register','App\Http\Controllers\Admin\Auth\LoginController@addUser')->name('register');
Route::group(['prefix' => 'admin',  'middleware' => 'isadmin'], function()
{
    Route::get('dashboard','App\Http\Controllers\Admin\HomeController@index')->name('admin.dashboard');
	Route::get('dashboard/plans', ['uses' => 'App\Http\Controllers\Admin\HomeController@plans'])->name('plans');
	Route::get('dashboard/manageusers', ['uses' => 'App\Http\Controllers\Admin\HomeController@manageusers'])->name('manageusers');

	// CRM ROUTES
	Route::get('dashboard/calendar', ['uses' => 'App\Http\Controllers\Admin\HomeController@calendar'])->name('calendar');
	Route::get('dashboard/task', ['uses' => 'App\Http\Controllers\Admin\HomeController@showtaskpage'])->name('task');
	Route::get('dashboard/mtask', ['uses' => 'App\Http\Controllers\Admin\HomeController@mtask'])->name('mtask');
	Route::get('dashboard/viewtask', ['uses' => 'App\Http\Controllers\Admin\HomeController@viewtask'])->name('viewtask');
	Route::post('dashboard/addtask', 'App\Http\Controllers\Admin\CrmController@addtask')->name('addtask');
	Route::post('dashboard/updatetask', 'App\Http\Controllers\Admin\CrmController@updatetask')->name('updatetask');
	Route::get('dashboard/deltask/{id}', 'App\Http\Controllers\Admin\CrmController@deltask' )->name('deltask');
	Route::get('dashboard/markdone/{id}', 'App\Http\Controllers\Admin\CrmController@markdone' )->name('markdone');
	Route::get('dashboard/leads', ['uses' => 'App\Http\Controllers\Admin\HomeController@leads'])->name('leads');
	Route::get('dashboard/leadsassign', ['uses' => 'App\Http\Controllers\Admin\HomeController@leadsassign'])->name('leadsassign');
	Route::post('dashboard/updateuser', 'App\Http\Controllers\Admin\CrmController@updateuser')->name('updateuser');
	Route::get('dashboard/convert/{id}', 'App\Http\Controllers\Admin\CrmController@convert' )->name('convert');
	Route::get('dashboard/customer', ['uses' => 'App\Http\Controllers\Admin\HomeController@customer'])->name('customer');
	// This route is used to Assign Users
	Route::post('dashboard/assign', 'App\Http\Controllers\App\Http\Controllers\Admin\CrmController@assign')->name('assignuser');


	Route::get('dashboard/user-plans/{id}', 'App\Http\Controllers\Admin\HomeController@userplans')->name('user.plans');

	Route::get('dashboard/user-wallet/{id}', 'App\Http\Controllers\Admin\HomeController@userwallet')->name('user.wallet');

	Route::post('dashboard/search', 'App\Http\Controllers\Admin\HomeController@search');
	Route::post('dashboard/searchdp','App\Http\Controllers\Admin\HomeController@searchDp');
	Route::post('dashboard/searchWith','App\Http\Controllers\Admin\HomeController@searchWt');
	Route::post('dashboard/searchsub','App\Http\Controllers\Admin\HomeController@searchsub');

	Route::get('dashboard/mwithdrawals', 'App\Http\Controllers\Admin\HomeController@mwithdrawals')->name('mwithdrawals');
	Route::get('dashboard/mdeposits','App\Http\Controllers\Admin\HomeController@mdeposits')->name('mdeposits');
	Route::get('dashboard/agents', 'App\Http\Controllers\Admin\HomeController@agents')->name('agents');
	Route::get('dashboard/addmanager','App\Http\Controllers\Admin\HomeController@addmanager')->name('addmanager');
	Route::get('dashboard/madmin','App\Http\Controllers\Admin\HomeController@madmin')->name('madmin');
	Route::get('dashboard/msubtrade','App\Http\Controllers\Admin\HomeController@msubtrade')->name('subtrade');
	Route::get('dashboard/settings','App\Http\Controllers\Admin\HomeController@settings')->name('settings');
	Route::get('dashboard/frontpage','App\Http\Controllers\Admin\HomeController@frontpage')->name('frontpage');
	Route::get('dashboard/adduser','App\Http\Controllers\Admin\HomeController@adduser')->name('adduser');
	Route::post('dashboard/addplan','App\Http\Controllers\Admin\LogicController@addplan')->name('addplan');
	Route::post('dashboard/updateplan','App\Http\Controllers\Admin\LogicController@updateplan')->name('updateplan');
	Route::post('dashboard/topup', 'App\Http\Controllers\Admin\LogicController@topup')->name('topup');
	Route::post('dashboard/sendmailsingle', 'App\Http\Controllers\Admin\LogicController@sendmailtooneuser');
	Route::post('dashboard/sendmail', 'App\Http\Controllers\Admin\UsersController@sendmail');
	Route::post('dashboard/AddHistory', 'App\Http\Controllers\Admin\LogicController@addHistory')->name('addhistory');
	Route::post('dashboard/edituser', 'App\Http\Controllers\Admin\LogicController@edituser')->name('edituser');
	Route::post('dashboard/editadmin', 'App\Http\Controllers\Admin\UsersController@editadmin')->name('editadmin');
	Route::get('dashboard/resetpswd/{id}','App\Http\Controllers\Admin\LogicController@resetpswd')->name('resetpswd');
	Route::get('dashboard/resetadpwd/{id}','App\Http\Controllers\Admin\UsersController@resetadpwd')->name('resetadpwd');
	Route::get('dashboard/switchuser/{id}','App\Http\Controllers\Admin\LogicController@switchuser');
	Route::get('dashboard/clearacct/{id}','App\Http\Controllers\Admin\LogicController@clearacct')->name('clearacct');
	Route::get('dashboard/deldeposit/{id}','App\Http\Controllers\Admin\LogicController@deldeposit')->name('deldeposit');
	Route::get('dashboard/pdeposit/{id}','App\Http\Controllers\Admin\LogicController@pdeposit')->name('pdeposit');

	Route::get('dashboard/pwithdrawal/{id}','App\Http\Controllers\Admin\LogicController@pwithdrawal')->name('pwithdrawal'); 

	Route::post('dashboard/rejectwithdrawal','App\Http\Controllers\Admin\LogicController@rejectwithdrawal')->name('rejectwithdrawal');

	Route::post('dashboard/addagent', 'App\Http\Controllers\Admin\LogicController@addagent');
	Route::get('dashboard/viewagent/{agent}','App\Http\Controllers\Admin\HomeController@viewagent')->name('viewagent');
	Route::get('dashboard/delagent/{id}','App\Http\Controllers\Admin\LogicController@delagent')->name('delagent');

	// Settings Update Routes
	Route::post('dashboard/updatecpd', 'App\Http\Controllers\Admin\SettingsController@updatecpd');
	Route::post('dashboard/updatesettings', 'App\Http\Controllers\Admin\SettingsController@updatesettings');
	Route::post('dashboard/updatepreference', 'App\Http\Controllers\Admin\SettingsController@updatepreference');
	Route::post('dashboard/updatewebinfo', 'App\Http\Controllers\Admin\SettingsController@updatewebinfo');
	Route::post('dashboard/updatebot', 'App\Http\Controllers\Admin\SettingsController@updatebot');
	Route::post('dashboard/updatebotswt', 'App\Http\Controllers\Admin\SettingsController@updatebotswt');
	Route::post('dashboard/updateasset', 'App\Http\Controllers\Admin\SettingsController@updateasset');
	Route::post('dashboard/updatemarket', 'App\Http\Controllers\Admin\SettingsController@updatemarket');
	Route::post('dashboard/updatefee', 'App\Http\Controllers\Admin\SettingsController@updatefee');
	Route::post('dashboard/updatesubfee', 'App\Http\Controllers\Admin\SettingsController@updatesubfee');
	Route::post('dashboard/updatewdmethod', 'App\Http\Controllers\Admin\SettingsController@updatewdmethod');
	Route::post('dashboard/addwdmethod', 'App\Http\Controllers\Admin\SettingsController@addwdmethod');
 
	Route::get('dashboard/delsub/{id}', 'App\Http\Controllers\Admin\LogicController@delsub' );
	Route::get('dashboard/confirmsub/{id}', 'App\Http\Controllers\Admin\LogicController@confirmsub' );
	Route::post('dashboard/saveuser','App\Http\Controllers\Admin\LogicController@saveuser');
	Route::post('dashboard/saveadmin','App\Http\Controllers\Admin\LogicController@saveadmin');

	Route::get('dashboard/unblock/{id}','App\Http\Controllers\Admin\UsersController@unblock');
	Route::get('dashboard/ublock/{id}','App\Http\Controllers\Admin\UsersController@ublock');
	Route::get('dashboard/deluser/{id}','App\Http\Controllers\Admin\UsersController@deluser')->name('deluser');
	Route::get('dashboard/adminchangepassword','App\Http\Controllers\Admin\UsersController@adminchangepassword');
	Route::post('dashboard/adminupdatepass', 'App\Http\Controllers\Admin\UsersController@adminupdatepass')->name('adminupdatepass');

	 // KYC Routes
	 Route::get('dashboard/kyc','App\Http\Controllers\Admin\HomeController@kyc')->name('kyc');
	 Route::get('dashboard/acceptkyc/{id}','App\Http\Controllers\Admin\UsersController@acceptkyc');
	 Route::get('dashboard/rejectkyc/{id}','App\Http\Controllers\Admin\UsersController@rejectkyc');

	Route::get('dashboard/uublock/{id}','App\Http\Controllers\Admin\SystemController@ublock');
	Route::get('dashboard/uunblock/{id}','App\Http\Controllers\Admin\SystemController@unblock');
	Route::get('dashboard/delsystemuser/{id}','App\Http\Controllers\Admin\LogicController@delsystemuser');
	Route::get('dashboard/usertrademode/{id}/{action}','App\Http\Controllers\Admin\SystemController@usertrademode');

	Route::post('dashboard/sendmailtoall', 'App\Http\Controllers\Admin\LogicController@sendmailtoall')->name('sendmailtoall');
	
	Route::post('dashboard/changestyle', 'App\Http\Controllers\Admin\UsersController@changestyle')->name('changestyle');
	Route::get('dashboard/trashplan/{id}','App\Http\Controllers\Admin\LogicController@trashplan');
	Route::get('dashboard/deletewdmethod/{id}', 'App\Http\Controllers\Admin\SettingsController@deletewdmethod');
	
	// This Route is for frontpage editing
	Route::post('dashboard/savefaq', 'App\Http\Controllers\Admin\LogicController@savefaq')->name('savefaq');
	Route::post('dashboard/savetestimony', 'App\Http\Controllers\Admin\LogicController@savetestimony')->name('savetestimony');
	Route::post('dashboard/saveimg', 'App\Http\Controllers\Admin\LogicController@saveimg')->name('saveimg');
	Route::post('dashboard/savecontents', 'App\Http\Controllers\Admin\LogicController@savecontents')->name('savecontents');

	//Update Frontend Pages
	Route::post('dashboard/updatefaq', 'App\Http\Controllers\Admin\LogicController@updatefaq')->name('updatefaq');
	Route::post('dashboard/updatetestimony', 'App\Http\Controllers\Admin\LogicController@updatetestimony')->name('updatetestimony');
	Route::post('dashboard/updatecontents', 'App\Http\Controllers\Admin\LogicController@updatecontents')->name('updatecontents');
	Route::post('dashboard/updateimg', 'App\Http\Controllers\Admin\LogicController@updateimg')->name('updateimg');
	
	// Delete fa and tes routes
	Route::get('dashboard/delfaq/{id}', 'App\Http\Controllers\Admin\LogicController@delfaq' );
	Route::get('dashboard/deltestimony/{id}', 'App\Http\Controllers\Admin\LogicController@deltest' );
	// This route is to import data from excel
	Route::post('dashboard/fileImport', 'App\Http\Controllers\Admin\ImportController@fileImport')->name('fileImport');
});
// Everything About Admin Route ends here



















//cron url
// Route::get('dashboard/cron', 'App\Http\Controllers\Controller@autotopup')->name('cron');

Route::get('/verify-email', 'App\Http\Controllers\UsersController@verifyemail')->middleware('auth')->name('verification.notice');;

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\Controller@dashboard')->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('autoconfirm', 'CoinPaymentsAPI@autoconfirm')->name('autoconfirm');
	Route::get('/forgot-password', 'App\Http\Controllers\UsersController@forgotpassword')->name('password.request');
	Route::get('/dashboard/manage-account-security', 'App\Http\Controllers\UsersController@twofa')->name('twofa');
	// Two Factor Authentication
	Route::post('dashboard/changetheme', 'App\Http\Controllers\SomeController@changetheme')->name('changetheme');
    Route::get('2fa', 'App\Http\Controllers\TwoFactorController@showTwoFactorForm')->name('2fa');
    Route::post('2fa', 'App\Http\Controllers\TwoFactorController@verifyTwoFactor');
	Route::post('dashboard/savedocs', 'App\Http\Controllers\SomeController@savevdocs')->name('kycsubmit');
    Route::post('dashboard/paypalverify/{amount}', 'App\Http\Controllers\Controller@paypalverify')->name('paypalverify');
    
	Route::get('licensing', 'App\Http\Controllers\UsersController@licensing')->name('licensing');
	Route::get('dashboard/deposits', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@deposits'])->name('deposits');
	Route::get('dashboard/skip_account', ['middleware' => 'auth', 'uses' => 'Controller@skip_account']);
	Route::get('dashboard/payment', 'App\Http\Controllers\SomeController@payment')->name('payment');
	Route::get('dashboard/tradinghistory', 'App\Http\Controllers\SomeController@tradinghistory')->name('tradinghistory');
	Route::get('dashboard/accounthistory', 'App\Http\Controllers\SomeController@accounthistory')->name('accounthistory');
	Route::get('dashboard/withdrawals', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@withdrawals'])->name('withdrawalsdeposits')->middleware('2fa');
	//dashboard
	
	Route::get('dashboard/paywithcard/{amount}', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@paywithcard'])->name('paywithcard');
	Route::get('dashboard/cpay/{amount}/{coin}/{ui}/{msg}', ['uses' => 'App\Http\Controllers\Controller@cpay'])->name('cpay');
	Route::get('dashboard/mplans', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@mplans'])->name('mplans');
	Route::get('dashboard/myplans', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@myplans'])->name('myplans')->middleware('2fa');
	// Route::get('dashboard/makeadmin/{id}/{action}', ['middleware' => ['auth', 'admin'], 'uses'=>'UsersController@makeadmin', 'as'=>'makeadmin']);
	Route::get('dashboard/pplans', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@pplan'])->name('pplans');
	
	//Route::get('dashboard/joinplan/{id}', ['middleware' => 'auth', 'uses' => 'Controller@joinplan']);
	Route::get('ref/{id}', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\Controller@ref', 'as'=>'ref']);
    Route::post('dashboard/joinplan', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@joinplan']);
	Route::post('dashboard/paywithcard/charge', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\UsersController@charge']);
	Route::post('dashboard/withdrawal', 'App\Http\Controllers\SomeController@withdrawal');
	Route::post('sendcontact', 'App\Http\Controllers\UsersController@sendcontact')->name('enquiry');
	Route::post('dashboard/deposit', 'App\Http\Controllers\SomeController@deposit')->name('newdeposit');
	Route::post('dashboard/chngemail', 'App\Http\Controllers\UsersController@chngemail');
	Route::post('dashboard/savedeposit', 'App\Http\Controllers\SomeController@savedeposit');
// 	Route::post('dashboard/addwdmethod', 'SomeController@addwdmethod');


	// Paystack Route here
	Route::post('/pay', 'App\Http\Controllers\PaystackController@redirectToGateway')->name('pay.paystack');
	Route::get('/dashboard/paystackcallback', 'App\Http\Controllers\PaystackController@handleGatewayCallback');

	// Tripe Pyament
	Route::post('/dashboard/stripepay/{{amount}}', 'App\Http\Controllers\StripeController@redirectToGateway')->name('pay.stripe');


	Route::get('dashboard/accountdetails', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@accountdetails', 'as'=>'acountdetails']);
	Route::get('dashboard/changepassword', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@changepassword', 'as'=>'changepassword']);
	Route::get('dashboard/support', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\Controller@support', 'as'=>'support']);
	Route::get('dashboard/withdrawal', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@withdrawal', 'as'=>'withdrawal']);
	Route::get('dashboard/phusers', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@phusers', 'as'=>'phusers']);
	Route::get('dashboard/matchinglist', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@matchinglist', 'as'=>'matchinglist']);
	Route::get('dashboard/ghuser', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@ghuser', 'as'=>'ghuser']);
	Route::get('dashboard/confirmation/{id}', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@confirmation', 'as'=>'confirmation']);
	Route::get('dashboard/tupload/{id}', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@tupload', 'as'=>'tupload']);
	Route::get('dashboard/dnpagent', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@dnpagent', 'as'=>'dnpagent']);
	Route::get('dashboard/referuser', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\UsersController@referuser', 'as'=>'referuser']);
	//Route::get('dashboard/notification', 'UsersController@notification');
	Route::get('dashboard/notification', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@notification', 'as'=>'notification']);
	Route::get('dashboard/subtrade', ['middleware' => 'auth', 'uses' => 'App\Http\Controllers\Controller@subtrade'])->name('subtrade');
	Route::get('dashboard/subpricechange', 'App\Http\Controllers\Controller@subpricechange')->middleware("admin");
	Route::post('dashboard/savemt4details', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\Controller@savemt4details', 'as'=>'savemt4details']);
	
	Route::get('dashboard/profile', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@profile', 'as'=>'profile']);
	// Upadting user profile info
	Route::post('dashboard/profileinfo', ['middleware' => 'auth', 'uses'=>'App\Http\Controllers\SomeController@updateprofile', 'as'=>'userprofile']);
	
	//Route::get('dashboar
	//Route::get('dashboard/plans', ['middleware' => 'auth', 'uses'=>'Controller@showplans', 'as'=>'plans']);
	Route::get('dashboard/delnotif/{id}', 'App\Http\Controllers\SomeController@delnotif' );
	Route::get('dashboard/delmarket/{id}', 'App\Http\Controllers\SomeController@delmarket' );
	Route::get('dashboard/delassets/{id}', 'App\Http\Controllers\SomeController@delassets' );
	Route::post('dashboard/updatemark', 'App\Http\Controllers\SomeController@updatemark');
	Route::post('dashboard/updateasst', 'App\Http\Controllers\SomeController@updateasst');
	Route::post('dashboard/upload', 'App\Http\Controllers\UsersController@upload');
	Route::post('dashboard/confirm', 'App\Http\Controllers\UsersController@confirm');
	Route::get('dashboard/mconfirm/{id}/{ph_id}/{amount}', 'App\Http\Controllers\UsersController@mconfirm');
	Route::get('dashboard/mdelete/{id}/{ph_id}/{amount}', 'App\Http\Controllers\UsersController@mdelete');
	Route::post('dashboard/withdraw', 'App\Http\Controllers\SomeController@withdraw');
	
	Route::post('dashboard/updateacct', 'App\Http\Controllers\UsersController@updateacct')->name('updateacount');
	Route::post('dashboard/updatepass', 'App\Http\Controllers\UsersController@updatepass')->name('updatepass'); 
	Route::post('dashboard/dnate', 'App\Http\Controllers\UsersController@dnate');
	Route::get('dashboard/donation', ['uses'=>'App\Http\Controllers\UsersController@donation', 'as'=>'donation']);
	Route::get('dashboard/donate/{plan}', ['uses'=>'App\Http\Controllers\UsersController@donate', 'as'=>'donate']);
	Route::get('ref/{id}', ['uses'=>'App\Http\Controllers\UsersController@ref', 'as'=>'ref']);
	Route::post('reguser', 'App\Http\Controllers\Auth\AuthController@reguser');
	Route::post('dashboard/saveagent', 'App\Http\Controllers\UsersController@saveagent');
	Route::get('dashboard/delsubtrade/{id}', 'App\Http\Controllers\Controller@delsubtrade' );
	
	Route::get('/dashboard/submit-stripe-payment', 'App\Http\Controllers\StripeController@submitpayment');

	Route::get('/dashboard/verify-account', 'App\Http\Controllers\UsersController@verifyaccount')->name('account.verify');

});

Route::get('/dashboard/weekend', 'App\Http\Controllers\Controller@checkdate');

//activate and deactivate Online Trader
Route::any('/activate', function () {
	return view('activate.index',[
		'settings' => Settings::where('id','1')->first(),
	]);
});

Route::any('/revoke', function () {
	return view('revoke.index');
});
