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
	
// In DST -240 and when it is EST then -300
    const GMT_DST = "-240";
	const GMT_EST = "-300";
    
	function __construct() {
		$this -> year = date("Y");
		$this -> month = date("n");

		$today = date("F j, Y, g:i a");
		$day = date("j");

	}

    /**
     * returns True if the daylight savings (means in Spring when clocks go 1 hour forward) is active
     * and False otherwise.
     * @return type
     */
	public function is_daylight_savings() {
		return date('I') == 1;
	}
    
    /**
     * A method to get the present GMT value to be used for IABAT Namaz Timings. The value when the
     * Daylight Savings is On (means in Spring when clocks go 1 hour forward) we need to use -240
     * and when it is not on we gotta use -300.
     * @return type
     */
	private function get_gmt_value()
	{
		$my_gmt = self::GMT_EST;
		
		if (self::is_daylight_savings())
		{
			$my_gmt=self::GMT_DST;
		}
		
		return $my_gmt;
	}
	
	private function namaz_times($day = "all") {
		$days_option = "";
		if ($day != "all") {
			$days_option = "&d=$day";
		}

		$iabat_long = self::IABAT_LONG;
		$iabat_lat = self::IABAT_LAT;
		$gmt = self::get_gmt_value();

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

	public static function get_today_date($params) {
		date_default_timezone_set('America/New_York');
		//$today = date("F j, Y, g:i a");
		$today = date("M/d/y g:i a");
		
		return $today;
	}


}
