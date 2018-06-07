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
													  'sub' => $data['sub'], 
                                                      'role' => "punter", 
                                                      'status' => "active", 
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
			$ret["scoreline"] = "";
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
									  'bsite' => $data['bsite'],
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
			   else $settings->update(["category" => $c]);
		   }           
		   
		   function getCategory($user)
		   {
			   $ret = "unverified";
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
			   
			   $countries = Countries::orderBy('created_at',"DESC")->get();
			   
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
			   
			   $ads = [ /**["img" => "img/portfolio/thumbnails/1.jpg", "href" => "#"],
			            ["img" => "img/portfolio/thumbnails/2.jpg", "href" => "#"],
			            ["img" => "img/portfolio/thumbnails/3.jpg", "href" => "#"],
			            ["img" => "img/portfolio/thumbnails/4.jpg", "href" => "#"],
			            ["img" => "img/portfolio/thumbnails/5.jpg", "href" => "#"],
			            ["img" => "img/portfolio/thumbnails/6.jpg", "href" => "#"],**/
			            ["img" => "img/sbimages/ad-1.jpeg", "href" => "http://www.informationhood.com/top-7-best-betting-websites-companies-nigeria"],
			            ["img" => "img/sbimages/ad-2.jpeg", "href" => "http://www.nairabet.com"],
			            ["img" => "img/sbimages/gif-1.gif", "href" => "#"],
			            ["img" => "img/sbimages/ad-3.jpeg", "href" => "http://www.nairabet.com"],
			            ["img" => "img/sbimages/ad-4.jpeg", "href" => "http://www.nairabet.com"],
						["img" => "img/sbimages/gif-2.gif", "href" => "#"],
			            ["img" => "img/sbimages/ad-5.jpeg", "href" => "http://www.nairabet.com"],
			            ["img" => "img/sbimages/ad-6.png", "href" => "http://bet9ja.com"],
			            ["img" => "img/sbimages/ad-7.jpeg", "href" => "#"],
			            ["img" => "img/sbimages/ad-8.jpeg", "href" => "http://bet9ja.com"],
						["img" => "img/sbimages/gif-3.gif", "href" => "#"],
			            ["img" => "img/sbimages/ad-9.jpeg", "href" => "http://bet9ja.com"],
			            ["img" => "img/sbimages/ad-10.jpeg", "href" => "http://bet9ja.com"],
			            ["img" => "img/sbimages/ad-11.jpeg", "href" => "#"],
                      ];
			   
			   shuffle($ads);
			   
			   for($i=0; $i < 3; $i++) array_push($ret,$ads[$i]);
			   
			   return $ret;
		   }		   
		   
		   function getGames($user,$type)
		   {
			   $ret = [];
			   $games = null;
			   
			   if($type == "today") $games = Tickets::orderBy('created_at',"DESC")->get();
			   else if($type == "premium") $games = Tickets::where("category","premium")->orderBy('created_at',"DESC")->get();
			   else if($type == "regular") $games = Tickets::where("category","regular")->orderBy('created_at',"DESC")->get();
			   
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
					   
					   
					   $ct = "uv";
					   if($g->category == "premium" && $g->type == "single") $ct = "ps";
					   else if($g->category == "premium" && $g->type == "multi") $ct = "pm";
					   else if($g->category == "regular" && $g->type == "single") $ct = "rs";
					   else if($g->category == "regular" && $g->type == "multi") $ct = "rm";
					   $temp["ct"] = $ct;
					   
					   $al = "np";
					   
					   if($user == null)
					   {
						   $al = "lg";
					   }
					   else
					   {
						   $isAllowed = Purchases::where('ticket_id',$g->id)
					                         ->where('buyer_id',$user->id)						
					                         ->orWhere('seller_id',$user->id)->first();
											 
						   $isMine = Tickets::where('id',$g->id)
						                    ->where('user_id',$user->id)->first();
											 
						   if($isAllowed != null || $isMine != null) $al = "py";
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
			   
			   $user = User::where('id',$id)->first();
			   
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
			   
				   $betslips = Tickets::orderBy('created_at',"DESC")->get();
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
					   $temp["bsite"] = $ticket->bsite;
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
							   $fixtureResult = $m->scoreline;
						   }						   
						   
						   else if($md == "fxt")
						   {
							   
						   }
						   
						   $temp_2 = [$fixtureDate,$fixtureMatch,$prediction,$fixtureResult,$outcome];
						   array_push($temp["matches"],$temp_2);
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
					   $temp["bsite"] = $ticket->bsite;
					   $temp["booking-code"] = $ticket->booking_code;
					   $temp["matches"] = [];
					   
					   $matches = Predictions::where('ticket_id',$ticket->id)->get();
					   
					   foreach($matches as $m)
					   {
						   $temp_2 = [];
						   $fixtureDate = ""; $fixtureMatch = ""; $fixtureResult = "";
						   
						   $dataString = $m->data;
						   $md = $m->md;
						   $mid = $m->id;
						   $prediction = $m->prediction;
						   $outcome = $m->outcome;
						   
						   $data = explode("_",$dataString);
						   
						   //mt: ct_cth_cc_cch_ho_hoh_aw_awh_dy
						   if($md == "mt")
						   {
							   $fixtureDate = $data[8];
							   $fixtureMatch = $data[3].": ".$data[5]." vs ".$data[7];
							   $fixtureResult = $m->scoreline;
						   }						   
						   
						   else if($md == "fxt")
						   {
							   
						   }
						   
						   $temp_2 = [$fixtureDate,$fixtureMatch,$prediction,$fixtureResult,$outcome,$mid];
						   array_push($temp["matches"],$temp_2);
					   }
				   }
			   $ret = $temp; 
			   return $ret;
		   }		   
		   
		   function markBetSlip($id,$status)
		   {
			   $betslip = Tickets::where('id',$id)->first();
			   
			   if($betslip != null)
			   {
				   $ret = "";
				   if($status == "quee") $ret = "win";
				   else if($status == "abra") $ret = "loss";
				   
				   $betslip->update(['result' => $ret]);
			   }
			   
			   return "ok";
		   }				   
		   
		   function markGame($id,$status)
		   {
			   $game = Predictions::where('id',$id)->first();
			   
			   if($game != null)
			   {
				   $ret = "";
				   if($status == "quee") $ret = "win";
				   else if($status == "abra") $ret = "loss";
				   
				   $game->update(['outcome' => $ret]);
			   }
			   
			   return "ok";
		   }

		   function addScoreLine($data)
		   {
			   $pid = $data["pid"];
			   $sc = $data["sc"];
			   
			   $game = Predictions::where('id',$pid)->first();
			   
			   if($game != null)
			   {
				   $game->update(['scoreline' => $sc]);
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
						 
						   $temp["date"] = $p->created_at->format("jS F, Y h:i A");
						   $temp["id"] = $p->id;
						   
						   $typeText = "";
						   
						   $pt = $p->type;
						   
						   if($pt == "betslip")
						   {
							   $temp["bs-id"] = $p->ticket_id;
							   $t = Tickets::where('id',$p->ticket_id)->first();
							   $type = $t->type;
							   if($type == "single") $typeText = "Single-game bet slip";
						       else if($type == "multi") $typeText = "Multi-game bet slip";
							   
							   $temp["category"] = $t->category;
						   }
						   
						   elseif($pt == "tokens")
						   {
							    $typeText = "Tokens";   
								$temp["category"] = "Tokens";
						   }
						   
						   $temp["product"] = $typeText;
						   $temp["qty"] = $p->qty;

							   $buyer = User::where('id',$p->buyer_id)->first();
							   $temp["buyer"] = $buyer->username;

							   $seller = User::where('id',$p->seller_id)->first();
							   $temp["seller"] = $seller->username;
							   
						   $temp["status"] = $p->status;
						   						   
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
				   $u->update(['status' => "active"]);
			   }
		   }		   
		   
		   function disable($user_id)
		   {
			   $u = User::where('id',$user_id)->first();
			   
			   if($u != null)
			   {
				   $u->update(['status' => "disabled"]);
			   }
		   }
		   
		   function getPurchases()
		   {
			   $ret = [];
			   
				   $purchases = Purchases::orderBy('created_at',"DESC")->get();
				   if($purchases != null)
				   {
					   $ret = [];
					   
					   foreach($purchases as $p)
					   {
						   $temp = [];
						 
						   $temp["date"] = $p->created_at->format("jS F, Y h:i A");
						   $temp["id"] = $p->id;
						   
						   $typeText = "";
						   
						   $pt = $p->type;
						   $temp["category"] = "";
						   
						   if($pt == "betslip")
						   {
							   $temp["bs-id"] = $p->ticket_id;
							   $t = Tickets::where('id',$p->ticket_id)->first();
							   $type = $t->type;
							   if($type == "single") $typeText = "Single-game bet slip";
						       else if($type == "multi") $typeText = "Multi-game bet slip";
							   
							   $temp["category"] = $t->category;
						   }
						   
						   elseif($pt == "tokens")
						   {
							    $typeText = "Tokens";   
								$temp["category"] = "Tokens";
						   }
						   
						   $temp["product"] = $typeText;
						   $temp["qty"] = $p->qty;

							   $buyer = User::where('id',$p->buyer_id)->first();
							   $temp["buyer"] = $buyer->username;

							   $seller = User::where('id',$p->seller_id)->first();
							   $temp["seller"] = $seller->username;
							   
						   $temp["status"] = $p->status;
						   						   
						   array_push($ret,$temp);
					   }
				   }
			   
			   return $ret;
		   }			   
		   
		   function addToPurchases($user,$dt)
		   {
			   $type = $dt['type'];
			   $p = null;
			   $data = [];
	           $data['buyer_id'] = $user->id;
			   
			   if($type == "betslip")
			   {
				   $betSlipID = $dt['id'];
			      $ticket = Tickets::where('id',$betSlipID)->first();
			   
			      if($ticket != null)
			      {
				      $data['seller_id'] = $ticket->user_id;
				      $data['ticket_id'] = $ticket->id;
                      $data['type'] = "betslip"; 					  
                      $data['qty'] = 1; 					  
			      }
			   }
			   
			   elseif($type == "tokens")
			   {
				   $data['seller_id'] = 42;
				   $data['type'] = "tokens"; 
				   $data['qty'] = $dt['qty']; 
			   }
			   
			   $data['status'] = "sold"; 
			   $p = Purchases::create($data);
			   
			   return $p;
		   }		   
		   
		   function buyGame($user,$data)
		   {
			   $ret = ["status" => "unkown"];
			   $userTokens = $this->getTokenBalance($user);
			   $amount = 0; $allowed = false; $buying = false;
			   
			   $al = $data["al"]; $ct = $data["ct"]; $id = $data["id"];
			   
			   if($al == "py" || $al == "mn"){ $allowed = true; }
			   else
			   {
				   if($ct == "rs") $amount = 1;
				   elseif($ct == "rm") $amount = 2;
			       elseif($ct == "ps") $amount = 4;
			       elseif($ct == "pm") $amount = 8;
			   
			       $allowed = $userTokens >= $amount ? true: false;
				   $buying = true;
			   }
			   
			   if($allowed)
			   {
				   if($buying)
				   {
					   if($amount > 0)
					   {
						  //deduct tokens and register transaction
					      $this->removeTokens($user,$amount);
					      $dat = ["type" => "betslip", "id" => $id];
					      $p = $this->addToPurchases($user,$dat);   
					   }
				   }
				   $ret = $this->getBetSlip($id);
				   $ret["opstatus"] = "ok";
			   }
			   
			   else
			   {
				   $ret["opstatus"] = "error";
				   $ret["error"] = "insufficient-funds";
			   }
			   
			   return $ret;
		   }			   
		   
		   function getSettings($user)
		   {
			   $ret = [];
			   $tokens = $this->getTokenBalance($user);
			   $settings = Settings::where('user_id',$user->id)->first();
			   
			   if($settings != null)
			   {
				   $ret["fname"] = $user->fname;
				   $ret["lname"] = $user->lname;
				   $ret["phone"] = $user->phone;				   
				   
				   $ret["balance"] = $tokens;
				   $ret["category"] = $settings->category;
				   $ret["status"] = $user->status;   
			   }
			   
			   
			   return $ret;
		   }	
		   
           function updateSettings($user,$data)
		   {
			   $this->setCategory($user,$data['category']);
			   $user->update(["fname" =>$data['fname'],
			                  "lname" =>$data['lname'],
			                  "phone" =>$data['phone'],
			                ]);
		   }            
		   
		   function addTokens($userId,$tokens)
		   {
			   $tokens = Tokens::where('user_id',$userId)->first();
			   if($tokens == null)
			   {
				   Tokens::create(["user_id" => $userId, "balance" => $tokens);
			   }
			   else
			   {
				   $balance = $token->balance; $newBalance = $balance + $tokens;
				  $tokens->update(["balance" =>$newBalance]);  
			   }
			   
		   } 		   
		   
		   function removeTokens($userId,$tokens)
		   {
			   $tokens = Tokens::where('user_id',$userId)->first();
			   if($tokens != null)
			   {
				   $balance = $token->balance; $newBalance = $balance - $tokens;
				  $tokens->update(["balance" =>$newBalance]);  
			   }
			   
		   } 

		   /**
	public function getRecentMessages();
		   **/

		   function getTotalRevenue()
		   {
			   $ret = 0;
			   $exchangeRate = $this->getExchangeRate();
			   
			   $purchases = Purchases::orderBy('status',"sold")->get();
			   
			   if($purchases != null)
			   {
				   foreach($purchases as $p)
				   {
					      $temp = 0;
						  
						   $t = Tickets::where('id',$p->ticket_id)->first();						   
						   $type = $t->type;
						   
						   if($type == "single" || $type == "multi"){
							  if($type == "single") $temp = 1;
							  else if($type == "multi") $temp = 4;
							  
							  if($t->category == "premium") $temp *= 2;
							  
							  $temp *= $exchangeRate;
						   }
						   
				           else if($type == "tokens")
						   {
							   $tk = $p->qty;
							   $temp = $tk * $exchangeRate;
						   }
						   
						   $ret += $temp;
				   }				  
			   }
			   
               return $ret;			   
		   }

		   function getTotalTokens()
		   {
			   $ret = 0;

			   $purchases = Purchases::where('status',"sold")->where('type',"tokens")->get();
			   
			   if($purchases != null)
			   {
				   foreach($purchases as $p)
				   {
						  $temp = $p->qty;			   
						   $ret += $temp;
				   }				  
			   }
			   
               return $ret;			   
		   } 

		   function getExchangeRate()
		   {
			   $ret = 125;
               return $ret;			   
		   }
		   
		   function getTotalBetSlips()
		   {
			   $ret = Tickets::count();			   
               return $ret;			   
		   } 

		   function getTotalPunters()
		   {
			   $ret = User::where('role',"punter")->count();			   
               return $ret;			   
		   } 

		   function getRecentPurchases()
		   {
			   $ret = [];
			   
				   $purchases = $this->getPurchases();
				   $pc = count($purchases);
				   
				   if($pc > 0)
				   {
                       if($pc <= 4) $count = $pc;
                       else $count = 4;					   
					   for($i = 0; $i < $count; $i++)
					   {
						   $p = $purchases[$i];
						   $temp = $p;
						   $temp['username'] = $p['buyer'];
						   $tpt = $p['product'];
						   
						   if($tpt == "Tokens")
						   {
							   $temp['product'] = $tpt;
							   $temp['category'] = "Tokens";
						   }
						   
						   else
						   {
							   $temp['product'] = $tpt.", ".$p["category"];
						   }
						   						   
						   
						   array_push($ret,$temp);
					   }
				   }
			   
			   return $ret;
		   }

		   function getRecentMessages()
		   {
			   $ret = [];
			   
			   
			   return $ret;
		   }			   

		   
}
?>
