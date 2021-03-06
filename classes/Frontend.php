<?php
/**
 * Frontend class
 *
 * @author: themeum
 * @author_uri: https://themeum.com
 * @package Tutor
 * @since v.1.5.2
 */


namespace TUTOR;

if ( ! defined( 'ABSPATH' ) )
	exit;

class Frontend {

	public function __construct() {
		add_action('after_setup_theme', array($this, 'remove_admin_bar'));
	}

	/**
	 * Remove admin bar based on option
	 */
	function remove_admin_bar() {
		$hide_admin_bar_for_users = (bool) get_tutor_option('hide_admin_bar_for_users');
		if (!current_user_can('administrator') && !is_admin() && $hide_admin_bar_for_users) {
			show_admin_bar(false);
		}
	}



}