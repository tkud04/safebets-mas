<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
        public function bomb($data);
        public function getFixtures($id,$filter);
        public function getFixture($id);
        public function getAds();
        public function getGames($user,$type);
        public function getUsers();
        public function getUser($id);
        public function getUserPurchases($user);
        public function getPurchases();
        public function getBetSlips();
        public function getBetSlip($id);
        public function getUserBetSlips($user);
        public function markBetSlip($id,$result);
        public function markGame($id,$bsID,$result);
        public function getTokenBalance($user);
        public function getTotalBetSlipsPurchased($user);
        public function getTotalBetSlipsSold($user);
        public function enable($user_id);
        public function disable($user_id);
        public function getCountries();
        public function getLeads();
        public function addLead($data);
        public function unsubscribe($em);
        public function addCountry($data);
        public function addCompetition($data);
        public function addTeam($data);
        public function addPrediction($data);
        public function addBetSlip($data);
        public function getCategory($user);
        public function getOtherLeagues();
        public function getTeams($competition);
        public function getCompetitions($country);
        public function buyGame($user,$data);
        public function refundGame($betSlipID);
        public function addToPurchases($user,$betSlipID);
        public function getSettings($user);
        public function updateSettings($user,$data);
        public function addTokens($userId,$tokens);
        public function removeTokens($userId,$tokens);
		public function getExchangeRate();
		#public function getTotalRevenue();
		public function getTotalTokens();
		public function getTotalBetSlips();
		public function getTotalPunters();
		public function getRecentPurchases();
		public function getRecentMessages();
		public function getResults();
		public function oasis();
		public function uploadTips($ret);
}
 ?>