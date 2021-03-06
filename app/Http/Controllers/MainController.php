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
		$todayGames = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
	    }
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames($user,"today");
		#dd($todayGames);
    	return view('index', compact(['user','ads','todayGames']));
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
	 * Show the application Leads screen to the admin.
	 *
	 * @return Response
	 */
	public function getLeads()
    {
        $user = null;
		$ret = ["status" => "nothing"];
		$json = true;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		
			$leads = $this->helpers->getLeads();
			
			$ret = ["status" => "ok", "data" => $leads];
		
    	if($json) return json_encode($ret);
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
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postNotification(Request $request)
    {
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'transaction_id' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = json_encode(["status" => "error","msg" => "An unknown error has occured."]);
                       
                 }
                
                 else
                 {
                       $t = $req['transaction_id'];					 
                       $u = "//voguepay.com/?v_transaction_id=".$t."&type=json";
	                   $ret = file_get_contents($u);					   
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
	 * Show the application Subscribe landing page to the user.
	 *
	 * @return Response
	 */
	public function getBB1()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
    	return view('bb_1.index', compact(['user']));
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
		#dd($todayGames);
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
		
		$ads = $this->helpers->getAds();
		$todayGames = $this->helpers->getGames($user,"today");
		
    	return view('tips', compact(['user','ads','todayGames']));
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
		$betslips = $this->helpers->getUserBetSlips($user);
		
    	return view('betslips', compact(['user','ads','betslips']));
    }
	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getSubscribe($em)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($em == "")
		{
			return redirect()->intended('/');
		}
		
		else
		{
		    $this->helpers->subscribe($em);
        	return view('sub', compact(['user']));	
		}
    }
		
	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function postSubscribe(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if(!isset($request))
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$req = $request->all();
			$validator = Validator::make($req, [
                             'em' => 'required',
                   ]);
                   
              if($validator->fails())
                  {
					   Session::flash("status","error");                  
					   Session::flash("msg","Please fill all the required fields.");  
                       return redirect()->back();          
                 }             
              else{
		      $em = $req['em'];
              	$this->helpers->subscribe($em);
		      $dat = ['em' => $em, 'title' => "Get Sure 3+ Odds in Your Inbox DAILY for FREE", 'type' => "thanks-1"];
		      $this->helpers->bomb($dat);
             	return view('bb_1.thank-you', compact(['user']));
             }
		    	
		}
    }
	
	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getUnsubscribe($em)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($em == "")
		{
			return redirect()->intended('/');
		}
		
		else
		{
		    $this->helpers->unsubscribe($em);
        	return view('unsub', compact(['user']));	
		}
    }
	/**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getResults()
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		$ads = $this->helpers->getAds();
		$betslips = $this->helpers->getGames($user, "results");
		
    	return view('results', compact(['user','ads','betslips']));
    }
    /**
	 * Show the application Support screen to the user.
	 *
	 * @return Response
	 */
	public function getViewTip($id)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($id == "")
        {
        	return redirect()->intended('results');
        }
		
		else
        {
        	$ads = $this->helpers->getAds();
		  $tip = $this->helpers->getGame($user, $id);
		
    	return view('tip-single', compact(['user','ads','tip']));
        }
		
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
		
		#$ret = Football::getLeagues();
		$ret = [];
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
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}
		
           $req = $request->all();
		   #dd($req);
           $ret = [];
           Session::flash("op","add-betslip");
		   
                $validator = Validator::make($req, [
                             'ssp' => 'required',
                             'bsite' => 'required',
                             'booking_code' => 'required',
                             'total_odds' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
					   Session::flash("status","error");                  
					   Session::flash("msg","Please fill all the required fields.");                  
                 }                 
				 
				 else if(!is_numeric($req['total_odds']))
                  {
					   Session::flash("status","error");                  
					   Session::flash("msg","Booking code is not a valid number.");                  
                  }
                
                 else
                 { 
			           $ssp = json_decode($req["ssp"],true);					   
					   $category = $this->helpers->getCategory($user);
					   
                       $betSlipData = ["booking_code" => $req['booking_code'],
					                   "bsite" => $req['bsite'],
					                   "total_odds" => $req['total_odds'],
					                   "user_id" => $user->id,
					                   "category" => $category,
									   "ssp" => $ssp];	
									   
                       #dd($betSlipData);									   
					   $this->helpers->addBetSlip($betSlipData);
					   Session::flash("status","success");
                  } 
				  				  
           Session::flash("notif","yes");				  
           return redirect()->intended('tips');				  
    } 
	
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postBetSlip(Request $request)
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
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBomb(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'em' => 'required',
                             'title' => 'required',
                             'type' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = ["op" => "bomb","status" => "error", "msg" => "Validation failed"];
                 }
                
                 else
                 { 
			           $ret = $this->helpers->bomb($req);
                       #dd($ret);					   
                  }       
           return json_encode($ret);
    }
	
	    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLazio(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'tdate' => 'required',
                             'content' => 'required',
                             'type' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = ["op" => "tpanel","status" => "error", "msg" => "Validation failed"];
                 }
                
                 else
                 { 
			          $this->helpers->uploadTips($req);
			            $ret = ["op" => "tpanel","status" => "ok", "msg" => ""];
                       #dd($ret);					   
                  }       
           return json_encode($ret);
    }
	
	/**
	 * Marks selected game win or loss.
	 *
	 * @return Response
	 */
	public function getMarkTip(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
        $req = $request->all();
		#dd($req);
        $ret = ["op" => "wyxy"];
               
        $validator = Validator::make($req, [
                             'type' => 'required',
                             'id' => 'required',
                             'status' => 'required',
                   ]);
         
        if($validator->fails())
            {
                $ret["status"] = "error";
				$ret["message"] = "Validation failed";
            }
		else
		{
			$type = $req['type'];
			$id = $req['id'];
			$status = $req['status'];
			
			if($type == "betslip")
			{
				$this->helpers->markBetSlip($id,$status);
				$ret["type"] = "betslip";
				$ret["status"] = "ok";
			}
			else if($type == "game")
			{
				$bsID = $req['bs-id'];
			   $this->helpers->markGame($id,$bsID,$status);	
			   $ret["type"] = "game";
				$ret["status"] = "ok";
			}		
		}
		
		return json_encode($ret);
    }

	/**
	 * Gets all uncleared predictions.
	 *
	 * @return Response
	 */
	 public function getUncleared(Request $request)
	 {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		$ret = $this->helpers->oasis();
		return json_encode($ret);
	 }

	 /**
	 * Adds scoreline for a match.
	 *
	 * @return Response
	 */
	public function getAddScoreLine(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
        $req = $request->all();
		#dd($req);
        $ret = ["op" => "add-scoreline"];
               
                $validator = Validator::make($req, [
                             'pid' => 'required|numeric',
                             'sc' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  $messages = $validator->messages();
                      $ret["status"] = "error";  
                      $ret["message"] = "validation failed.";  
                 }
                
                 else
                 { 
					   $this->helpers->addScoreLine($req);
                       $ret["status"] = "ok";                      
				 }
		
		return json_encode($ret);
    }

/**
	 * Adds team
	 *
	 * @return Response
	 */
	public function getAddTeam(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [                  
                             'competition_id' => 'required|numeric',
                             'uid' => 'required|numeric',
                             'name' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
					  $ret = ["op" => "add-team","status" => "error","msg" => "Validation failed"];
                       
                 }
                
                 else
                 { 
					   $this->helpers->addTeam($req);
                       $ret = ["op" => "add-team","status" => "success"];
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
	public function postGame(Request $request)
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
           $req = $request->all();
		   #dd($req);
           $ret = [];
               
                $validator = Validator::make($req, [
                             'al' => 'required',
                             'ct' => 'required',
                             'id' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
                       $ret = "Invalid ID!";
                       
                 }
                
                 else
                 { 
			           $data = ["al" => $req["al"], "id" => $req["id"], "ct" => $req["ct"] ];
			           $ret = $this->helpers->buyGame($user,$data);
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
	
	/**
	 * Gets Settings view and displays to the user
	 *
	 * @return Response
	 */
	public function getSettings()
    {
        $user = null;
		$ret = [];
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null)
		{
			return redirect()->intended('/');
		}
		
		$ret = $this->helpers->getSettings($user);
		
		return view('settings', compact(['user','ret']));	
    }	
	
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postSettings(Request $request)
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
		
           $req = $request->all();
		   #dd($req);
           $ret = [];
           Session::flash("op","settings");
		   
                $validator = Validator::make($req, [
                             'fname' => 'required',
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                   ]);
         
                 if($validator->fails())
                  {
					  return redirect()->back()->withInput()->withErrors($validator);                
                 }                 
                
                 else
                 { 									   
					   $this->helpers->updateSettings($user,$req);
					   Session::flash("status","success");
                  } 				  
           return redirect()->intended('settings');				  
    }     
}
