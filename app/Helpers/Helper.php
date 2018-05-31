<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth; 
use Football; 
use App\User;
use App\Tickets;
use App\Predictions;
use App\Purchases;
use App\Settings;
use App\Tokens;
use App\Countries;
use App\Competitions;
use App\Teams;

class Helper implements HelperContract
{
	
	     public $otherLeagues = [];

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
													  'username' => $data['username'], 
                                                      'role' => "punter", 
                                                      'password' => bcrypt($data['pass']), 
                                                      ]);
                                                      
                return $ret;
           }           
		   
		   function addCountry($data)
           {
           	$ret = Countries::create(['name' => $data['name']]);
                                                      
                return $ret;
           }  		   
		   
		   function addCompetition($data)
           {
           	$ret = Competitions::create(['country_id' => $data['country_id'],
									  'name' => $data['name'],
			                         ]);
                                                      
                return $ret;
           }		   
		   
		   function addTeam($data)
           {
           	$ret = Teams::create(['competition_id' => $data['competition_id'],
									  'uid' => $data['uid'],
									  'name' => $data['name'],
			                         ]);
                                                      
                return $ret;
           }  		   
		   
		   function addPrediction($data)
           {
			$ret = []; $dataString = "";
			
			if($data["md"] == "fxt")
			{
				$ret = [];
				//lg_lgh_fx_fxh;
				$dataString = $data["lg"]."_".$data["lgh"]."_".$data["fx"]."_".$data["fxh"];
			}
			
			else if($data["md"] == "mt")
			{
				$ret = [];
				//ct_cth_cc_cch_ho_hoh_aw_awh_dy
				$dataString = $data["ct"]."_".$data["cth"]."_".$data["cc"]."_".$data["cch"]."_".$data["ho"]."_".$data["hoh"]."_".$data["aw"]."_".$data["awh"]."_".$data["dy"];
			}
			
			$ret["ticket_id"] = $data["ticket_id"];
			$ret["data"] = $dataString;
			$ret["md"] = $data["md"];
			$ret["prediction"] = $data["pd"];
			$ret["outcome"] = "uncleared";
           	$p = Predictions::create($ret);
                                                      
            return $p;
           }  		   
		   
		   function addBetSlip($data)
           {
			   $ssp = $data["ssp"];
			   $type = count($ssp) > 1 ? "multi" : "single";
			   
			   $betslip = Tickets::create(['type' => $type,
									  'user_id' => $data['user_id'],
									  'category' => $data['category'],
									  'total_odds' => $data['total_odds'],
									  'booking_code' => $data['booking_code'],
									  'result' => "uncleared",
			                         ]);
			   
			   foreach($ssp as $d)
			   {
				   $d['ticket_id'] = $betslip->id;
			      $this->addPrediction($d);			  
			   }
			   
			   return $betslip;
           }  		   
		   

           function setCategory($user,$c)
		   {
			   $settings = Settings::where("user_id",$user->id)->first();
			   
			   if($settings == null) Settings::create(["user_id" => $user->id,"category" => $c]);
			   $settings->update(["category" => $c]);
		   }           
		   
		   function getCategory($user)
		   {
			   $ret = "Unverified";
			   $settings = Settings::where("user_id",$user->id)->first();
			   
			   if($settings != null) $ret = $settings->category;
			   
			   return $ret;
		   }             
		   
		   function getOtherLeagues()
		   {
			   $ret = $this->otherLeagues;
			   return $ret;
		   }           
		   
		   function getCountries()
		   {
			   $ret = [];
			   
			   $countries = Countries::all();
			   
			   foreach($countries as $country)
			   {
				   $temp = [];
				   $temp["id"] = $country->id;
				   $temp["name"] = $country->name;
				   array_push($ret,$temp);
				   
			   }
			   return $ret;
		   }		   
		   
		   function getCompetitions($country)
		   {
			   $ret = [];
			   
			   $competitions = Competitions::where("country_id",$country)->get();
			   
			   foreach($competitions as $competition)
			   {
				   $temp = [];
				   $temp["id"] = $competition->id;
				   $temp["name"] = $competition->name;
				   array_push($ret,$temp);
			   }
			   return $ret;
		   }		   
		   
		   function getTeams($competition)
		   {
			   $ret = [];
			   
			   $teams = Teams::where("competition_id",$competition)->get();
			   
			   foreach($teams as $team)
			   {
				   $temp = [];
				   $temp["uid"] = $team->uid;
				   $temp["name"] = $team->name;
				   array_push($ret,$temp);
			   }
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
		   
		   function getFixture($id)
           {
			$ret = [];
           	$fixtures = Football::getFixture($id);
			
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
		   
		   function getGames($user,$type)
		   {
			   $ret = [];
			   $games = null;
			   
			   if($type == "today") $games = Tickets::all();
			   else if($type == "premium") $games = Tickets::where("category","premium")->get();
			   else if($type == "regular") $games = Tickets::where("category","regular")->get();
			   
			   if($games != null)
			   {
				   foreach($games as $g)
				   {
					   $temp = [];
					   $temp["date"] = $g->created_at->format("jS F, Y h:i A");
					   $temp["id"] = $g->id;
					   $temp["category"] = $g->category;
					   $temp["type"] = $g->type;
					   $temp["odds"] = $g->total_odds;
					   $seller = User::where('id',$g->user_id)->first();
					   $temp["seller"] = $seller->username;
					   
					   
					   $ct = "";
					   if($g->category == "premium" && $g->type == "single") $ct = "ps";
					   else if($g->category == "premium" && $g->type == "multi") $ct = "pm";
					   else if($g->category == "regular" && $g->type == "single") $ct = "rs";
					   else if($g->category == "regular" && $g->type == "multi") $ct = "rm";
					   $temp["ct"] = $ct;
					   
					   $al = "np";
					   if($user != null)
					   {
						   $isAllowed = Purchases::where('ticket_id',$g->id)
					                         ->where('buyer_id',$user->id)->first();						
						   if($isAllowed != null) $al = "py";
					   }
					   
						 $temp["al"] = $al;
					   
					    array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }		   
		   
		   function getUsers()
		   {
			   $ret  = [];
			   
			   $users = User::where('role',"punter")->orWhere('role',"expert")->get();
			   
			   if($users != null)
			   {
				   foreach($users as $user)
				   {
					   $temp = [];
					   $temp['id'] = $user->id;
					   $temp['date'] = $user->created_at->format("jS F, Y h:i A");
					   $temp['name'] = $user->fname." ".$user->lname;
					   $temp['username'] = $user->username;
					   $temp['status'] = $user->status;
					   $temp['email'] = $user->email;
					   $temp['phone'] = $user->phone;
					   $temp['role'] = $user->role;
					   array_push($ret,$temp);
				   }
			   }
			   
			   
			   return $ret;
		   }		   
		   
		   function getUser($id)
		   {
			   $ret  = [];
			   
			   $users = User::where('id',$id)->first();
			   
			   if($user != null)
			   {
					   $ret['id'] = $user->id;
					   $ret['date'] = $user->created_at->format("jS F, Y h:i A");
					   $ret['name'] = $user->fname." ".$user->lname;
					   $ret['username'] = $user->username;
					   $ret['status'] = $user->status;
					   $ret['email'] = $user->email;
					   $ret['phone'] = $user->phone;
					   $ret['role'] = $user->role;
			   }
			   
			   
			   return $ret;
	        
		   }		   
		   
		   function getBetSlips()
		   {
			   $ret = [];
			   
				   $betslips = Tickets::all();
				   if($betslips != null)
				   {   
					   foreach($betslips as $ticket)
					   {
					   $temp = [];
					   $temp["id"] = $ticket->id;
					   $temp["date"] = $ticket->created_at->format("jS F, Y h:i A");
					   $temp["status"] = $ticket->result;
					   $seller = User::where('id',$ticket->user_id)->first();
					   $temp["seller"] = $seller->username;
					   $temp["product"] = $ticket->type;
					   $temp["odds"] = $ticket->total_odds;
					   $temp["category"] = $ticket->category;
					   $temp["booking-code"] = $ticket->booking_code;
					   $temp["matches"] = [];
					   
					   $matches = Predictions::where('ticket_id',$ticket->id)->get();
					   
					   foreach($matches as $m)
					   {
						   $fixture = $this->getFixture($m->fixture_id);
						   $fixtureMatch = $fixture["match"];
						   $fixtureDate = $fixture["date"];
						   $fixtureOutcome = $fixture["outcome"];
						   
						   $prediction = $m->prediction;
						   $outcome = $m->outcome;
						   
						   $temp2 = [$fixtureDate,$fixtureMatch,$prediction,$fixtureOutcome,$outcome];
						   array_push($ret["matches"],$temp2);
					   }
						   array_push($ret,$temp);
					   }
				   }
			   
			   return $ret;
		   }		   
		   
		   function getUserBetSlips($user)
		   {
			   $ret = [];
			   
			   $allBetSlipIDs = [];
			   $sb = Tickets::where('user_id',$user->id)->get();
			   
			   if($sb != null)
			   {
				   foreach($sb as $s)
				   {
					   array_push($allBetSlipIDs,$s->id);
				   }
			   }
			   
			   $purchases = $this->getUserPurchases($user);
				   if(count($purchases) > 0)
				   {   
					   foreach($purchases as $p)
					   {						 
					     array_push($allBetSlipIDs,$p['bs-id']);
					   }
				   }
				   
				   $allBetSlipIDs = array_unique($allBetSlipIDs);
			       
				   foreach($allBetSlipIDs as $abs)
				   {
					   $temp = [];
					   $temp = $this->getBetSlip($abs);
					   array_push($ret,$temp);
				   }
			   return $ret;
		   }		   
		   
		   
		   function getBetSlip($id)
		   {
			   $ret  = [];
			   
				   $ticket= Tickets::where('id',$id)->first();
				   
				   if($ticket != null)
				   {
					   $temp = [];
					   $temp["id"] = $ticket->id;
					   $temp["date"] = $ticket->created_at->format("jS F, Y h:i A");
					   $temp["status"] = $ticket->result;
					   $seller = User::where('id',$ticket->user_id)->first();
					   $temp["seller"] = $seller->username;
					   $temp["product"] = $ticket->type;
					   $temp["odds"] = $ticket->total_odds;
					   $temp["category"] = $ticket->category;
					   $temp["booking-code"] = $ticket->booking_code;
					   $temp["matches"] = [];
					   
					   $matches = Predictions::where('ticket_id',$ticket->id)->get();
					   
					   foreach($matches as $m)
					   {
						   $temp_2 = [];
						   $fixtureDate = ""; $fixtureMatch = ""; $fixtureResult = "";
						   
						   $dataString = $m->data;
						   $md = $m->md;
						   $prediction = $m->prediction;
						   $outcome = $m->outcome;
						   
						   $data = explode("_",$dataString);
						   
						   //mt: ct_cth_cc_cch_ho_hoh_aw_awh_dy
						   if($md == "mt")
						   {
							   $fixtureDate = $data[8];
							   $fixtureMatch = $data[3].": ".$data[5]." vs ".$data[7];
							   $fixtureResult = "0 - 0";
						   }						   
						   
						   else if($md == "fxt")
						   {
							   
						   }
						   
						   $temp_2 = [$fixtureDate,$fixtureMatch,$prediction,$fixtureResult,$outcome];
						   array_push($temp["matches"],$temp_2);
					   }
				   }
			   $ret = $temp; 
			   return $ret;
		   }		   
		   
		   function markBetSlip($id,$result)
		   {
			   $betslip = Tickets::where('id',$id)->first();
			   
			   if($betslip != null)
			   {
				   $status = "";
				   if($result == "quee") $status = "win";
				   else if($result == "abra") $status = "loss";
				   
				   $betslip->update(['result' => $status]);
			   }
			   
			   return "ok";
		   }				   
		   
		   function markGame($id,$result)
		   {
			   $game = Predictions::where('id',$id)->first();
			   
			   if($game != null)
			   {
				   $status = "";
				   if($result == "quee") $status = "win";
				   else if($result == "abra") $status = "loss";
				   
				   $game->update(['outcome' => $status]);
			   }
			   
			   return "ok";
		   }		   
		   
		   function getTokenBalance($user)
		   {
			   $ret = 0;
			   
			   if($user != null)
			   {
				   $tk = Tokens::where('user_id',$user->id)->first();
				   if($tk != null) $ret = $tk->balance;
			   }
			   
			   return $ret;
		   }		   
		   
		   function getTotalBetSlipsPurchased($user)
		   {
			   $ret = 0;
			   
			   if($user != null)
			   {
				   $purchases = Purchases::where('buyer_id',$user->id)->get();
				   if($purchases != null) $ret = count($purchases);
			   }
			   
			   return $ret;
		   }		 
		   function getTotalBetSlipsSold($user)
		   {
			   $ret = 0;
			   
			   if($user != null)
			   {
				   $purchases = Purchases::where('seller_id',$user->id)->get();
				   if($purchases != null) $ret = count($purchases);
			   }
			   
			   return $ret;
		   }		   
		   
		   function getUserPurchases($user)
		   {
			   $ret = [];
			   
				   $purchases = Purchases::where("buyer_id",$user->id)->orWhere("seller_id",$user->id)->get();
				   if($purchases != null)
				   {
					   $ret = [];
					   
					   foreach($purchases as $p)
					   {
						   $temp = [];
						   $t = Tickets::where('id',$p->ticket_id)->first();
						   $temp["date"] = $p->created_at->format("jS F, Y h:i A");
						   $temp["id"] = $p->id;
						   $temp["bs-id"] = $p->ticket_id;
						   
						   $type = $t->type;
						   if($type == "single") $typeText = "Single-game bet slip";
						   else if($type == "multi") $typeText = "Multi-game bet slip";
						   $temp["product"] = $typeText;
						   				
						   $temp["category"] = $t->category;
						   
						   $temp["status"] = $p->status;
						   
						   $buyer = User::where('id',$p->buyer_id)->first();
						   $seller = User::where('id',$p->seller_id)->first();
						   
						   $temp["buyer"] = $buyer->username;
						   $temp["seller"] = $seller->username;
						   array_push($ret,$temp);
					   }
				   }
			   
			   return $ret;
		   }		   
		   
		   function enable($user_id)
		   {
			   $u = User::where('id',$user_id)->first();
			   
			   if($u != null)
			   {
				   $u->update(['status' => "enabled"]);
			   }
			   
			   return $ret;
		   }		   
		   
		   function disable($user_id)
		   {
			   $u = User::where('id',$user_id)->first();
			   
			   if($u != null)
			   {
				   $u->update(['status' => "disabled"]);
			   }
			   
			   return $ret;
		   }
		   
		   function getPurchases()
		   {
			   $ret = [];
			   
				   $purchases = Purchases::all();
				   if($purchases != null)
				   {
					   $ret = [];
					   
					   foreach($purchases as $p)
					   {
						   $temp = [];
						   $t = Tickets::where('id',$p->ticket_id)->first();
						   $temp["date"] = $p->created_at->format("jS F, Y h:i A");
						   $temp["id"] = $p->id;
						   $temp["bs-id"] = $p->ticket_id;
						   
						   $type = $t->type;
						   if($type == "single") $typeText = "Single-game bet slip";
						   else if($type == "multi") $typeText = "Multi-game bet slip";
						   $temp["product"] = $typeText;
						   				
						   $temp["category"] = $t->category;
						   
						   $temp["status"] = $p->status;
						   
						   $buyer = User::where('id',$p->buyer_id)->first();
						   $seller = User::where('id',$p->seller_id)->first();
						   
						   $temp["buyer"] = $buyer->username;
						   $temp["seller"] = $seller->username;
						   array_push($ret,$temp);
					   }
				   }
			   
			   return $ret;
		   }	
}
?>
