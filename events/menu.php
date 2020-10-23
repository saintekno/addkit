<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_Menu extends CI_model
{
    public function __construct()
    {
		parent::__construct();
		$this->events->add_filter( 'apps_menu', array( $this, 'apps_menu' ), 15);
		// $this->events->add_filter( 'report_menu', array( $this, 'report_menu' ), 15);
		// $this->events->add_filter( 'setting_menu', array( $this, 'setting_menu' ), 15);
    }
	
	public function apps_menu($apps)
	{
		$apps[] = array(
			'title'=> __('AddKit'),
			'icon'  => 'svg/Puzzle.svg',
			'href'  => site_url('admin/addkit')
		);

		return $apps;
	}
}
new AddKit_Menu;