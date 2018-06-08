<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\User;
use App\Tokens;
use App\Settings;

class LoginController extends Controller {

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
    public function postLogin(Request $request)
    {
        $req = $request->all();
        //dd($req);
		 $rt = null;
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6',
                             'email' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             Session::flash("notif","yes");
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
			$ret = $req['email'];
			

            $user = User::where('email',$ret)->orWhere('username',$ret)->first();

                if(is_null($user))
                {
					Session::flash("notif","yes");
                     return redirect()->back()->withInput()->withErrors("This user doesn't exist!","errors"); 
                }
				elseif($user->status == "disabled")
                {
					Session::flash("notif","yes");
                     return redirect()->back()->withInput()->withErrors("An unknown problem has occurred, please try again later.","errors"); 
                }
         	//authenticate this login
            if(Auth::attempt(['email' => $req['email'],'password' => $req['password']]) || Auth::attempt(['username' => $req['email'],'password' => $req['password']]))
            {
            	//Login successful               
               $user = Auth::user();          
			   
               if($user->role == "admin"){return redirect()->intended("nimda");}
               else if($user->role == "expert"){return redirect()->intended("dashboard");}
               else if($user->role == "punter"){return redirect()->intended("dashboard");}
            }
			
			else
			{
				Session::flash("notif","yes");
                     return redirect()->back()->withInput()->withErrors("Inavlid login details, please try again.","errors"); 
			}
         }  
    }
	
    public function postRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
		$rt = null;
        
        $validator = Validator::make($req, [
                             'pass' => 'required|confirmed',
                             'email' => 'required|email',
                             'sub' => 'required',
                             'fname' => 'required',
                             'lname' => 'required', 'username' => 'required',		
                             'phone' => 'required|numeric',
                             #'g-recaptcha-response' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
			 
             //dd($messages);
             Session::flash("notif","yes");
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
            
                       #dd($req);            

            $user =  $this->helpers->createUser($req);
            $tk = Tokens::create(["user_id" => $user->id,"balance" => 0]);						
            $this->helpers->setCategory($user,"unverified");
			
			if($user->sub == "yes"){
				$dd = ['email' => $user->email];
			    $this->helpers->addLead($dd);
				
               //after creating the user, send back to the registration view with a success message
               #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
			}
             Session::flash("signup-status", "success");
			 Session::flash("notif","yes");
             return redirect()->intended('/');
          }
    }
	
	
	public function getPassword()
    {
         return view('auth.password');
    }	
	
/**
     * Request a new password for the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postPassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'email' => 'required|email'
                  ]);
                  
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             Session::flash("notif","yes");
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }
				
				$userHash = bcrypt($user->email);
                
                $this->helpers->sendEmail($user->email,'Change your password',['rxf' => $userHash],'emails.password_alert','view');                                                         
            Session::flash("password-status","success");  
            Session::flash("notif","yes");			
            return redirect()->intended('/');

      }
                  
    }  
	
	public function getChangePassword($rxf="")
    {
                  
         if($rxf == "")
         {
             return redirect()->intended("/");
         }
		 
		 else
		 {
			 return view('auth.reset',compact(['rxf']));
		 } 
    }
    
/**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postChangePassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'rxf' => 'required|confirmed', 
                             'password' => 'required|confirmed'
                  ]);
                  
                 if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
			 Session::flash("notif","yes");
         }
         
         else{
         	$rxf = $req['rxf'];
             $arr =bexplode("+#",$rxf);
             $id = $arr[1];

                $user = User::where('id',$id)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("Invalid token","errors");
						Session::flash("notif","yes");
                }
                
                $user->update(['password' => bcrypt($req["password"])]);                                                         
            Session::flash("reset-status","success");           
            return redirect()->intended('/');

      }
                  
    }    
    
    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}
