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
        
        $validator = Validator::make($req, [
                             'password' => 'required|min:6',
                             'email' => 'required|email|exists:users'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	//authenticate this login
            if(Auth::attempt(['email' => $req['email'],'password' => $req['password']]))
            {
            	//Login successful               
               $user = Auth::user();          
           
               if($user->role == "admin"){return redirect()->intended('/');}
               else if($user->role == "seller"){return redirect()->intended('experts');}
               if($user->role == "buyer"){return redirect()->intended('dashboard');}
               else{return redirect()->intended('/');}
            }
         }        
    }
	
    public function postRegister(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'password' => 'required|confirmed',
                             'email' => 'required|email',
                             'fname' => 'required',
                             'lname' => 'required',
                             'phone' => 'required|numeric',
                             #'g-recaptcha-response' => 'required',
                             'terms' => 'accepted',
                             'role' => 'required',
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
    
    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}
