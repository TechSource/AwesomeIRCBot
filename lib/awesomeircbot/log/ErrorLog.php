<?php
/**
 * Error Log Class
 * Should be used to log any actions the bot takes
 *
 * Copyright (c) 2011, Jack Harley
 * All Rights Reserved
 */

namespace awesomeircbot\log;

use awesomeircbot\log\Error;
use awesomeircbot\config\Config;

class ErrorLog {

	public static $log = array();
	
	private function __construct() {}
	
	/**
	 * Logs an 'error'
	 * 
	 * @param int bit error type, see the ErrorCategories constant class
	 * @param string message
	 */
	public static function log($type, $message) {
		$error = new Error($type, $message);
		$log[] = $error;
		
		if ((Config::getRequiredValue("verboseOutput") & $type) === $type)
			echo "[*] " . $message . "\n";
		
		if ($type == ErrorCategories::FATAL) {
			echo "DYING " . $message;
			echo "\n";
			die();
			exit();
		}
	}
}
?>