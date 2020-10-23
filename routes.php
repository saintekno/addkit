<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $Routes;

$Routes->get( 'addkit', 'AddKit_Home_Controller@index' );