<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class AddKit_Menu extends CI_model
{
    public function __construct()
    {
		parent::__construct();
        // $this->events->add_action('setting_menu', array( $this, 'set_setting_menu' ));
        // $this->events->add_action('apps_menu', array( $this, 'set_app_menu' ));
        // $this->events->add_action('system_menu', array( $this, 'set_system_menu' ));
    }
}
new AddKit_Menu;