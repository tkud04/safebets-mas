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

class AdminController extends Controller {

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
		
		$totalRevenue = $this->helpers->getTotalRevenue();
		$tokenSold = $this->helpers->getTotalTokens();
		$totalBetSlips = $this->helpers->getTotalBetSlips();
		$totalPunters = $this->helpers->getTotalPunters();
		$recentOrders = $this->helpers->getRecentPurchases();
		$recentMessages = $this->helpers->getRecentMessages();
		$breadCrumb = "Dashboard";
		
    	return view('admin.dashboard', compact(['user','breadCrumb','totalRevenue','tokenSold','totalPunters','totalBetSlips','recentOrders','recentMessages']));
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
    	return view('admin.vu', compact(['user','breadCrumb','users']));
    }	
	
	/**
	 * Show the application User Management -> Add/Remove Tokens screen to the admin.
	 *
	 * @return Response
	 */
	public function getManageTokens($action,$id)
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
			if($action == "ad") $action = "add";
			else if($action == "rm") $action = "remove";
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
                             'gggg' => 'required|exists:id',
                             'username' => 'required|exists:users',
                             'tokens' => 'required|numeric',
                   ]);
         
                 if($validator->fails())
                  {
					  $messages = $validator->messages();
                       return redirect()->back()->withInput()->with('errors',$messages);
                       
                 }
                
                 else
                 { 
					   if($action == "add") $this->helpers->addTokens($userId,$tokens);
					   else if($action == "remove") $this->helpers->removeTokens($userId,$tokens);

                       Session::flash("manage-tokens-status","success");
					   return redirect()->intended('nimda/users');
				 }
				 
	}
	
	/*				
	 * Show the application Bet Slips screen to the admin.
	 *
	 * @return Response
	 */
	public function getTickets()
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

		$betslips = $this->helpers->getBetSlips();
		$breadCrumb = "Betslips";
		
		return view('admin.betslips', compact(['user','breadCrumb','betslips']));	
    	
    }	

	/*				
	 * Show the application Transactions screen to the admin.
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
		
		if($user == null || $user->role != "admin")
		{
			return redirect()->intended('/');
		}

		$purchases = $this->helpers->getPurchases();
		$breadCrumb = "Purchases";
		
		return view('admin.vt', compact(['user','breadCrumb','purchases']));	
    	
    }

	/*				
	 * Show the application Messages screen to the admin.
	 *
	 * @return Response
	 */
	public function getMessages()
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

		$messages = $this->helpers->getMessages();
		$breadCrumb = "Messages";
		
		return view('admin.msgs', compact(['user','breadCrumb','messages']));	
    	
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
			$bs = $this->helpers->getBetSlip($id);
			$breadCrumb = "View bet slip";
			
			return view('admin.vbs', compact(['user','breadCrumb','bs']));			
		}

	
    	
    }	
	
	/**
	 * Marks selected bet slip win or loss.
	 *
	 * @return Response
	 */
	public function getMarkTicket($status,$id)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || ($id == "" || $status == ""))
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$this->helpers->markTicket($id,$status);
			Session::flash("mark-ticket-status","success");
			return redirect()->intended('nimda/transactions');		
		}
    }	
	
	/**
	 * Marks selected game win or loss.
	 *
	 * @return Response
	 */
	public function getMarkGame($status,$id)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		
		if($user == null || $user->role != "admin" || ($id == "" || $status == ""))
		{
			return redirect()->intended('/');
		}
		
		else
		{
			$this->helpers->markGame($id,$status);
			Session::flash("mark-game-status","success");
			$url = "nimda/betslip/".$id;
			return redirect()->intended($url);		
		}
    }
	
	
	/**
	 * Enables user.
	 *
	 * @return Response
	 */
	public function getEnable($id="")
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
			$this->helpers->enable($id);
			Session::flash("enable-status","success");
			return redirect()->intended('nimda/users');		
		}
    }	
	
	/**
	 * Disables user.
	 *
	 * @return Response
	 */
	public function getDisable($id="")
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
			$this->helpers->disable($id);
			Session::flash("disable-status","success");
			return redirect()->intended('nimda/users');		
		}
    }	
	
	/**
	 * Displays the Add Other Leagues view to admin.
	 *
	 * @return Response
	 */
	public function getOtherLeagues()
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
		
		else
		{
			$breadCrumb = "Manage other leagues";
			$countries = $this->helpers->getCountries();

			return view('admin.ols', compact(['user','breadCrumb','countries']));			
		}
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
		
		if($user == null || $user->role != "admin")
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
		
		if($user == null || $user->role != "admin")
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
		
		return $ret;
    }	
	
	/**
	 * Adds country
	 *
	 * @return Response
	 */
	public function getAddCountry(Request $request)
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
		
		else
		{
           $req = $request->all();
		   #dd($req);
           $ret = "";
               
                $validator = Validator::make($req, [
                             'name' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
					  $messages = $validator->messages();
                      return redirect()->back()->withInput()->with('errors',$messages);
                       
                 }
                
                 else
                 { 
					   $this->helpers->addCountry($req);

                       Session::flash("op","add-country");
                       Session::flash("op-status","success");
					   if(isset($req['mode']) && $req['mode'] == "json") return json_encode(["op" => "add-country","status" => "success"]);
					   else return redirect()->intended('nimda/other-leagues');
				 }	
		}
    }

	/**
	 * Adds competition
	 *
	 * @return Response
	 */
	public function getAddCompetition(Request $request)
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
		
		else
		{
           $req = $request->all();
		   #dd($req);
           $ret = "";
               
                $validator = Validator::make($req, [
                             'country_id' => 'required|numeric',
                             'name' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
					  $messages = $validator->messages();
                       return redirect()->back()->withInput()->with('errors',$messages);
                       
                 }
                
                 else
                 { 
					   $this->helpers->addCompetition($req);

                       Session::flash("op","add-competition");
                       Session::flash("op-status","success");
					   if(isset($req['mode']) && $req['mode'] == "json") return json_encode(["op" => "add-competition","status" => "success"]);
					   else return redirect()->intended('nimda/other-leagues');
				 }	
		}
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
		
		if($user == null || $user->role != "admin")
		{
			return redirect()->intended('/');
		}
		
		else
		{
           $req = $request->all();
		   #dd($req);
           $ret = "";
               
                $validator = Validator::make($req, [
                             'country_id' => 'required|numeric',
                             'competition_id' => 'required|numeric',
                             'uid' => 'required|numeric',
                             'name' => 'required',
                   ]);
         
                 if($validator->fails())
                  {
					  $messages = $validator->messages();
                      return redirect()->back()->withInput()->with('errors',$messages);
                       
                 }
                
                 else
                 { 
					   $this->helpers->addTeam($req);

                       Session::flash("op","add-team");
                       Session::flash("op-status","success");
					   if(isset($req['mode']) && $req['mode'] == "json") return json_encode(["op" => "add-team","status" => "success"]);
					   return redirect()->intended('nimda/other-leagues');
				 }	
		}
    }	

}
