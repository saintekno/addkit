<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AddKit_Addons extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
        
        $this->lang->load_lines(dirname(__FILE__) . '/language/*.php');
    }
}
new AddKit_Addons;