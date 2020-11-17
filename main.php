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
class AddKit_Addons extends CI_model
{
    public function __construct()
    {
        parent::__construct();
        
        $this->lang->load_lines(dirname(__FILE__) . '/language/*.php');
    }
}
new AddKit_Addons;

include_once(dirname(__FILE__) . '/events/actions.php');
include_once(dirname(__FILE__) . '/events/install.php');
include_once(dirname(__FILE__) . '/events/filters.php');

if (get_instance()->install_model->is_installed()) {
    include_once(dirname(__FILE__) . '/events/menu.php');
}