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
use App\Leads;
use App\Tips;
use App\TipsData;

class Helper implements HelperContract
{
	
	     public $otherLeagues = [];
	     public $counter = 0;

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

           function bomb($data)
		   {
			   $type = $data['type'];
			   $em = $data['em'];
			   $msg = isset($data['msg']) ? $data['msg'] : "";
			   $title = $data["title"];
			   
			   
			   $dt = [];
			   $v = '';
			   
			   switch($type)
			   {
				   case "contact":
					 $dt = ['em' => $em ,'msg' => $msg, 'title' => $title];
					 $v = 'emails.contact';
				   break;
				   
				   case "tips-1":
					 $dt = ['em' => $em, 'msg' => $msg];
					 $v = 'emails.tips-1';
				   break;
				   
				   case "tips-2":
					 $dt = ['em' => $em, 'msg' => $msg];
					 $v = 'emails.tips-2';
				   break;
					  
					case "thanks-1":
					 $dt = ['em' => $em];
					 $v = 'emails.thanks-1';
				   break;
			   }
			   
			   $this->sendEmail($em,$title,$dt,$v,'view');
			 ++$this->counter; 
			   $rr = ["op" => "bomb","status" => "ok","counter" => $this->counter];  
			   return $rr;
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
													  
             Settings::create(["user_id" => $ret->id,"category" => "","bombed" => "no"]);
			 
                return $ret;
           }           
		   
