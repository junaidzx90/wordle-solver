<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wordle_Solver
 * @subpackage Wordle_Solver/includes
 * @author     Developer Junayed <admin@easeare.com>
 */
class Wordle_Solver_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
		$wordle_solver_words = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}wordle_solver_words` (
			`ID` INT NOT NULL AUTO_INCREMENT,
			`word` VARCHAR(55) NOT NULL,
			`created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY (`ID`)) ENGINE = InnoDB";
		dbDelta($wordle_solver_words);
	}

}
