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
        public function getBetSlipsPurchased($user);
        public function getBetSlips();
        public function getBetSlip($id);
        public function markBetSlip($id,$result);
        public function markGame($id,$result);
        public function getTokenBalance($user);
        public function getTotalBetSlipsPurchased($user);
        public function enable($user_id);
        public function disable($user_id);
}
 ?>