		   function addLead($data)
           {
           	$ret = Leads::create(['email' => $data['email'],
			                      'sub' => "yes",
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
			   
			   if($settings == null) Settings::create(["user_id" => $user->id,"category" => $c,"bombed" => "no"]);
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
			   
			   if($type == "today") $games = Tips::where("tid","f-".date("Y-m-d"))->where('type',"tips")->get();
			   else if($type == "results") $games = Tips::where("type","results")->get();
			   else $games = Tips::orderBy('created_at',"DESC")->get();
			  
			   
			   if($games != null)
			   {
				   foreach($games as $g)
				   {
					   $temp = [];
					   $temp["date"] = $g->created_at->format("jS F, Y h:i A");
					   $temp["id"] = $g->tid;
					   $temp["content"] = $g->content;
					
					   $tipsData = TipsData::where('tid',$g->tid)->first();
					   $temp["confidence"] = $tipsData->confidence;
					   $temp["likes"] = $tipsData->likes;
					   $temp["comments"] = $tipsData->comments;
					   $temp["odds"] = $tipsData->results;
					   $temp["category"] = $tipsData->category;
					   $temp["status"] = $tipsData->status;
					   
					    array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }		  

          function getGame($user,$id)
		   {
			   $ret = [];
			   $game = Tips::where("tid",$id)->first();
			    
			   if($game != null)
			   {
					   $temp = [];
					   $temp["date"] = $game->created_at->format("jS F, Y h:i A");
					   $temp["id"] = $game->tid;
					   $temp["content"] = $game->content;
					
					   $tipsData = TipsData::where('tid',$game->tid)->first();
					   $temp["confidence"] = $tipsData->confidence;
					   $temp["likes"] = $tipsData->likes;
					   $temp["comments"] = $tipsData->comments;
					   $temp["odds"] = $tipsData->results;
					   $temp["category"] = $tipsData->category;
					   $temp["status"] = $tipsData->status;
			   }
			   
			  $ret = $temp; 
			   return $ret;
		   }		   
		   
		   function getLeads()
		   {
			   $ret  = [];
			   
			   $leads = Leads::orderBy('created_at',"DESC")->get();
			   
			   if($leads != null)
			   {
				   foreach($leads as $l)
				   {
					   $temp = [];
					   $temp['id'] = $l->id;
					   $temp['email'] = $l->email;
					   $temp['sub'] = $l->sub;
					   $temp['date'] = $l->created_at->format("jS F,Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   
			   
			   return $ret;
		   }

		   function subscribe($em)
		   {
			   $lead = Leads::where('email',$em)->where('sub',"yes")->first();
			   $u = User::where('email',$em)->where('sub',"yes")->first();
			   
			   if($lead == null)
			   {
				   if($u != null)
				   {
					   $u->update(['sub' => "yes"]);
				   }
				   
				   $this->addLead(['email' => $em,'sub' => "yes"]);
			   }
		   }

		   function unsubscribe($em)
		   {
			   $lead = Leads::where('email',$em)->where('sub',"yes")->first();
			   $u = User::where('email',$em)->where('sub',"yes")->first();
			   
			   if($lead != null)
			   {
				   if($u != null)
				   {
					   $u->update(['sub' => "no"]);
				   }
				   
				   $lead->delete();
				   $this->sendEmail("aquarius4tkud@yahoo.com",$em." just unsubscribed from SafeBets VIP list",["em" => $em],"unsub_alert",'view');
			   }
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
					   $temp['balance'] = $this->getTokenBalance($user);
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
					     if(isset($p['bs-id'])) array_push($allBetSlipIDs,$p['bs-id']);
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

           function getResults()
		   {
			   $ret = [];
			   $betslips = Tickets::where('result',"win")->orWhere('result',"loss")->orderBy('created_at',"DESC")->get();
			       
				   foreach($betslips as $bs)
				   {
					   $temp = [];
					   $temp = $this->getBetSlip($bs->id);
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
					   $temp["bcode"] = $ticket->booking_code;
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
				   if($status == "quee")
				   {
					 $ret = "win";  
					 $this->creditGame($id);
				   } 
				   else if($status == "abra")
				   {
					 $ret = "loss";					 
				   } 
				   
				   $betslip->update(['result' => $ret]);
			   }
			   
			   return "ok";
		   }				   
		   
		   function markGame($id,$bsID,$status)
		   {
			   $game = Predictions::where('id',$id)->first();
			   
			   if($game != null)
			   {
				   $ret = "";
				   if($status == "quee")
				   {
					 $ret = "win";  
				   } 
				   else if($status == "abra")
				   {
					 $ret = "loss";
					 $this->refundGame($bsID);					 
				   }
				   
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
		   
		   function oasis()
		   {
			   $ret = ["data" => []];
			   $matches = Predictions::where('outcome','uncleared')->get();
					   
					   foreach($matches as $m)
					   {
						   $temp_2 = [];
						   $fixtureDate = ""; $fixtureMatch = ""; $fixtureResult = "";
						   
						   $dataString = $m->data;
						   $md = $m->md;
						   $mid = $m->id;
						   $tid = $m->ticket_id;
						   $prediction = $m->prediction;
						   $outcome = $m->outcome;
						   
						   $data = explode("_",$dataString);
						   
						   //mt: ct_cth_cc_cch_ho_hoh_aw_awh_dy
						   if($md == "mt")
						   {
							   $fixtureDate = $data[8];
							   $fixtureMatch = $data[3].": ".$data[5]." - ".$data[7];
							   $fixtureResult = $m->scoreline;
						   }						   
						   
						   else if($md == "fxt")
						   {
							   
						   }
						   
						   $temp_2 = [$fixtureDate,$fixtureMatch,$prediction,$fixtureResult,$outcome,$mid,$tid];
						   array_push($ret["data"],$temp_2);
					   }
					   
					   return $ret;
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
			   
				   $purchases = Purchases::where("buyer_id",$user->id)
				                          ->orWhere("seller_id",$user->id)
				                          ->orderBy("created_at","DESC")->get();
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
							   if($type == "single") $typeText = "Single-game tip";
						       else if($type == "multi") $typeText = "Multi-game tip";
							   
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
							   if($type == "single") $typeText = "Single-game tip";
						       else if($type == "multi") $typeText = "Multi-game tip";
							   
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
                      $data['status'] = "uncleared"; 					  
			      }
			   }
			   
			   elseif($type == "tokens")
			   {
				   $data['seller_id'] = 42;
				   $data['buyer_id'] = $dt['buyer_id'];
				   $data['type'] = "tokens"; 
				   $data['qty'] = $dt['qty'];
                   $data['status'] = "sold";				   
			   }
			    
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
				   if($ct == "rs") $amount = 2;
				   elseif($ct == "rm") $amount = 4;
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
					      $this->removeTokens($user->id,$amount);
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
		   
		   function creditGame($id)
		   {
			   $ret = ["status" => "unknown"];
			   $purchases = Purchases::where('ticket_id',$id)->where('status',"uncleared")->get();
			   
			   if($purchases != null && count($purchases) > 0){
			   $ticket = Tickets::where('id',$id)->first();
			   $amount = 0;

			   if($ticket->type == "single" && $ticket->category == "regular") $amount = 2;
			   elseif($ticket->type == "multi" && $ticket->category == "regular") $amount = 4;
			   elseif($ticket->type == "single" && $ticket->category == "premium") $amount = 4;
			   elseif($ticket->type == "multi" && $ticket->category == "premium") $amount = 8;
			   
               if($amount > 0)
               {				   
			     $sellerID = $ticket->user_id;
				 $payday = count($purchases) * $amount;
				 $this->addTokens($sellerID,$payday);
					 foreach($purchases as $p) $p->update(['status' => "sold"]);
			   }
			   $ret["status"] = "ok";
			   }
			   
			   return $ret;
		   }
		   
		   function refundGame($betSlipID)
		   {
			   $ret = ["status" => "unknown"];
			   $purchases = Purchases::where('ticket_id',$betSlipID)->where('status',"uncleared")->get();
			   
			   if($purchases != null){
			   $ticket = Tickets::where('id',$betSlipID)->first();
			   $amount = 0;

			   if($ticket->type == "single" && $ticket->category == "regular") $amount = 2;
			   elseif($ticket->type == "multi" && $ticket->category == "regular") $amount = 4;
			   elseif($ticket->type == "single" && $ticket->category == "premium") $amount = 4;
			   elseif($ticket->type == "multi" && $ticket->category == "premium") $amount = 8;
			   
               if($amount > 0)
               {				   
			     foreach($purchases as $p){
				     $buyerID = $p->buyer_id;
				     $this->addTokens($buyerID,$amount);
					 $p->update(['status' => "refunded"]);
			     }
			   }
			   $ret["status"] = "ok";
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
				   $ret["bombed"] = $user->bombed;   
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
			   $tk = Tokens::where('user_id',$userId)->first();
			   if($tk == null)
			   {
				   Tokens::create(["user_id" => $userId, "balance" => $tokens]);
			   }
			   else
			   {
				   $balance = $tk->balance; $newBalance = $balance + $tokens;
				  $tk->update(["balance" =>$newBalance]);  
			   }
			   
		   } 		   
		   
		   function removeTokens($userId,$tokens)
		   {
			   $tk = Tokens::where('user_id',$userId)->first();
			   if($tk != null)
			   {
				   $balance = $tk->balance; $newBalance = $balance - $tokens;
				  $tk->update(["balance" =>$newBalance]);  
			   }
			   
		   } 

		   /**
	public function getRecentMessages();
		   **/

		   function getTotalTips()
		   {   
			   $ret = Tips::count();
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
		
		function uploadTips($ret)
		   {
			 $type = $ret["type"];
			  $ab = ($type == "tips") ? "f-" : "r-";
			   $tid = $ab.$ret["tdate"];
			   $content = $ret["content"];
			   $confidence = ($type == "tips") ? $ret["confidence"] : "";
			   $category = ($type == "results") ? $ret["category"] : "";
			   $status = ($type == "results") ? $ret["status"] : "";
			   $odds = ($type == "results") ? $ret["odds"] : "";
			   $likes = 0; $comments = 0;
			
			$t = Tips::create(['tid'=> $tid, 
			                        'type' => $type, 
			                        'content' => $content, 
                                   ]);
			   
			$td = TipsData::create(['tid'=> $t->tid, 
			                        'confidence' => $confidence, 
			                        'likes' => $likes, 
			                        'comments' => $comments, 
			                        'category' => $category, 
			                        'results' => $odds, 
			                        'status' => $status, 
                                   ]);
		   }			   
		
		   
}
?>
