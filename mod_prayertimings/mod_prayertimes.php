<?php
/**
 *
 */

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$namaz_times = ModPrayerTimingsHelper::get_namaz_times($params);
$today_date = ModPrayerTimingsHelper::get_today_date($params);

require JModuleHelper::getLayoutPath('mod_prayertimes');