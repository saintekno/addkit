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
    }

	public function _header_menu($menu) {
        $menu[] = array(
            'title' => __('List'),
            'href' => site_url([ 'admin', 'addkit' ]),
            'icon' => 'la la-list',
        );
        return $menu;
	}
}
new AddKit_Menu;