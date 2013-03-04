<?php
class Helper_Output
{
	protected static $_css 		= array();
	protected static $_js 		= array();
	protected static $_csspath	= 'css/';
	protected static $_jspath	= 'js/';

	public static function factory() 
	{
		return new Helper_Output();
	}

	public function link_css($css)
	{
		self::$_css[] = $css;
		return $this;
	}

	public function link_js($js)
	{
		self::$_js[] = $js;
		return $this;
	}

	public static function renderCss()
	{
		if(!empty(self::$_css)) {
			foreach (self::$_css as $key => $value) {

				$http = substr($value, 0, 4);
				if($http == 'http') {
					echo '<link rel="stylesheet" type="text/css" href="'. $value .'" />';
				} else {
					echo '<link rel="stylesheet" type="text/css" href="'. URL::base( ) . self::$_csspath . $value .'.css" />';
				}

				
			}
		}
	}

	public static function renderJS()
	{
		if(!empty(self::$_js)) {
			foreach (self::$_js as $key => $value) {
				$http = substr($value, 0, 4);
				if($http == 'http') {
					echo '<script type="text/javascript" src="'. $value .'" /></script>';
				} else {
					echo '<script type="text/javascript" src="'. URL::base( ) . self::$_jspath . $value .'.js" ></script>';
				}
			}
		}
	}

        
        public static function getDateFromUnixTime($time = false){
            if(!$time)
                $time = time();
            return date(Kohana::$config->load('config')->get('date_format'), $time);
        }
        
        public static function siteDate($date) {
            if($date == '0000-00-00 00:00:00' || !$date) {
                    return date(Kohana::$config->load('config')->get('date_format'), time());
            } else {
                    return DateTime::CreateFromFormat('Y-m-d H:i:s', $date)->format(Kohana::$config->load('config')->get('date_format'));
            }
	}
        
        static function hightLight($what, $where) {
            return str_replace($what, "<b>" . $what . "</b>", $where);
        }
        
        public static function timestampForDB ($date) 
        {
            if($date == '00-00-0000' || !$date) {
                    return date('Y-m-d H:i:s', time());
            } else {
                    return DateTime::CreateFromFormat('d-m-Y', $date)->format('Y-m-d H:i:s');
            }
        }
        
        public static function getAvatar($user)
        {
            if ($user->user_profile->avatar) {
                return URL::site(Kohana::$config->load('config')->get('user_files') . $user->id . '/avatar/' . $user->user_profile->avatar);
            } else {
                return URL::site('img/icon-no-image-512.png');
            }
        }
        
        public static function getClearPathToAvatar($user)
        {
            $file  = Kohana::$config->load('config')->get('user_files') . $user->id . '/avatar/' . $user->user_profile->avatar;
            if (file_exists($file)) {
                return $file;
            } else {
                return '';
            }
        }
        
        // Time format is UNIX timestamp or
        // PHP strtotime compatible strings
        static function dateDiff($time1, $time2, $precision = 6) {
            // If not numeric then convert texts to unix timestamps
            if (!is_int($time1)) {
            $time1 = strtotime($time1);
            }
            if (!is_int($time2)) {
            $time2 = strtotime($time2);
            }

            // If time1 is bigger than time2
            // Then swap time1 and time2
            if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
            }

            // Set up intervals and diffs arrays
            $intervals = array('year','month','day','hour','minute','second');
            $diffs = array();

            // Loop thru all intervals
            foreach ($intervals as $interval) {
            // Set default diff to 0
            $diffs[$interval] = 0;
            // Create temp time from time1 and interval
            $ttime = strtotime("+1 " . $interval, $time1);
            // Loop until temp time is smaller than time2
            while ($time2 >= $ttime) {
                $time1 = $ttime;
                $diffs[$interval]++;
                // Create new temp time from time1 and interval
                $ttime = strtotime("+1 " . $interval, $time1);
            }
            }

            $count = 0;
            $times = array();
            // Loop thru all diffs
            foreach ($diffs as $interval => $value) {
            // Break if we have needed precission
            if ($count >= $precision) {
                break;
            }
            // Add value and interval 
            // if value is bigger than 0
            if ($value > 0) {
                // Add s if value is not 1
                if ($value != 1) {
                $interval .= "s";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
            }

            // Return string with times
            return implode(", ", $times);
        }
        
        
}