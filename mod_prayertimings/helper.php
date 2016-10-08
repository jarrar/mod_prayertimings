<?php
/**
 * Helper class for Prayer Timings.
 *
 * @package    Iabat.PrayerTimes
 * @subpackage Modules
 * @license    GNU/GPL, see LICENSE.php
 *
 * mod_prayertimes is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

/**
 * TODO:
 * 	-) Parameterize Latitude, Longitude etc
 */

class NamazTime {
	private $year = '';
	private $month = '';
	private $day = '';

	const PRAYTIME_URL = "http://praytime.info/getprayertimes.php";
	const IABAT_LAT = "35.839742";
	const IABAT_LONG = "-78.893319";
	const GMT = "-240";

	function __construct() {
		$this -> year = date("Y");
		$this -> month = date("n");

		$today = date("F j, Y, g:i a");
		$day = date("j");

	}

	public function is_daylight_savings() {
		return date('I') == 1;
	}

	private function namaz_times($day = "all") {
		$days_option = "";
		if ($day != "all") {
			$days_option = "&d=$day";
		}

		$iabat_long = self::IABAT_LONG;
		$ibat_lat = self::IABAT_LAT;
		$gmt = self::GMT;

		$url = self::PRAYTIME_URL . "?lat=$iabat_lat&lon=$iabat_long&gmt=$gmt&m=$this->month&y=$this->year&school=0$days_option";

		$json = file_get_contents($url);
		$data = json_decode($json, true);
		return $data;
	}

	public function get_namaz_times_for_today() {
		$day = date("j");
		return $this -> namaz_times($day);
	}

	// this is not tested yet - Jarrar
	public function get_namaz_times_for_month() {
		return $this -> namaz_times();
	}

}

class ModPrayerTimingsHelper {
	/**
	 */
	public static function get_namaz_times($params) {
		date_default_timezone_set('America/New_York');
		$namaz = new NamazTime();
		return $namaz -> get_namaz_times_for_today();
	}

}
