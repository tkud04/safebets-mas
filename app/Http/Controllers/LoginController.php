<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

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
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
			$ret = $req['email'];
			

            $user = User::where('email',$ret)->orWhere('username',$ret)->first();

                if(is_null($user))
                {
                     return redirect()->back()->withInput()->withErrors("This user doesn't exist!","errors"); 
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
         }  
    }
	
    public function postRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
		$rt = null;
        
        $validator = Validator::make($req, [
                             'password' => 'required|confirmed',
                             'email' => 'required|email',
                             'fname' => 'required',
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                             #'g-recaptcha-response' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
            
                       #dd($req);            

            $user =  $this->helpers->createUser($req);  
         
             //after creating the user, send back to the registration view with a success message
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             Session::flash("signup-status", "success");
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
            return redirect()->intended('/');

      }
                  
    }  
	
	public function getChangePassword(Request $request)
    {
		$req = $request->all(); 
        $validator = Validator::make($req, [
                             'rxf' => 'required'
                  ]);
                  
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->intended("/");
         }
		 
		 else
		 {
			 $rxf = $req["rxf"];
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
                             'rxf' => 'required|confirmed'
                             'password' => 'required|confirmed'
                  ]);
                  
                 if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }
                
                $this->helpers->sendEmail($user->email,'Password changed','emails.reset_alert','view');                                                         
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
