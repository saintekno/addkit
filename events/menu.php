<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class AddKit_Menu extends CI_model
{
    public function __construct()
    {
		parent::__construct();
        $this->events->add_filter( 'menu_nav', array( $this, 'menu_nav' ));
    }

	public function _header_menu($menu) {
        $menu[] = array(
            'id' => 4,
            'title' => __('List'),
            'slug' => [ 'admin', 'addkit' ],
            'icon' => 'la la-list',
            'permission' => 'read.addkit',
            'order' => 4
        );
        return $menu;
	}

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
	public function menu_nav($menu) {
		$final[] = array(
			'id' => 1,
			'name' => __('Admin Web'),
			'icon' => 'fas fa-globe',
			'slug' => [ 'admin', 'addkit' ],
            'permission' => 'read.addkit',
            'order' => 4
		);
        return $final;
	}
}
new AddKit_Menu;