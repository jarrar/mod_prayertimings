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
 *  -) Timezone is just limited to EST (New York)
 *  -) Should have an XML/JSON based configuration
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

		//$today = date("F j, Y, g:i a");
		//$day = date("j");

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
	
    /**
     * A method to get all Namaz times for a month or a day.
     * When getting All month's Namaz times it does not take into account DST (perhaps it should)
     * @param type $day
     * @return type
     */
	private function namaz_times($day = "all") 
    {
		$days_option = "";
		if ($day != "all") {
			$days_option = "&d=$day";
		}

		$iabat_long = self::IABAT_LONG;
		$iabat_lat = self::IABAT_LAT;
		$gmt = self::get_gmt_value();
        
        // may be should check if the month is October or March and view is all then 
        // make multiple calls for times to accomodate DST.
		$url = self::PRAYTIME_URL . "?lat=$iabat_lat&lon=$iabat_long&gmt=$gmt&m=$this->month&y=$this->year&school=0$days_option";

		$json = file_get_contents($url);
		$data = json_decode($json, true);
		return $data;
	}

    /**
     * A methodd to get today's Namaz times, it normalizes times for DST and such adjustments.
     * @return type
     */
	public function get_namaz_times_for_today() {
		$day = date("j");
		return $this -> namaz_times($day);
	}

    /**
     * A method to get entire month's Namaz times.
     * -) Does not normalize times for DST as getting DST or not based on the time when the call
     *    is made. we should fix it.
     * @return type
     */
	public function get_namaz_times_for_month() {
		return $this -> namaz_times();
	}

}

class ModPrayerTimingsHelper {
	/**
     * A helper class to interface with mod_prayertimes.
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
