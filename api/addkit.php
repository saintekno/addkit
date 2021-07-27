<?php
defined('BASEPATH') or exit('No direct script access allowed');

class addkitApiController extends MY_Api
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('addkit_model');
	}

	public function index()
	{
        $addkit = ($d = $this->addkit_model->find_all()) ? $d : [];

        return response()->json($addkit);
	}
}