<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth; 
use Football; 

class Helper implements HelperContract
{

          /**
           * Sends an email(blade view or text) to the recipient
           * @param String $to
           * @param String $subject
           * @param String $data
           * @param String $view
           * @param String $image
           * @param String $type (default = "view")
           **/
           function sendEmail($to,$subject,$data,$view,$type="view")
           {
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject){
                           $message->from('safebets@disenado.com.ng',"SafeBets");
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject){
                           $message->from('safebets@disenado.com.ng',"SafeBets");
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }          
  
           function createUser($data)
           {
           	$ret = User::create(['fname' => $data['fname'], 
                                                      'lname' => $data['lname'],                                                      
                                                      'phone' => $data['phone'], 
                                                      'email' => $data['email'], 
                                                      'role' => $data['role'], 
                                                      'password' => bcrypt($data['password']), 
                                                      ]);
                                                      
                return $ret;
           }  

           function getFixtures($id,$filter)
           {
			$ret = [];
           	$fixtures = Football::getLeagueFixtures($id,"",$filter);
					   #dd($fixtures);
					   foreach($fixtures->fixtures as $f)
					   {
						   $temp = [];
						   
						   $href = $f->_links->self->href;
						   $u = parse_url($href);
                           $path = $u['path'];
                           $id = explode("/v1/fixtures/",$path);
					       $temp['href'] = $id[1]; 
						   
					       $d = Carbon::parse($f->date);
					       $temp['d'] = $d->format("jS F, Y h:i A");
						   
						   $temp['vs'] = $f->homeTeamName." vs ".$f->awayTeamName;
						   $temp['status'] = $f->status;
						   $temp['home'] = isset($f->result->goalsHomeTeam) ? $f->result->goalsHomeTeam : null;
						   $temp['away'] = isset($f->result->goalsAwayTeam) ? $f->result->goalsAwayTeam : null;
						   
						   $temp['homeExtraTime'] = isset($f->result->extraTime->goalsHomeTeam) ? $f->result->extraTime->goalsHomeTeam : null;
						   $temp['awayExtraTime'] = isset($f->result->extraTime->goalsAwayTeam) ? $f->result->extraTime->goalsAwayTeam : null;
						   
						   $temp['homePK'] = isset($f->result->penaltyShootout->goalsHomeTeam) ? $f->result->penaltyShootout->goalsHomeTeam : null;
						   $temp['awayPK'] = isset($f->result->penaltyShootout->goalsAwayTeam) ? $f->result->penaltyShootout->goalsAwayTeam : null;
						   
						   array_push($ret,$temp);
					   }
                return $ret;
           }   
		   
		   function getAds()
		   {
			   $ret = [];
			   
			   $ads = ["img/portfolio/thumbnails/1.jpg","img/portfolio/thumbnails/2.jpg","img/portfolio/thumbnails/3.jpg",
					   "img/portfolio/thumbnails/4.jpg","img/portfolio/thumbnails/5.jpg","img/portfolio/thumbnails/6.jpg",];
			   
			   shuffle($ads);
			   
			   for($i=0; $i < 3; $i++) array_push($ret,$ads[$i]);
			   
			   return $ret;
		   }		   
		   
		   function getGames($type)
		   {
			   $ret = [];
			   shuffle($ret);
			   
			   return $ret;
		   }		   
		   
		   function getBetSlipsPurchased($user)
		   {
			   $ret = [];
			   
			   $temp = [];
			   
			   $temp["id"] = "455633";	
			   $temp["game-status"] = "fail";
			   $temp["status"] = "paid";
			   $temp["type"] = "single";
			   $temp["category"] = "regular";
			   $temp["user-2"] = "arsenalfan69";
			   $temp["date"] = date("js F, Y h:i A");
			   array_push($ret,$temp);			   
			   
			   $temp = [];
			   
			   $temp["id"] = "320459";	
			   $temp["game-status"] = "win";
			   $temp["status"] = "sold";
			   $temp["category"] = "premium";
			   $temp["type"] = "multi";
			   $temp["user-2"] = "Oshozondi442";
			   $temp["date"] = date("js F, Y h:i A");
			   array_push($ret,$temp);
			   
			   return $ret;
		   }
		   
		   function getBetSlip($id)
		   {
			   $ret  = [["17th May, 2018 12:29 PM","Chelsea v Manchester United","Over 1.5","1 - 0","fail"],
			 ["17th May, 2018 12:29 PM","Bayern Munich v PSG","Over 2.5","3 - 2","win"],
			 ["17th May, 2018 12:29 PM","Liverpool v AS Roma","Over 2.5","5 - 3","win"],
	        ];
			   
			   return $ret;
		   }
   
}
?>