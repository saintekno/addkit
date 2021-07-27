<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_Menu extends MY_Addon
{
    public function __construct()
    {
		parent::__construct();
        $this->events->add_filter( 'fill_menu_nav', array( $this, 'menu_nav' ));
    }

	public function _header_nav($menu) {
        $menu[] = array(
            'id' => 1, 'parent' => 0, 'order' => 1,
            'name' => __('List', 'addkit'), 'slug' => site_url([ 'admin', 'addkit' ]),
            'permission' => 'read.addkit',
        );
        return $menu;
	}

    /**
     * Load Dashboard Menu
     * [New Permission Ready]
    **/
	public function menu_nav($menu) {
		$menu[] = array(
            'id' => 1, 'parent' => 0, 'order' => 1, 'icon' => 'text',
			'name' => __('Addkit', 'addkit'), 'slug' => site_url([ 'admin', 'addkit' ]),
            'permission' => 'read.addkit',
		);
        return $menu;
	}
}
new AddKit_Menu;