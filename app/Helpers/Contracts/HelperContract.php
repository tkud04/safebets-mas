<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
        public function getFixtures($id,$filter);
        public function getAds();
        public function getGames($type);
        public function getBetSlipsPurchased($user);
        public function getBetSlip($id);
}
 ?>