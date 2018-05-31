<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
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
        public function markGame($id,$result);
        public function getTokenBalance($user);
        public function getTotalBetSlipsPurchased($user);
        public function getTotalBetSlipsSold($user);
        public function enable($user_id);
        public function disable($user_id);
        public function getCountries();
        public function addCountry($data);
        public function addCompetition($data);
        public function addTeam($data);
        public function addPrediction($data);
        public function addBetSlip($data);
        public function getCategory($user);
        public function getOtherLeagues();
        public function getTeams($competition);
        public function getCompetitions($country);
}
 ?>