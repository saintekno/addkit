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

class addkitApiController extends MY_Addon
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('addkit_model');
	}

	public function index()
	{
        $addkit = $this->addkit_model->find_all();

        return response()->json($addkit);
	}
}