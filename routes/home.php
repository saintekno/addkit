<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_Home_Controller extends MY_Model
{
    protected $table_name = 'addkit';

	public function __construct()
	{
		parent::__construct();
	}
	
    public function index()
    {
		Polatan::set_title(__( 'AddKit', 'addkit' ));
        
        $this->load->addon_view( 'addkit', 'home', null );
    }
}
